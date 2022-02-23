<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


use App\Models\UserModel;


class ServiceReportController extends Controller
{
    public $modelName       = 'App\Models\ServiceEngineerModel';
    public $baseRedirect    = 'servicereport.index';
    public $baseName        = 'servicereport';
    public $basePath        = 'reports/';
    public $detailName      = 'ServiceReportController@getIndex';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view($this->basePath . $this->baseName);
    }
    
    public function servicedata()
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
            $statuspara = "";
        }
        else
        {
            $statuspara = " and service_spares_register.order_status = $orderstatus ";
        }
        
        $servicedata = DB::select("select a.complaint_date as complaintdate, 
                                            a.seqno as seqno,
                                            a.ordertype as ordertype,
                                            a.customer_name as customer_name,
                                            a.site_location as site_location,
                                            coalesce(a.salesorder_no,'') as salesorder_no,
                                            a.complaint_nature as complaint_nature,
                                            a.warrentytype as warrentytype,
                                            a.complaintmode as complaintmode,
                                            a.orderstatus as orderstatus,
                                            case when a.isagent = 0 then GROUP_CONCAT( coalesce(a.serviceengineer,'') ) else a.serviceagent end as attendedby,
                                            a.attendeddate as attendeddate,
                                            a.workdecription as workdecription
                                    from
                                        (select complaint_register.complaint_date  as complaint_date,
                                                complaint_register.seqno as seqno,
                                                case 
                                                    when complaint_register.order_type = 0 then 'Standard' 
                                                    when complaint_register.order_type = 1 then 'Industry' 
                                                    when complaint_register.order_type = 2 then 'Utility'
                                                    when complaint_register.order_type = 3 then 'Project' else 'Railway' end as ordertype, 
                                            complaint_register.customer_name as customer_name,
                                            complaint_register.site_location as site_location,
                                            complaint_register.salesorder_no as salesorder_no,
                                            complaint_register.complaint_nature as complaint_nature,
                                            case when complaint_register.warrenty = 0 then 'Within Warrenty' else 'Without Warrenty ' end as warrentytype,
                                            case when complaint_register.mode_of_complaint = 0  then 'Phone' else 'Mail' end as complaintmode,
                                            CASE
                                                when service_spares_register.order_status = 0 then 'Enquiry Received'
                                                when service_spares_register.order_status = 1 then 'OfferSent'
                                                when service_spares_register.order_status = 2 then 'Po Received'
                                                when service_spares_register.order_status = 3 then 'PI Sent'
                                                when service_spares_register.order_status = 4 then 'Advance Received'
                                                when service_spares_register.order_status = 5 then 'Payment Received'
                                                when service_spares_register.order_status = 6 then 'DI Sent'
                                                when service_spares_register.order_status = 8 then 'Completed'
                                                when service_spares_register.order_status = 9 then 'Cancelled'
                                                when service_spares_register.order_status = 10 then 'Deputed' end as orderstatus,
                                                visit_plan.is_agent as isagent,
                                                coalesce(service_engineer.name,'') as serviceengineer,
                                                service_agent.company_name as serviceagent,
                                                coalesce(visitplan_summary.date_of_attend,'') as attendeddate,
                                                coalesce(visitplan_summary.work_description,'') as workdecription

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
                                    and complaint_register.complaint_date >= '".$inputs['fromdate']."' 
                                    and complaint_register.complaint_date <= '".$inputs['todate']."'
                                    $statuspara".' '." $orderpara )a 
                                    group by a.complaint_date, 
                                            a.seqno,
                                            a.ordertype,
                                            a.customer_name,
                                            a.site_location,
                                            a.salesorder_no,
                                            a.complaint_nature,
                                            a.warrentytype,
                                            a.complaintmode,
                                            a.orderstatus,
                                            a.isagent,
                                            a.serviceagent,
                                            a.attendeddate,
                                            a.workdecription");
        $this->data['status']=1;
        $this->data['servicedata']=$servicedata;
        return response()->json($this->data);
              
    }
    
}
