<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


use App\Models\UserModel;


class EngineerReportController extends Controller
{
    public $modelName       = 'App\Models\ServiceEngineerModel';
    public $baseRedirect    = 'engineerreport.index';
    public $baseName        = 'engineerreport';
    public $basePath        = 'reports/';
    public $detailName      = 'EngineerReportController@getIndex';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $engineers = DB::select("select service_engineer.id,service_engineer.name
                                                from service_engineer
                                                where service_engineer.deleted_at is null");
        $data['engineers'] = $engineers;
        return view($this->basePath . $this->baseName,$data);
    }
    
    public function engineerdata()
    {
        $inputs = request()->all();
        $fromdate = $inputs['fromdate'];
        $todate = $inputs['todate'];
        $engineer_id = $inputs['engineer_id'];
       // print_r($enginner_id);
        
        $pendingreport = DB::select("SELECT count(complaint_register.seqno) as pendingjobs
                                        FROM complaint_register,
                                            service_spares_register,visit_plan,visitplan_engineer,service_engineer
                                                
                                        where service_spares_register.complaint_register_id = complaint_register.id
                                        and visit_plan.servicespare_id = service_spares_register.id and visit_plan.status=1 and visit_plan.deleted_at is null
                                        and visit_plan.id = visitplan_engineer.visitplan_id
                                        and service_engineer.id = visitplan_engineer.engineer_id
                                    	and service_spares_register.order_status in ('0','1','2','3','4','5','6','10','7','8','12')
 					and service_engineer.id=$engineer_id
                                        and service_spares_register.deleted_at is null
                                        and complaint_register.deleted_at is null
                                        and service_spares_register.scope_of_work not like '%AMC%'");
        
        $expensedata = DB::select("select sum(visit_expenses.loading_expenses)  + sum(visit_expenses.boarding_expenses) + sum(visit_expenses.travel_expenses) + sum(visit_expenses.local_expenses) as expenses
                                                from visitplan_summary,visit_expenses, service_engineer
                                                where visit_expenses.visitplan_summary_id = visitplan_summary.id
                                                and service_engineer.id = visit_expenses.engineer_id
                                                and visitplan_summary.date_of_complete >= '$fromdate'
                                                and visitplan_summary.date_of_complete <= '$todate'                                    
                                                and visitplan_summary.deleted_at is null
                                                and service_engineer.id= '$engineer_id'");
        
        $jobcomp = DB::select("select count(service_spares_register.id) as engjobcnt
                                                from visitplan_summary,service_engineer,service_spares_register,visit_plan,visitplan_engineer
                                                where visitplan_summary.visitplan_id = visitplan_engineer.visitplan_id
                                                and service_engineer.id = visitplan_engineer.engineer_id
                                                and visitplan_summary.visitplan_id = visit_plan.id
                                                and visit_plan.servicespare_id = service_spares_register.id
                                                and visitplan_summary.date_of_complete >= '$fromdate'
                                                and visitplan_summary.date_of_complete <= '$todate' 
                                                and visitplan_engineer.engineer_id = '$engineer_id'
                                                and visitplan_summary.deleted_at is null ");
        
        $scopeofworks = DB::select("select service_engineer.name,service_spares_register.scope_of_work
                                                from visitplan_summary,service_engineer,service_spares_register,visit_plan,visitplan_engineer
                                                where visitplan_summary.visitplan_id = visitplan_engineer.visitplan_id
                                                and service_engineer.id = visitplan_engineer.engineer_id
                                                and visitplan_summary.visitplan_id = visit_plan.id
                                                and visit_plan.servicespare_id = service_spares_register.id
                                                and visitplan_summary.date_of_complete >= '$fromdate'
                                                and visitplan_summary.date_of_complete <= '$todate' 
                                                and visitplan_engineer.engineer_id = '$engineer_id'
                                                and visitplan_summary.deleted_at is null");
        
        $exp_details = DB::select("select complaint_register.seqno as seqno,complaint_register.complaint_date,complaint_register.customer_name,complaint_register.site_location,complaint_register.salesorder_no,case when complaint_register.warrenty = 0 then 'Under Warrenty' else 'Out Of Warrenty' end as warrenty,
                                            sum(visit_expenses.loading_expenses)  + sum(visit_expenses.boarding_expenses) + sum(visit_expenses.travel_expenses) + sum(visit_expenses.local_expenses) as expenses
                                                from visitplan_summary,visit_expenses, service_engineer,visit_plan,service_spares_register,complaint_register
                                                where visit_expenses.visitplan_summary_id = visitplan_summary.id
                                                and service_engineer.id = visit_expenses.engineer_id
                                                and visit_plan.id = visitplan_summary.visitplan_id
                                                and visit_plan.servicespare_id = service_spares_register.id
                                                and complaint_register.id = service_spares_register.complaint_register_id
                                                and visitplan_summary.date_of_complete >= '$fromdate'
                                                and visitplan_summary.date_of_complete <= '$todate'                                    
                                                and visitplan_summary.deleted_at is null
                                                and service_engineer.id= '$engineer_id'
                                                group by complaint_register.seqno,complaint_register.complaint_date,complaint_register.customer_name,complaint_register.salesorder_no,complaint_register.warrenty,complaint_register.site_location
                                                order by complaint_register.complaint_date");
        
        $pending_details = DB::select("SELECT complaint_register.seqno as seqno,complaint_register.complaint_date,complaint_register.customer_name,complaint_register.site_location,complaint_register.salesorder_no,
                                        case when complaint_register.warrenty = 0 then 'Under Warrenty' else 'Out Of Warrenty' end as warrenty,complaint_register.complaint_nature,
                                        replace(service_spares_register.scope_of_work,'\"','') as scope_of_work
                                        FROM complaint_register,
                                            service_spares_register,visit_plan,visitplan_engineer,service_engineer
                                                
                                        where service_spares_register.complaint_register_id = complaint_register.id
                                        and visit_plan.servicespare_id = service_spares_register.id and visit_plan.status=1 and visit_plan.deleted_at is null
                                        and visit_plan.id = visitplan_engineer.visitplan_id
                                        and service_engineer.id = visitplan_engineer.engineer_id
                                    	and service_spares_register.order_status in ('0','1','2','3','4','5','6','10','7','8','12')
 					and service_engineer.id= '$engineer_id'
                                        and service_spares_register.scope_of_work not like '%AMC%'
                                        and service_spares_register.deleted_at is null
                                        and complaint_register.deleted_at is null
                                        order by complaint_register.complaint_date");
        
        foreach($scopeofworks as $scopeofwork)
        {
            $sow1 = str_replace('"','',$scopeofwork->scope_of_work);
            $sow2 = explode(",",$sow1);
            
            if(count($sow2)>1)
            {
               foreach($sow2 as $sow)
               {
                   $sow3[]=$sow;
               }
            }
            else
            {
                $sow3[]=$sow1;
            }
        }
        $scopeofwork2 = array_count_values($sow3);
        //print_r($expensedata);die;
        $this->data['status']=1;
        $this->data['compjobcnt']=$jobcomp[0]->engjobcnt;
        $this->data['expenses'] = $expensedata[0]->expenses;
        $this->data['pendingeng'] = $pendingreport[0]->pendingjobs;
        $this->data['expdetails'] = $exp_details;
        $this->data['scopeofwork'] = $scopeofwork2;
        $this->data['pending_details'] = $pending_details;
        
        return response()->json($this->data);
              
    }
    
    public function sowdata()
    {
        $inputs = request()->all();
        $fromdate = $inputs['fromdate'];
        $todate = $inputs['todate'];
        $engineer_id = $inputs['engineer_id'];
        $sow = $inputs['sow'];
        
        $sowDetails = DB::select("SELECT complaint_register.seqno as seqno,complaint_register.complaint_date,complaint_register.customer_name,complaint_register.site_location,complaint_register.salesorder_no,
                                        case when complaint_register.warrenty = 0 then 'Under Warrenty' else 'Out Of Warrenty' end as warrenty,complaint_register.complaint_nature,
                                        replace(service_spares_register.scope_of_work,'\"','') as scope_of_work,
                                        sum(visit_expenses.loading_expenses)  + sum(visit_expenses.boarding_expenses) + sum(visit_expenses.travel_expenses) + sum(visit_expenses.local_expenses) as expenses
                                        from visitplan_summary,visit_expenses,service_engineer,service_spares_register,visit_plan,visitplan_engineer,complaint_register
                                                where visitplan_summary.visitplan_id = visitplan_engineer.visitplan_id
                                                and visit_expenses.visitplan_summary_id = visitplan_summary.id
                                                and service_engineer.id = visit_expenses.engineer_id
                                                and service_engineer.id = visitplan_engineer.engineer_id
                                                and visitplan_summary.visitplan_id = visit_plan.id
                                                and visit_plan.servicespare_id = service_spares_register.id
                                                and complaint_register.id = service_spares_register.complaint_register_id
                                                and visitplan_summary.date_of_complete >= '$fromdate'
                                                and visitplan_summary.date_of_complete <= '$todate' 
                                                and visitplan_engineer.engineer_id = '$engineer_id'
                                                and visitplan_summary.deleted_at is null 
                                                and service_spares_register.scope_of_work like '%$sow%'
                                        and service_spares_register.deleted_at is null
                                        and complaint_register.deleted_at is null
                                        group by complaint_register.seqno,complaint_register.complaint_date,complaint_register.customer_name,complaint_register.site_location,complaint_register.salesorder_no,complaint_register.warrenty,complaint_register.complaint_nature,service_spares_register.scope_of_work
                                        order by complaint_register.complaint_date");
        
        $this->data['sowdetails'] = $sowDetails;
        
        return response()->json($this->data);
    }
}
