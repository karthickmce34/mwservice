<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


use App\Models\UserModel;


class OperationReportController extends Controller
{
    public $modelName       = 'App\Models\ServiceEngineerModel';
    public $baseRedirect    = 'operationreport.index';
    public $baseName        = 'operationreport';
    public $basePath        = 'reports/';
    public $detailName      = 'OperationReportController@getIndex';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        return view($this->basePath . $this->baseName);
    }
    
    public function operationdata()
    {
        $inputs = request()->all();
        $fromdate = $inputs['fromdate'];
        $todate = $inputs['todate'];
       // print_r($enginner_id);
        $jobcomp_details = [];
        $pendingreport = DB::select("SELECT count(complaint_register.seqno) as pendingjobs
                                        FROM complaint_register,
                                            service_spares_register,visit_plan,visitplan_engineer,service_engineer
                                                
                                        where service_spares_register.complaint_register_id = complaint_register.id
                                        and visit_plan.servicespare_id = service_spares_register.id and visit_plan.status=1 and visit_plan.deleted_at is null
                                        and visit_plan.id = visitplan_engineer.visitplan_id
                                        and service_engineer.id = visitplan_engineer.engineer_id
                                    	and service_spares_register.order_status in ('0','1','2','3','4','5','6','10','7','8','12')
                                        and service_spares_register.deleted_at is null
                                        and complaint_register.deleted_at is null
                                        and visit_plan.deleted_at is null
                                        and visitplan_engineer.deleted_at is null
                                        and service_engineer.deleted_at is null
                                        and service_spares_register.scope_of_work  like '%Fault Rectification%'");
        
        
        $jobcomp = DB::select("select count(service_spares_register.id) as engjobcnt
                                                from visitplan_summary,service_engineer,service_spares_register,visit_plan,visitplan_engineer
                                                where visitplan_summary.visitplan_id = visitplan_engineer.visitplan_id
                                                and service_engineer.id = visitplan_engineer.engineer_id
                                                and visitplan_summary.visitplan_id = visit_plan.id
                                                and visit_plan.servicespare_id = service_spares_register.id
                                                and visitplan_summary.date_of_complete >= '$fromdate'
                                                and visitplan_summary.date_of_complete <= '$todate' 
                                                and service_spares_register.scope_of_work like '%Fault Rectification%'
                                                and visitplan_summary.deleted_at is null
                                                and service_engineer.deleted_at is null
                                                and service_spares_register.deleted_at is null
                                                and visit_plan.deleted_at is null
                                                and visitplan_engineer.deleted_at is null
                                                ");
        
        $pending_details = DB::select("SELECT complaint_register.seqno as seqno,complaint_register.complaint_date,complaint_register.customer_name,complaint_register.site_location,complaint_register.salesorder_no,
                                        case when complaint_register.warrenty = 0 then 'Under Warrenty' else 'Out Of Warrenty' end as warrenty,complaint_register.complaint_nature,
                                        replace(service_spares_register.scope_of_work,'\"','') as scope_of_work,DATEDIFF(now(),complaint_register.complaint_date) as diffdate
                                        
                                        FROM complaint_register,
                                            service_spares_register,visit_plan,visitplan_engineer,service_engineer
                                                
                                        where service_spares_register.complaint_register_id = complaint_register.id
                                        and visit_plan.servicespare_id = service_spares_register.id and visit_plan.status=1 and visit_plan.deleted_at is null
                                        and visit_plan.id = visitplan_engineer.visitplan_id
                                        and service_engineer.id = visitplan_engineer.engineer_id
                                    	and service_spares_register.order_status in ('0','1','2','3','4','5','6','10','7','8','12')
                                        and service_spares_register.scope_of_work like '%Fault Rectification%'
                                        and service_spares_register.deleted_at is null
                                        and complaint_register.deleted_at is null
                                        and visitplan_engineer.deleted_at is null 
                                        and visit_plan.deleted_at is null 
                                        and service_engineer.deleted_at is null
                                        order by complaint_register.complaint_date");
        
        $jobcomp_details = DB::select("SELECT complaint_register.seqno as seqno,complaint_register.complaint_date,complaint_register.customer_name,complaint_register.site_location,complaint_register.salesorder_no,
                                        case when complaint_register.warrenty = 0 then 'Under Warrenty' else 'Out Of Warrenty' end as warrenty,complaint_register.complaint_nature,
                                        replace(service_spares_register.scope_of_work,'\"','') as scope_of_work,DATEDIFF(now(),complaint_register.complaint_date) as diffdate,
                                        sum(visit_expenses.loading_expenses)  + sum(visit_expenses.boarding_expenses) + sum(visit_expenses.travel_expenses) + sum(visit_expenses.local_expenses) as expenses
                                                from visitplan_summary,service_engineer,service_spares_register,visit_plan,visitplan_engineer,complaint_register,visit_expenses
                                                where visitplan_summary.visitplan_id = visitplan_engineer.visitplan_id
                                                and visit_expenses.visitplan_summary_id = visitplan_summary.id
                                                and service_engineer.id = visit_expenses.engineer_id
                                                and service_engineer.id = visitplan_engineer.engineer_id
                                                and visitplan_summary.visitplan_id = visit_plan.id
                                                and visit_plan.servicespare_id = service_spares_register.id
                                                and service_spares_register.complaint_register_id = complaint_register.id
                                                and visitplan_summary.date_of_complete >= '$fromdate'
                                                and visitplan_summary.date_of_complete <= '$todate' 
                                                and service_spares_register.scope_of_work like '%Fault Rectification%'
                                                and complaint_register.deleted_at is null
                                                and visitplan_summary.deleted_at is null
                                                and service_engineer.deleted_at is null
                                                and service_spares_register.deleted_at is null
                                                and visit_plan.deleted_at is null
                                                and visitplan_engineer.deleted_at is null
                                                group by complaint_register.seqno,complaint_register.complaint_date,complaint_register.customer_name,complaint_register.salesorder_no,
                                                complaint_register.warrenty,service_spares_register.scope_of_work,complaint_register.site_location,complaint_register.complaint_nature
                                                order by complaint_register.complaint_date
                                                ");
        
        $pending_warrenty_cnt = DB::select("SELECT count(complaint_register.seqno) as pendingjobs,
                                        case when complaint_register.warrenty = 0 then 'Within Warrenty' else 'Out Of Warrenty' end as warrenty
                                            FROM complaint_register,
                                                service_spares_register,visit_plan,visitplan_engineer,service_engineer

                                            where service_spares_register.complaint_register_id = complaint_register.id
                                            and visit_plan.servicespare_id = service_spares_register.id and visit_plan.status=1 and visit_plan.deleted_at is null
                                            and visit_plan.id = visitplan_engineer.visitplan_id
                                            and service_engineer.id = visitplan_engineer.engineer_id
                                            and service_spares_register.order_status in ('0','1','2','3','4','5','6','10','7','8','12')
                                            and service_spares_register.deleted_at is null
                                            and complaint_register.deleted_at is null
                                            and visit_plan.deleted_at is null
                                            and visitplan_engineer.deleted_at is null
                                            and service_engineer.deleted_at is null
                                            and service_spares_register.scope_of_work  like '%Fault Rectification%'
                                            group by complaint_register.warrenty");
        
        $jobcomp_warrenty_cnt = DB::select("select count(service_spares_register.id) as engjobcnt,
                                        case when complaint_register.warrenty = 0 then 'Within Warrenty' else 'Out Of Warrenty' end as warrenty
                                            
                                                from visitplan_summary,service_engineer,service_spares_register,visit_plan,visitplan_engineer,complaint_register
                                                where visitplan_summary.visitplan_id = visitplan_engineer.visitplan_id
                                                and service_engineer.id = visitplan_engineer.engineer_id
                                                and visitplan_summary.visitplan_id = visit_plan.id
                                                and visit_plan.servicespare_id = service_spares_register.id
                                                and service_spares_register.complaint_register_id = complaint_register.id
                                                and visitplan_summary.date_of_complete >= '$fromdate'
                                                and visitplan_summary.date_of_complete <= '$todate' 
                                                and service_spares_register.scope_of_work like '%Fault Rectification%'
                                                and visitplan_summary.deleted_at is null
                                                and complaint_register.deleted_at is null
                                                and service_engineer.deleted_at is null
                                                and service_spares_register.deleted_at is null
                                                and visit_plan.deleted_at is null
                                                and visitplan_engineer.deleted_at is null
                                                group by complaint_register.warrenty 
                                                ");
        
        
        
        $this->data['status']=1;
        $this->data['compjobcnt']=$jobcomp[0]->engjobcnt;
        $this->data['pendingeng'] = $pendingreport[0]->pendingjobs;
        $this->data['pending_details'] = $pending_details;
        $this->data['jobcomp_details'] = $jobcomp_details;
        $this->data['pending_warrenty_cnt'] = $pending_warrenty_cnt;
        $this->data['jobcomp_warrenty_cnt'] = $jobcomp_warrenty_cnt;
        
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
