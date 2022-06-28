<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


use App\Models\UserModel;


class StatusReportController extends Controller
{
    public $modelName       = 'App\Models\ServiceEngineerModel';
    public $baseRedirect    = 'statusreport.index';
    public $baseName        = 'statusreport';
    public $basePath        = 'reports/';
    public $detailName      = 'StatusReportController@getIndex';
    
   static $ORDER_TYPE_VALUES = array('Enquiry Received' => '0', 'OfferSent' => '1', 'Po Received' => '2' , 'PI Sent' => '3' ,'Advance Received'=>'4' , 'Payment Received' => '5','Visit Completed'=>'8','Deputed'=>'10','Visit Resscheduled'=>'12');

    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $process_status = DB::select("select count(A.orderstatus) as cnt,A.orderstatus from
                                            (select 
                                                CASE
                                                when service_spares_register.order_status = 0 then 'Enquiry Received'
                                                when service_spares_register.order_status = 1 then 'OfferSent'
                                                when service_spares_register.order_status = 2 then 'Po Received'
                                                when service_spares_register.order_status = 3 then 'PI Sent'
                                                when service_spares_register.order_status = 4 then 'Advance Received'
                                                when service_spares_register.order_status = 5 then 'Payment Received' else 'No Data' end as orderstatus
                                                

                                    from 
                                        complaint_register,
                                        service_spares_register
                                        left join visit_plan on visit_plan.servicespare_id = service_spares_register.id and visit_plan.deleted_at is null
                                        left join visitplan_engineer on  visit_plan.id = visitplan_engineer.visitplan_id and visitplan_engineer.deleted_at is null
                                        left join service_engineer on service_engineer.id = visitplan_engineer.engineer_id
                                        left join service_agent on service_agent.id = visit_plan.agent_id
                                        left join visitplan_summary on visitplan_summary.visitplan_id = visit_plan.id

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and complaint_register.complaint_type = 0)A
                                    where A.orderstatus != 'No Data'
                                    group by A.orderstatus");
        $job_pending = DB::select("select count(A.orderstatus) as cnt,A.orderstatus from
                                    (select 
                                                CASE
                                                when service_spares_register.order_status = 8 then 'Visit Completed'
                                                when service_spares_register.order_status = 10 then 'Deputed' 
                                         		when service_spares_register.order_status = 12 then 'Visit Resscheduled' else 'No Data' end as orderstatus
                                                
                                    from 
                                        complaint_register,
                                        service_spares_register
                                        left join visit_plan on visit_plan.servicespare_id = service_spares_register.id and visit_plan.deleted_at is null
                                        left join visitplan_engineer on  visit_plan.id = visitplan_engineer.visitplan_id and visitplan_engineer.deleted_at is null
                                        left join service_engineer on service_engineer.id = visitplan_engineer.engineer_id
                                        left join service_agent on service_agent.id = visit_plan.agent_id
                                        left join visitplan_summary on visitplan_summary.visitplan_id = visit_plan.id

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and complaint_register.complaint_type = 0)A
                                    where A.orderstatus != 'No Data'
                                    group by A.orderstatus");
       $jobdata=array();
       $processdata = array();
       
       foreach($process_status as $process)
       {
           $processdata[]=array($process->orderstatus ,$process->cnt);
           //$processdata['processcnt'][] = $process->cnt;
       }
       foreach($job_pending as $job)
       {
           $jobdata[]=array($job->orderstatus ,$job->cnt);
           //$processdata['processcnt'][] = $process->cnt;
       }
        //print_r($jobdata);die;
        $data['process_status']=$processdata;
        $data['job_status']=$jobdata;
        
        return view($this->basePath . $this->baseName,$data);
    }
    
    public function statusdata()
    {
        $inputs = request()->all();
        $ordertype = $inputs['ordertype'];
        $orderstatus = $inputs['orderstatus'];
        if($ordertype == null || $ordertype == "")
        {
            $orderpara = "";
        }
        else
        {
            $orderpara = " and complaint_register.order_type = $ordertype ";
        }
        
        if($orderstatus == null || $orderstatus == "")
        {
            $statuspara = "and complaint_register.complaint_date >= '".$inputs['fromdate']."' 
                          and complaint_register.complaint_date <= '".$inputs['todate']."'";
            
            
        }
        else
        {
            //0-Enquiryreceived;1-OfferSent;2-Poreceived;3-PIsent;4-Advcance Received;5-Payment Received;6-DISent;7-Partialdispatch;8-VisitCompleted/Dispathched;9-Cancelled;10-Deputed;11-Job Completed;12-Visit Rescheduled	
            if($orderstatus == "pending")
            {
                $statuspara = "and service_spares_register.order_status in ('0','1','2','3','4','5','6') ";
                
                $statuspara_job = "and service_spares_register.order_status in ('10','7','8','12') ";
                

            }
            else
            {
                $statuspara = " and service_spares_register.order_status = $orderstatus 
                        and complaint_register.complaint_date >= '".$inputs['fromdate']."' 
                          and complaint_register.complaint_date <= '".$inputs['todate']."'";
                
                
            }
                
        }
        
        
        /********** data formation ******/
        
        if($orderstatus == "pending")
        {
            $ordertypewise_process = DB::Select("select count(a.ordertype) as ordertypecnt,
                                            a.ordertype as ordertype
                                    from
                                        (select 
                                                case 
                                                    when complaint_register.order_type = 0 then 'Standard' 
                                                    when complaint_register.order_type = 1 then 'Industry' 
                                                    when complaint_register.order_type = 2 then 'Utility'
                                                    when complaint_register.order_type = 3 then 'Project' else 'Railway' end as ordertype
                                                

                                    from 
                                        complaint_register,
                                        service_spares_register
                                        left join visit_plan on visit_plan.servicespare_id = service_spares_register.id and visit_plan.deleted_at is null
                                        left join visitplan_engineer on  visit_plan.id = visitplan_engineer.visitplan_id and visitplan_engineer.deleted_at is null
                                        left join service_engineer on service_engineer.id = visitplan_engineer.engineer_id
                                        left join service_agent on service_agent.id = visit_plan.agent_id
                                        left join visitplan_summary on visitplan_summary.visitplan_id = visit_plan.id

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and complaint_register.complaint_type = 0
                                    $statuspara".' '." $orderpara 
                                     )a 
                                    group by 
                                            a.ordertype");
            $ordertypewise_job = DB::Select("select count(a.ordertype) as ordertypecnt,
                                            a.ordertype as ordertype
                                    from
                                        (select 
                                                case 
                                                    when complaint_register.order_type = 0 then 'Standard' 
                                                    when complaint_register.order_type = 1 then 'Industry' 
                                                    when complaint_register.order_type = 2 then 'Utility'
                                                    when complaint_register.order_type = 3 then 'Project' else 'Railway' end as ordertype
                                                

                                    from 
                                        complaint_register,
                                        service_spares_register
                                        left join visit_plan on visit_plan.servicespare_id = service_spares_register.id and visit_plan.deleted_at is null
                                        left join visitplan_engineer on  visit_plan.id = visitplan_engineer.visitplan_id and visitplan_engineer.deleted_at is null
                                        left join service_engineer on service_engineer.id = visitplan_engineer.engineer_id
                                        left join service_agent on service_agent.id = visit_plan.agent_id
                                        left join visitplan_summary on visitplan_summary.visitplan_id = visit_plan.id

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and complaint_register.complaint_type = 0
                                    $statuspara_job".' '." $orderpara 
                                     )a 
                                    group by 
                                            a.ordertype");
            $orderstatuswise_process = DB::Select("select count(a.orderstatus) as orderstatuscnt,
                                            a.orderstatus as orderstatus
                                    from
                                        (select 
                                                CASE
                                                when service_spares_register.order_status = 0 then 'Enquiry Received'
                                                when service_spares_register.order_status = 1 then 'OfferSent'
                                                when service_spares_register.order_status = 2 then 'Po Received'
                                                when service_spares_register.order_status = 3 then 'PI Sent'
                                                when service_spares_register.order_status = 4 then 'Advance Received'
                                                when service_spares_register.order_status = 5 then 'Payment Received'
                                                when service_spares_register.order_status = 6 then 'DI Sent'
                                                when service_spares_register.order_status = 8 then 'Visit Completed'
                                                when service_spares_register.order_status = 10 then 'Deputed' 
                                         		when service_spares_register.order_status = 11 then 'Job Completed' 
                                         		when service_spares_register.order_status = 12 then 'Visit Resscheduled'  end as orderstatus
                                                
                                                

                                    from 
                                        complaint_register,
                                        service_spares_register
                                        left join visit_plan on visit_plan.servicespare_id = service_spares_register.id and visit_plan.deleted_at is null
                                        left join visitplan_engineer on  visit_plan.id = visitplan_engineer.visitplan_id and visitplan_engineer.deleted_at is null
                                        left join service_engineer on service_engineer.id = visitplan_engineer.engineer_id
                                        left join service_agent on service_agent.id = visit_plan.agent_id
                                        left join visitplan_summary on visitplan_summary.visitplan_id = visit_plan.id

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and complaint_register.complaint_type = 0
                                    $statuspara_job".' '." $orderpara
                                     )a 
                                    group by 
                                            a.orderstatus");
            $orderstatuswise_job = DB::Select("select count(a.orderstatus) as orderstatuscnt,
                                            a.orderstatus as orderstatus
                                    from
                                        (select 
                                                CASE
                                                when service_spares_register.order_status = 0 then 'Enquiry Received'
                                                when service_spares_register.order_status = 1 then 'OfferSent'
                                                when service_spares_register.order_status = 2 then 'Po Received'
                                                when service_spares_register.order_status = 3 then 'PI Sent'
                                                when service_spares_register.order_status = 4 then 'Advance Received'
                                                when service_spares_register.order_status = 5 then 'Payment Received'
                                                when service_spares_register.order_status = 6 then 'DI Sent'
                                                when service_spares_register.order_status = 8 then 'Visit Completed'
                                                when service_spares_register.order_status = 10 then 'Deputed' 
                                         		when service_spares_register.order_status = 11 then 'Job Completed' 
                                         		when service_spares_register.order_status = 12 then 'Visit Resscheduled'  end as orderstatus
                                                
                                                

                                    from 
                                        complaint_register,
                                        service_spares_register
                                        left join visit_plan on visit_plan.servicespare_id = service_spares_register.id and visit_plan.deleted_at is null
                                        left join visitplan_engineer on  visit_plan.id = visitplan_engineer.visitplan_id and visitplan_engineer.deleted_at is null
                                        left join service_engineer on service_engineer.id = visitplan_engineer.engineer_id
                                        left join service_agent on service_agent.id = visit_plan.agent_id
                                        left join visitplan_summary on visitplan_summary.visitplan_id = visit_plan.id

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and complaint_register.complaint_type = 0
                                    $statuspara_job".' '." $orderpara
                                     )a 
                                    group by 
                                            a.orderstatus");
        }
        else
        {
            
        }
        
        $this->data['status']=1;
        
        
        $this->data['servicedata']=$servicedata;
        return response()->json($this->data);
              
    }
    
    public function statusdetails()
    {
        $inputs = request()->all();
        
        $ordervalue = StatusReportController::$ORDER_TYPE_VALUES[$inputs['orderstatus']];
        
        $servicedata = DB::select("select complaint_register.seqno,complaint_register.customer_name,
                                    complaint_register.complaint_date,
                                    complaint_register.mobileno,
                                    complaint_register.salesorder_no,complaint_register.warrenty,
                                    service_spares_register.scope_of_work
                                    from 
                                        complaint_register,
                                        service_spares_register
                                        left join visit_plan on visit_plan.servicespare_id = service_spares_register.id and visit_plan.deleted_at is null
                                        left join visitplan_engineer on  visit_plan.id = visitplan_engineer.visitplan_id and visitplan_engineer.deleted_at is null
                                        left join service_engineer on service_engineer.id = visitplan_engineer.engineer_id
                                        left join service_agent on service_agent.id = visit_plan.agent_id
                                        left join visitplan_summary on visitplan_summary.visitplan_id = visit_plan.id

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and complaint_register.complaint_type = 0
                                    and complaint_register.order_status = $ordervalue");
        $this->data['status']=1;
        $this->data['servicedata']=$servicedata;
       // print_r($inputs);die;
        //$this->data['servicedata']=$servicedata;
        return response()->json($this->data);
    }
    
}
