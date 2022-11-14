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
        $previousmonthstart= date("Y-m-d", strtotime("first day of previous month"));
        $previousmonthend =  date("Y-m-d", strtotime("last day of previous month"));
        $currentmonthstart = date('Y-m-01');
        $currentmonthend = date('Y-m-t');
        
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

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and service_spares_register.scope_of_work not like '%AMC%')A
                                    where A.orderstatus != 'No Data'
                                    group by A.orderstatus");
        
        $total_pending = DB::select("select count(A.orderstatus) as totalstatus from
                                            (select 
                                                CASE
                                                when service_spares_register.order_status = 0 then 'Enquiry Received'
                                                when service_spares_register.order_status = 1 then 'OfferSent'
                                                when service_spares_register.order_status = 2 then 'Po Received'
                                                when service_spares_register.order_status = 3 then 'PI Sent'
                                                when service_spares_register.order_status = 4 then 'Advance Received'
                                                when service_spares_register.order_status = 5 then 'Payment Received' 
                                                when service_spares_register.order_status = 8 then 'Visit Completed'
                                                when service_spares_register.order_status = 10 then 'Deputed' 
                                         	when service_spares_register.order_status = 12 then 'Visit Resscheduled' else 'No Data' end as orderstatus
                                                
                                    from 
                                        complaint_register,
                                        service_spares_register

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and service_spares_register.scope_of_work not like '%AMC%')A
                                    where A.orderstatus != 'No Data'");
        
        $job_pending = DB::select("select count(A.orderstatus) as cnt,A.orderstatus from
                                    (select 
                                                CASE
                                                when service_spares_register.order_status = 8 then 'Visit Completed'
                                                when service_spares_register.order_status = 10 then 'Deputed' 
                                         		when service_spares_register.order_status = 12 then 'Visit Resscheduled' else 'No Data' end as orderstatus
                                                
                                    from 
                                        complaint_register,
                                        service_spares_register

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and service_spares_register.scope_of_work not like '%AMC%')A
                                    where A.orderstatus != 'No Data'
                                    group by A.orderstatus");
        /*** AMC Related Query****/
        
        $amc_process_status = DB::select("select count(A.orderstatus) as cnt,A.orderstatus from
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

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and service_spares_register.scope_of_work  like '%AMC%')A
                                    where A.orderstatus != 'No Data'
                                    group by A.orderstatus");
        
        $amc_total_pending = DB::select("select count(A.orderstatus) as totalstatus from
                                            (select 
                                                CASE
                                                when service_spares_register.order_status = 0 then 'Enquiry Received'
                                                when service_spares_register.order_status = 1 then 'OfferSent'
                                                when service_spares_register.order_status = 2 then 'Po Received'
                                                when service_spares_register.order_status = 3 then 'PI Sent'
                                                when service_spares_register.order_status = 4 then 'Advance Received'
                                                when service_spares_register.order_status = 5 then 'Payment Received' 
                                                when service_spares_register.order_status = 8 then 'Visit Completed'
                                                when service_spares_register.order_status = 10 then 'Deputed' 
                                         	when service_spares_register.order_status = 12 then 'Visit Resscheduled' else 'No Data' end as orderstatus
                                                
                                    from 
                                        complaint_register,
                                        service_spares_register

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and service_spares_register.scope_of_work  like '%AMC%')A
                                    where A.orderstatus != 'No Data'");
        
        $amc_job_pending = DB::select("select count(A.orderstatus) as cnt,A.orderstatus from
                                    (select 
                                                CASE
                                                when service_spares_register.order_status = 8 then 'Visit Completed'
                                                when service_spares_register.order_status = 10 then 'Deputed' 
                                         		when service_spares_register.order_status = 12 then 'Visit Resscheduled' else 'No Data' end as orderstatus
                                                
                                    from 
                                        complaint_register,
                                        service_spares_register

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and service_spares_register.scope_of_work like '%AMC%')A
                                    where A.orderstatus != 'No Data'
                                    group by A.orderstatus");
        
        /** AMC QUery**/
        
        $job_process_status = DB::select("select count(A.pendingorderstatus) as cnt,A.pendingorderstatus from
                                            (select 
                                                CASE
                                                when service_spares_register.order_status = 0 then 'Process Pending'
                                                when service_spares_register.order_status = 1 then 'Process Pending'
                                                when service_spares_register.order_status = 2 then 'Process Pending'
                                                when service_spares_register.order_status = 3 then 'Process Pending'
                                                when service_spares_register.order_status = 4 then 'Process Pending'
                                                when service_spares_register.order_status = 5 then 'Process Pending' 
                                                when service_spares_register.order_status = 8 then 'Job Pending'
                                                when service_spares_register.order_status = 10 then 'Job Pending' 
                                         	when service_spares_register.order_status = 12 then 'Job Pending'
                                                when service_spares_register.order_status = 11 then 'Completed'
                                                else 'No Data' end as pendingorderstatus
                                                

                                    from 
                                        complaint_register,
                                        service_spares_register

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and complaint_register.complaint_date >= '$currentmonthstart'
                                    and complaint_register.complaint_date <= '$currentmonthend')A
                                    where A.pendingorderstatus != 'No Data'
                                    group by A.pendingorderstatus");
        $previous_job_process_status = DB::select("select count(A.pendingorderstatus) as cnt,A.pendingorderstatus from
                                            (select 
                                                CASE
                                                when service_spares_register.order_status = 0 then 'Process Pending'
                                                when service_spares_register.order_status = 1 then 'Process Pending'
                                                when service_spares_register.order_status = 2 then 'Process Pending'
                                                when service_spares_register.order_status = 3 then 'Process Pending'
                                                when service_spares_register.order_status = 4 then 'Process Pending'
                                                when service_spares_register.order_status = 5 then 'Process Pending' 
                                                when service_spares_register.order_status = 8 then 'Job Pending'
                                                when service_spares_register.order_status = 10 then 'Job Pending' 
                                         	when service_spares_register.order_status = 12 then 'Job Pending'
                                                when service_spares_register.order_status = 11 then 'Completed'
                                                else 'No Data' end as pendingorderstatus
                                                

                                    from 
                                        complaint_register,
                                        service_spares_register

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and complaint_register.complaint_date >= '$previousmonthstart'
                                    and complaint_register.complaint_date <= '$previousmonthend')A
                                    where A.pendingorderstatus != 'No Data'
                                    group by A.pendingorderstatus");
        
        $previous_expenses = DB::select("select sum(visitplan_summary.loading_expenses) as lodgeing_expenses,
                                            sum(visitplan_summary.boarding_expenses) as boarding_expenses,
                                        sum(visitplan_summary.travel_expenses) as travel_expenses,
                                        sum(visitplan_summary.local_conveyance) as local_conveyance
                                    from visitplan_summary 
                                    where visitplan_summary.date_of_complete >= '$previousmonthstart'
                                    and visitplan_summary.date_of_complete <= '$previousmonthend'
                                    and visitplan_summary.deleted_at is null");
        
        $current_expenses = DB::select("select sum(visitplan_summary.loading_expenses) as lodgeing_expenses,
                                            sum(visitplan_summary.boarding_expenses) as boarding_expenses,
                                        sum(visitplan_summary.travel_expenses) as travel_expenses,
                                        sum(visitplan_summary.local_conveyance) as local_conveyance
                                    from visitplan_summary 
                                    where visitplan_summary.date_of_complete >= '$currentmonthstart'
                                    and visitplan_summary.date_of_complete <= '$currentmonthend'                                    
                                    and visitplan_summary.deleted_at is null");
        
        $overall_expenses = DB::select("select sum(visitplan_summary.loading_expenses) as lodgeing_expenses,
                                            sum(visitplan_summary.boarding_expenses) as boarding_expenses,
                                        sum(visitplan_summary.travel_expenses) as travel_expenses,
                                        sum(visitplan_summary.local_conveyance) as local_conveyance
                                    from visitplan_summary 
                                    where visitplan_summary.date_of_complete <= '$currentmonthend'
                                    and visitplan_summary.deleted_at is null");
        
        $overall_received_expenses = DB::select("select sum(a.expenses) as expenses,sum(a.recieved) as recieved from 
                                    (select sum(visitplan_summary.loading_expenses) + 
                                            sum(visitplan_summary.boarding_expenses) +
                                        sum(visitplan_summary.travel_expenses) +
                                        sum(visitplan_summary.local_conveyance) as expenses,0 as recieved
                                    from visitplan_summary
                                    where visitplan_summary.date_of_complete <= '$currentmonthend' 
                                    and visitplan_summary.deleted_at is null
                                    UNION ALL
                                    select 0 as expenses,sum(service_spares_register.advance_amt) + sum(service_spares_register.payment_received) as recieved

                                    from service_spares_register
                                     where service_spares_register.deleted_at is null and service_spares_register.paid_date <= '$currentmonthend')a");
        
        $current_received_expenses = DB::select("select sum(a.expenses) as expenses,sum(a.recieved) as recieved from 
                                    (select sum(visitplan_summary.loading_expenses) + 
                                            sum(visitplan_summary.boarding_expenses) +
                                        sum(visitplan_summary.travel_expenses) +
                                        sum(visitplan_summary.local_conveyance) as expenses,0 as recieved
                                    from visitplan_summary
                                    where visitplan_summary.date_of_complete >= '$currentmonthstart'
                                    and visitplan_summary.date_of_complete <= '$currentmonthend'
                                    and visitplan_summary.deleted_at is null
                                    UNION ALL
                                    select 0 as expenses,sum(service_spares_register.advance_amt) + sum(service_spares_register.payment_received) as recieved

                                    from service_spares_register
                                     where service_spares_register.deleted_at is null
                                     and service_spares_register.paid_date >= '$currentmonthstart'
                                     and service_spares_register.paid_date <= '$currentmonthend')a");
        
        $previous_received_expenses = DB::select("select sum(a.expenses) as expenses,sum(a.recieved) as recieved from 
                                    (select sum(visitplan_summary.loading_expenses) + 
                                            sum(visitplan_summary.boarding_expenses) +
                                        sum(visitplan_summary.travel_expenses) +
                                        sum(visitplan_summary.local_conveyance) as expenses,0 as recieved
                                    from visitplan_summary
                                    where visitplan_summary.date_of_complete >= '$previousmonthstart'
                                    and visitplan_summary.date_of_complete <= '$previousmonthend'
                                    and visitplan_summary.deleted_at is null
                                    UNION ALL
                                    select 0 as expenses,sum(service_spares_register.advance_amt) + sum(service_spares_register.payment_received) as recieved

                                    from service_spares_register
                                     where service_spares_register.deleted_at is null
                                     and service_spares_register.paid_date >= '$previousmonthstart'
                                     and service_spares_register.paid_date <= '$previousmonthend')a");
        
        $scopeofwork = DB::select("SELECT count(scope_of_work) as cnt,replace(scope_of_work,'\"','') as scope_of_work 
                                    FROM complaint_register,service_spares_register 
                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and complaint_register.complaint_date >= '$currentmonthstart'
                                    and complaint_register.complaint_date <= '$currentmonthend'
                                    and scope_of_work != '' 
                                    group by scope_of_work");
        $previousscopeofwork = DB::select("SELECT count(scope_of_work) as cnt,replace(scope_of_work,'\"','') as scope_of_work 
                                    FROM complaint_register,service_spares_register 
                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and complaint_register.complaint_date >= '$previousmonthstart'
                                    and complaint_register.complaint_date <= '$previousmonthend'
                                    and scope_of_work != '' 
                                    group by scope_of_work");
        
        $job_status_uwarrenty = DB::select("select count(A.pendingorderstatus) as cnt,A.pendingorderstatus,'Under Warrenty' as warrenty from
                                            (select 
                                                CASE
                                                when service_spares_register.order_status = 0 then 'Process Pending'
                                                when service_spares_register.order_status = 1 then 'Process Pending'
                                                when service_spares_register.order_status = 2 then 'Process Pending'
                                                when service_spares_register.order_status = 3 then 'Process Pending'
                                                when service_spares_register.order_status = 4 then 'Process Pending'
                                                when service_spares_register.order_status = 5 then 'Process Pending' 
                                                when service_spares_register.order_status = 8 then 'Job Pending'
                                                when service_spares_register.order_status = 10 then 'Job Pending' 
                                         	when service_spares_register.order_status = 12 then 'Job Pending'
                                                when service_spares_register.order_status = 11 then 'Completed'
                                                else 'No Data' end as pendingorderstatus
                                                

                                    from 
                                        complaint_register,
                                        service_spares_register

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and complaint_register.complaint_date >= '$currentmonthstart'
                                    and complaint_register.complaint_date <= '$currentmonthend'
                                    and warrenty =0)A
                                    where A.pendingorderstatus != 'No Data'
                                    group by A.pendingorderstatus
                                    order by A.pendingorderstatus");
        
        $job_status_owarrenty = DB::select("select count(A.pendingorderstatus) as cnt,A.pendingorderstatus,'Under Warrenty' as warrenty from
                                            (select 
                                                CASE
                                                when service_spares_register.order_status = 0 then 'Process Pending'
                                                when service_spares_register.order_status = 1 then 'Process Pending'
                                                when service_spares_register.order_status = 2 then 'Process Pending'
                                                when service_spares_register.order_status = 3 then 'Process Pending'
                                                when service_spares_register.order_status = 4 then 'Process Pending'
                                                when service_spares_register.order_status = 5 then 'Process Pending' 
                                                when service_spares_register.order_status = 8 then 'Job Pending'
                                                when service_spares_register.order_status = 10 then 'Job Pending' 
                                         	when service_spares_register.order_status = 12 then 'Job Pending'
                                                when service_spares_register.order_status = 11 then 'Completed'
                                                else 'No Data' end as pendingorderstatus
                                                

                                    from 
                                        complaint_register,
                                        service_spares_register

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and complaint_register.complaint_date >= '$currentmonthstart'
                                    and complaint_register.complaint_date <= '$currentmonthend'
                                    and warrenty =1)A
                                    where A.pendingorderstatus != 'No Data'
                                    group by A.pendingorderstatus
                                    order by A.pendingorderstatus");
        
        $previous_expenses_engwise = DB::select("select service_engineer.name,sum(visit_expenses.loading_expenses)  + sum(visit_expenses.boarding_expenses) + sum(visit_expenses.travel_expenses) + sum(visit_expenses.local_expenses) as expenses
                                                from visitplan_summary,visit_expenses, service_engineer
                                                where visit_expenses.visitplan_summary_id = visitplan_summary.id
                                                and service_engineer.id = visit_expenses.engineer_id
                                                and visitplan_summary.date_of_complete >= '$previousmonthstart'
                                                and visitplan_summary.date_of_complete <= '$previousmonthend'                                    
                                                and visitplan_summary.deleted_at is null
                                                group by service_engineer.name");
        $current_expenses_engwise = DB::select("select service_engineer.name,sum(visit_expenses.loading_expenses)  + sum(visit_expenses.boarding_expenses) + sum(visit_expenses.travel_expenses) + sum(visit_expenses.local_expenses) as expenses
                                                from visitplan_summary,visit_expenses, service_engineer
                                                where visit_expenses.visitplan_summary_id = visitplan_summary.id
                                                and service_engineer.id = visit_expenses.engineer_id
                                                and visitplan_summary.date_of_complete >= '$currentmonthstart'
                                                and visitplan_summary.date_of_complete <= '$currentmonthend'                                    
                                                and visitplan_summary.deleted_at is null
                                                group by service_engineer.name");
        $overall_expenses_engwise = DB::select("select service_engineer.name,sum(visit_expenses.loading_expenses)  + sum(visit_expenses.boarding_expenses) + sum(visit_expenses.travel_expenses) + sum(visit_expenses.local_expenses) as expenses
                                                from visitplan_summary,visit_expenses, service_engineer
                                                where visit_expenses.visitplan_summary_id = visitplan_summary.id
                                                and service_engineer.id = visit_expenses.engineer_id
                                                and visitplan_summary.date_of_complete <= '$currentmonthend'                                    
                                                and visitplan_summary.deleted_at is null
                                                group by service_engineer.name");
        
       $jobdata=array();
       $processdata = array();
       $amcjobdata=array();
       $amcprocessdata = array();
       $processpencnt =0;
       $jobpencnt =0;
       $amcprocesspencnt =0;
       $amcjobpencnt =0;
       $jobprocessdata = array();
       $scopedata = array();
       $jobwarrentydata2 = array();
       $jobwarrentydata = array();
       $previousjobprocessdata = array();
       $previousscopedata = array();
       //print_r($total_pending[0]->totalstatus);die;
       foreach($process_status as $process)
       {
           $processdata[]=array($process->orderstatus ,$process->cnt);
           $processpencnt = $processpencnt + $process->cnt;
           //$processdata['processcnt'][] = $process->cnt;
       }
       foreach($job_pending as $job)
       {
           $jobdata[]=array($job->orderstatus ,$job->cnt);
           $jobpencnt = $jobpencnt + $job->cnt;
           //$processdata['processcnt'][] = $process->cnt;
       }
       foreach($amc_process_status as $amcprocess)
       {
           $amcprocessdata[]=array($amcprocess->orderstatus ,$amcprocess->cnt);
           $amcprocesspencnt = $amcprocesspencnt + $amcprocess->cnt;
           //$processdata['processcnt'][] = $process->cnt;
       }
       foreach($amc_job_pending as $amcjob)
       {
           $amcjobdata[]=array($amcjob->orderstatus ,$amcjob->cnt);
           $amcjobpencnt = $amcjobpencnt + $amcjob->cnt;
           //$processdata['processcnt'][] = $process->cnt;
       }
       $job_curcnt = 0;
       foreach($job_process_status as $jobprocess)
       {
           $jobprocessdata[]=array($jobprocess->pendingorderstatus ,$jobprocess->cnt);
           $job_curcnt = $job_curcnt+$jobprocess->cnt;
           //$processdata['processcnt'][] = $process->cnt;
       }
       $job_precnt = 0;
       foreach($previous_job_process_status as $previousjobprocess)
       {
           $previousjobprocessdata[]=array($previousjobprocess->pendingorderstatus ,$previousjobprocess->cnt);
           $job_precnt = $job_precnt+$previousjobprocess->cnt;
           //$processdata['processcnt'][] = $process->cnt;
       }
       foreach($scopeofwork as $scope)
       {
           $scopedata[]=array($scope->scope_of_work ,$scope->cnt);
           //$processdata['processcnt'][] = $process->cnt;
       }
       
       foreach($previousscopeofwork as $previousscope)
       {
           $previousscopedata[]=array($previousscope->scope_of_work ,$previousscope->cnt);
           //$processdata['processcnt'][] = $process->cnt;
       }
       $jobuwarrentydata = array();
       if($job_status_uwarrenty)
       {
           foreach($job_status_uwarrenty as $jobuwarrenty)
            {
                $jobuwarrentydata[]=array($jobuwarrenty->pendingorderstatus ,$jobuwarrenty->cnt);    
            }
       }
       
       $jobowarrentydata = array();
       if($job_status_owarrenty)
       {
           foreach($job_status_owarrenty as $jobowarrenty)
            {
                $jobowarrentydata[]=array($jobowarrenty->pendingorderstatus ,$jobowarrenty->cnt);    
            }
       }
       
       $overall_exp_engwise = array();
       $previous_exp_engwise = array();
       $current_exp_engwise = array();
       
       foreach($previous_expenses_engwise as $previous_exp_ew)
       {
           $previous_exp_engwise[] = array($previous_exp_ew->name,$previous_exp_ew->expenses);
       }
       
       foreach($current_expenses_engwise as $current_exp_ew)
       {
           $current_exp_engwise[] = array($current_exp_ew->name,$current_exp_ew->expenses);
       }
       
       foreach($overall_expenses_engwise as $overall_exp_ew)
       {
           $overall_exp_engwise[] = array($overall_exp_ew->name,$overall_exp_ew->expenses);
       }
       //die;
      /**************for overall expenses**************/
       
       $overall_expensedata[]=array('Lodgeing Expenses',$overall_expenses[0]->lodgeing_expenses);
       $overall_expensedata[]=array('Boarding Expenses',$overall_expenses[0]->boarding_expenses);
       $overall_expensedata[]=array('Travel Expenses',$overall_expenses[0]->travel_expenses);
       $overall_expensedata[]=array('Local Conveyance',$overall_expenses[0]->local_conveyance);
       
       $current_expensedata[]=array('Lodgeing Expenses',$current_expenses[0]->lodgeing_expenses);
       $current_expensedata[]=array('Boarding Expenses',$current_expenses[0]->boarding_expenses);
       $current_expensedata[]=array('Travel Expenses',$current_expenses[0]->travel_expenses);
       $current_expensedata[]=array('Local Conveyance',$current_expenses[0]->local_conveyance);
       
       $previous_expensedata[]=array('Lodgeing Expenses',$previous_expenses[0]->lodgeing_expenses);
       $previous_expensedata[]=array('Boarding Expenses',$previous_expenses[0]->boarding_expenses);
       $previous_expensedata[]=array('Travel Expenses',$previous_expenses[0]->travel_expenses);
       $previous_expensedata[]=array('Local Conveyance',$previous_expenses[0]->local_conveyance);
       
       $overallexptotal = ($overall_expenses[0]->lodgeing_expenses+$overall_expenses[0]->boarding_expenses+$overall_expenses[0]->travel_expenses+$overall_expenses[0]->local_conveyance);
       $currentexptotal = ($current_expenses[0]->lodgeing_expenses+$current_expenses[0]->boarding_expenses+$current_expenses[0]->travel_expenses+$current_expenses[0]->local_conveyance);
       $previousexptotal = ($previous_expenses[0]->lodgeing_expenses+$previous_expenses[0]->boarding_expenses+$previous_expenses[0]->travel_expenses+$previous_expenses[0]->local_conveyance);

       //print_r($previous_expensedata);die;
       
       $overall_received_expensedata[]=array('Received',$overall_received_expenses[0]->recieved);
       $overall_received_expensedata[]=array('Expenses',$overall_received_expenses[0]->expenses);
       
       $current_received_expensedata[]=array('Received',$current_received_expenses[0]->recieved);
       $current_received_expensedata[]=array('Expenses',$current_received_expenses[0]->expenses);
       
       $previous_received_expensedata[]=array('Received',$previous_received_expenses[0]->recieved);
       $previous_received_expensedata[]=array('Expenses',$previous_received_expenses[0]->expenses);
       
        //print_r($scopedata);die;
        $data['process_status']=$processdata;
        $data['amcprocess_status']=$amcprocessdata;
        $data['pendingorder'] = $total_pending[0]->totalstatus;
        $data['job_status']=$jobdata;
        $data['amcjob_status']=$amcjobdata;
        $data['jobprocess_status']=$jobprocessdata;
        $data['previousjobprocess_status']=$previousjobprocessdata;
        $data['overall_expenses']=$overall_expensedata;
        $data['current_expenses']=$current_expensedata;
        $data['previous_expenses']=$previous_expensedata;
        $data['processpencnt']=$processpencnt;
        $data['jobpencnt']=$jobpencnt;
        $data['amcprocesspencnt']=$amcprocesspencnt;
        $data['amcjobpencnt']=$amcjobpencnt;
        
        $data['job_precnt']=$job_precnt;
        $data['job_curcnt']=$job_curcnt;
        
        $data['overallexptotal'] = $overallexptotal;
        $data['currentexptotal'] = $currentexptotal;
        $data['previousexptotal'] = $previousexptotal;
        
        $data['overall_received_expensedata'] = $overall_received_expensedata;
        $data['current_received_expensedata'] = $current_received_expensedata;
        $data['previous_received_expensedata'] = $previous_received_expensedata;
        
        $data['scopeofwork'] = $scopedata;
        $data['previousscopeofwork'] = $previousscopedata;
        
        $data['jobuwarrentydata']=$jobuwarrentydata;
        $data['jobowarrentydata']=$jobowarrentydata;//$jobwarrentydata2;
        
        $data['jobprev_exp_engwise'] = $previous_exp_engwise;
        $data['jobcur_exp_engwise'] = $current_exp_engwise;
        $data['joboverall_exp_engwise'] = $overall_exp_engwise;
        //echo "<pre>";
        //print_r($data);die;
        return view($this->basePath . $this->baseName,$data);
    }
    
    public function statusdata()
    {
        $previousmonthstart= date("Y-m-d", strtotime("first day of previous month"));
        $previousmonthend =  date("Y-m-d", strtotime("last day of previous month"));
        $currentmonthstart = date('Y-m-01');
        $currentmonthend = date('Y-m-t');
        
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
                                    and service_spares_register.deleted_at is null
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
                                    and service_spares_register.deleted_at is null
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
                                    and service_spares_register.deleted_at is null
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
                                    and service_spares_register.deleted_at is null
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
        $previousmonthstart= date("Y-m-d", strtotime("first day of previous month"));
        $previousmonthend =  date("Y-m-d", strtotime("last day of previous month"));
        $currentmonthstart = date('Y-m-01');
        $currentmonthend = date('Y-m-t');
        
        $inputs = request()->all();
        
        $ordervalue = StatusReportController::$ORDER_TYPE_VALUES[$inputs['orderstatus']];
        
        $servicedata = DB::select("select distinct complaint_register.seqno,complaint_register.customer_name,
                                    complaint_register.complaint_date,
                                    complaint_register.mobileno,
                                    case when complaint_register.salesorder_no is null then '' else complaint_register.salesorder_no end as salesorder_no,complaint_register.warrenty,
                                    replace(service_spares_register.scope_of_work,'\"','') as scope_of_work
                                    from 
                                        complaint_register,
                                        service_spares_register
                                        left join visit_plan on visit_plan.servicespare_id = service_spares_register.id and visit_plan.deleted_at is null
                                        left join visitplan_engineer on  visit_plan.id = visitplan_engineer.visitplan_id and visitplan_engineer.deleted_at is null
                                        left join service_engineer on service_engineer.id = visitplan_engineer.engineer_id
                                        left join service_agent on service_agent.id = visit_plan.agent_id
                                        left join visitplan_summary on visitplan_summary.visitplan_id = visit_plan.id

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and service_spares_register.scope_of_work not like '%AMC%'
                                    and service_spares_register.order_status = $ordervalue order by complaint_register.seqno");
        $this->data['status']=1;
        $this->data['servicedata']=$servicedata;
       // print_r($inputs);die;
        //$this->data['servicedata']=$servicedata;
        return response()->json($this->data);
    }
    
    public function amcstatusdetails()
    {
        $previousmonthstart= date("Y-m-d", strtotime("first day of previous month"));
        $previousmonthend =  date("Y-m-d", strtotime("last day of previous month"));
        $currentmonthstart = date('Y-m-01');
        $currentmonthend = date('Y-m-t');
        
        $inputs = request()->all();
        
        $ordervalue = StatusReportController::$ORDER_TYPE_VALUES[$inputs['orderstatus']];
        
        $servicedata = DB::select("select distinct complaint_register.seqno,complaint_register.customer_name,
                                    complaint_register.complaint_date,
                                    complaint_register.mobileno,
                                    case when complaint_register.salesorder_no is null then '' else complaint_register.salesorder_no end as salesorder_no,complaint_register.warrenty,
                                    replace(service_spares_register.scope_of_work,'\"','') as scope_of_work
                                    from 
                                        complaint_register,
                                        service_spares_register
                                        left join visit_plan on visit_plan.servicespare_id = service_spares_register.id and visit_plan.deleted_at is null
                                        left join visitplan_engineer on  visit_plan.id = visitplan_engineer.visitplan_id and visitplan_engineer.deleted_at is null
                                        left join service_engineer on service_engineer.id = visitplan_engineer.engineer_id
                                        left join service_agent on service_agent.id = visit_plan.agent_id
                                        left join visitplan_summary on visitplan_summary.visitplan_id = visit_plan.id

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and service_spares_register.scope_of_work like '%AMC%'
                                    and service_spares_register.order_status = $ordervalue order by complaint_register.seqno");
        $this->data['status']=1;
        $this->data['servicedata']=$servicedata;
       // print_r($inputs);die;
        //$this->data['servicedata']=$servicedata;
        return response()->json($this->data);
    }
    
    public function jb_compltedreport()
    {
        $previousmonthstart= date("Y-m-d", strtotime("first day of previous month"));
        $previousmonthend =  date("Y-m-d", strtotime("last day of previous month"));
        $currentmonthstart = date('Y-m-01');
        $currentmonthend = date('Y-m-t');
        
        $inputs = request()->all();
        
        $ordervalue = $inputs['orderstatus'];
        $type = $inputs['type'];
        
        if($ordervalue == 'Process Pending')
        {
            $ordvalue = '0,1,2,3,4,5';
        }
        else
        {
            if($ordervalue == 'Job Pending')
            {
                $ordvalue = '8,10,12';
            }
            else
            {
                $ordvalue = '11';
            }
        }
        
        if($type == 'current')
        {
            $date = " and complaint_register.complaint_date >= '$currentmonthstart'
                                    and complaint_register.complaint_date <= '$currentmonthend'";
        }
        else
        {
            $date = " and complaint_register.complaint_date >= '$previousmonthstart'
                                    and complaint_register.complaint_date <= '$previousmonthend'";
        }
        
        $servicedata = DB::select("select distinct complaint_register.seqno,complaint_register.customer_name,
                                    complaint_register.complaint_date,
                                    complaint_register.mobileno,
                                    case when complaint_register.salesorder_no is null then '' else complaint_register.salesorder_no end as salesorder_no,complaint_register.warrenty,
                                    replace(service_spares_register.scope_of_work,'\"','') as scope_of_work
                                    from 
                                        complaint_register,
                                        service_spares_register
                                        left join visit_plan on visit_plan.servicespare_id = service_spares_register.id and visit_plan.deleted_at is null
                                        left join visitplan_engineer on  visit_plan.id = visitplan_engineer.visitplan_id and visitplan_engineer.deleted_at is null
                                        left join service_engineer on service_engineer.id = visitplan_engineer.engineer_id
                                        left join service_agent on service_agent.id = visit_plan.agent_id
                                        left join visitplan_summary on visitplan_summary.visitplan_id = visit_plan.id

                                    where complaint_register.id = service_spares_register.complaint_register_id
                                    and service_spares_register.deleted_at is null
                                    and complaint_register.complaint_type = 0
                                    and service_spares_register.order_status in (".$ordvalue.") ".$date." order by complaint_register.seqno");
        $this->data['status']=1;
        $this->data['servicedata']=$servicedata;
       // print_r($inputs);die;
        //$this->data['servicedata']=$servicedata;
        return response()->json($this->data);
    }
    
    public function ex_compltedreport()
    {
        $previousmonthstart= date("Y-m-d", strtotime("first day of previous month"));
        $previousmonthend =  date("Y-m-d", strtotime("last day of previous month"));
        $currentmonthstart = date('Y-m-01');
        $currentmonthend = date('Y-m-t');
        
        $inputs = request()->all();
        
        $ordervalue = $inputs['orderstatus'];
        $type = $inputs['type'];
        
        
        
        if($type == 'current')
        {
            $date = " and complaint_register.complaint_date >= '$currentmonthstart'
                                    and complaint_register.complaint_date <= '$currentmonthend'";
        }
        else
        {
            if($type == 'previous')
            {
                $date = " and complaint_register.complaint_date >= '$previousmonthstart'
                                        and complaint_register.complaint_date <= '$previousmonthend'";
            }
            else
            {
                $date = " and complaint_register.complaint_date <= '$currentmonthend'";
            }
                
        }
        
        $servicedata = DB::select("select complaint_register.seqno,complaint_register.customer_name,
                                    complaint_register.complaint_date,
                                    visitplan_summary.date_of_attend,
                                    visitplan_summary.date_of_complete,
                                    GROUP_CONCAT(service_engineer.name) as serviceengineer,
                                    replace(service_spares_register.scope_of_work,'\"','') as scope_of_work,
                                    visitplan_summary.loading_expenses,
                                    visitplan_summary.boarding_expenses,
                                    visitplan_summary.travel_expenses,
                                    visitplan_summary.local_conveyance
                                    from visitplan_summary,visit_plan,complaint_register,visitplan_engineer,service_engineer,service_spares_register 
                                    where visitplan_summary.visitplan_id = visit_plan.id
                                    and visit_plan.complaint_register_id = complaint_register.id
                                    and service_spares_register.complaint_register_id = complaint_register.id
                                    and service_spares_register.deleted_at is null
                                    and visit_plan.id = visitplan_engineer.visitplan_id
                                    and service_engineer.id = visitplan_engineer.engineer_id
                                    and visit_plan.status=1
                                    and visit_plan.deleted_at is null
                                    $date
                                    and visitplan_summary.deleted_at is null
                                    group by complaint_register.complaint_date,
                                    complaint_register.seqno,
                                    complaint_register.customer_name,
                                    service_spares_register.scope_of_work,
                                    visitplan_summary.date_of_attend,
                                    visitplan_summary.date_of_complete,
                                    visitplan_summary.loading_expenses,
                                    visitplan_summary.boarding_expenses,
                                    visitplan_summary.travel_expenses,
                                    visitplan_summary.local_conveyance
                                    order by  complaint_register.complaint_date,complaint_register.seqno  ");
        $this->data['status']=1;
        $this->data['servicedata']=$servicedata;
       // print_r($inputs);die;
        //$this->data['servicedata']=$servicedata;
        return response()->json($this->data);
    }
    
    public function received_exp_report()
    {
        $inputs = request()->all();
        
        $ordervalue = $inputs['orderstatus'];
        $type = $inputs['type'];
        
        $previousmonthstart= date("Y-m-d", strtotime("first day of previous month"));
        $previousmonthend =  date("Y-m-d", strtotime("last day of previous month"));
        $currentmonthstart = date('Y-m-01');
        $currentmonthend = date('Y-m-t');
        
        
        
        if($ordervalue == 'Received')
        {
            if($type == 'current')
            {
                $date = " and service_spares_register.paid_date >= '$currentmonthstart'
                                        and service_spares_register.paid_date <= '$currentmonthend'";
            }
            else
            {
                if($type == 'previous')
                {
                    $date = " and service_spares_register.paid_date >= '$previousmonthstart'
                                            and service_spares_register.paid_date <= '$previousmonthend'";
                }
                else
                {
                    $date = " and service_spares_register.paid_date <= '$currentmonthend'";
                }

            }
            
            $servicedata = DB::select("SELECT complaint_register.seqno,complaint_register.customer_name,
                                            complaint_register.complaint_date,
                                            case when complaint_register.salesorder_no is null then '' else complaint_register.salesorder_no end as salesorder_no,
                                            GROUP_CONCAT(coalesce(service_engineer.name,'')) as serviceengineer,
                                            replace(service_spares_register.scope_of_work,'\"','') as scope_of_work,
                                            coalesce(service_spares_register.advance_amt,0) + coalesce(service_spares_register.payment_received,0) as incomeamt
                                        FROM complaint_register,
                                            service_spares_register
                                               left join visit_plan on visit_plan.servicespare_id = service_spares_register.id and visit_plan.status=1 and visit_plan.deleted_at is null
                                               left join visitplan_engineer on visit_plan.id = visitplan_engineer.visitplan_id
                                               left join service_engineer on service_engineer.id = visitplan_engineer.engineer_id

                                        where service_spares_register.complaint_register_id = complaint_register.id
                                        and service_spares_register.deleted_at is null
                                        and coalesce(service_spares_register.advance_amt,0) + coalesce(service_spares_register.payment_received,0) > 0 
                                        $date 
                                        group by complaint_register.complaint_date,
                                            complaint_register.seqno,
                                            complaint_register.customer_name,
                                            complaint_register.salesorder_no,
                                            service_spares_register.scope_of_work,
                                            service_spares_register.advance_amt,
                                            service_spares_register.payment_received
                                        order by  complaint_register.complaint_date,complaint_register.seqno   ");
        }
        else
        {
            if($type == 'current')
            {
                $date = " and visitplan_summary.date_of_complete >= '$currentmonthstart'
                                    and visitplan_summary.date_of_complete <= '$currentmonthend'";
            }
            else
            {
                if($type == 'previous')
                {
                    $date = " and visitplan_summary.date_of_complete >= '$previousmonthstart'
                                    and visitplan_summary.date_of_complete <= '$previousmonthend'";
                }
                else
                {
                    $date = " and visitplan_summary.date_of_complete <= '$currentmonthend'";
                }

            }
            $servicedata = DB::select("select complaint_register.seqno,complaint_register.customer_name,
                                        complaint_register.complaint_date,
                                        case when complaint_register.salesorder_no is null then '' else complaint_register.salesorder_no end as salesorder_no,
                                        visitplan_summary.date_of_attend,
                                        visitplan_summary.date_of_complete,
                                        GROUP_CONCAT(service_engineer.name) as serviceengineer,
                                        replace(service_spares_register.scope_of_work,'\"','') as scope_of_work,
                                        visit_expenses.loading_expenses + visit_expenses.boarding_expenses + visit_expenses.travel_expenses +
                                        visit_expenses.local_expenses as expenses
                                        from visitplan_summary,visit_expenses,visit_plan,complaint_register,service_spares_register,visitplan_engineer,service_engineer 
                                        where visitplan_summary.visitplan_id = visit_plan.id
                                        and visit_expenses.visitplan_summary_id = visitplan_summary.id
                                        and visit_plan.complaint_register_id = complaint_register.id
                                        and visit_plan.id = visitplan_engineer.visitplan_id
                                        and service_engineer.id = visit_expenses.engineer_id
                                        and service_spares_register.complaint_register_id = complaint_register.id
                                        and service_spares_register.deleted_at is null
                                        and visit_plan.status=1
                                        and visit_plan.deleted_at is null
                                        $date
                                        and visitplan_summary.deleted_at is null
                                        group by complaint_register.complaint_date,
                                        complaint_register.seqno,
                                        complaint_register.customer_name,
                                        complaint_register.salesorder_no,
                                        service_spares_register.scope_of_work,
                                        visitplan_summary.date_of_attend,
                                        visitplan_summary.date_of_complete,
                                        visit_expenses.loading_expenses,
                                        visit_expenses.boarding_expenses,
                                        visit_expenses.travel_expenses,
                                        visit_expenses.local_expenses
                                        order by  complaint_register.complaint_date,complaint_register.seqno  ");
            
        }
        
            
        $this->data['status']=1;
        
        $this->data['servicedata']=$servicedata;
       // print_r($inputs);die;
        //$this->data['servicedata']=$servicedata;
        return response()->json($this->data);
    }
    
    public function scopeofwork_report()
    {
        $inputs = request()->all();
        
        $ordervalue = $inputs['orderstatus'];
        $type = $inputs['type'];
        
        $previousmonthstart= date("Y-m-d", strtotime("first day of previous month"));
        $previousmonthend =  date("Y-m-d", strtotime("last day of previous month"));
        $currentmonthstart = date('Y-m-01');
        $currentmonthend = date('Y-m-t');
        
        
        
        if($type == 'current')
        {
            $date = " and complaint_register.complaint_date >= '$currentmonthstart'
                                    and complaint_register.complaint_date <= '$currentmonthend'";
        }
        else
        {
            $date = " and complaint_register.complaint_date >= '$previousmonthstart'
                                        and complaint_register.complaint_date <= '$previousmonthend'";

        }
            
            $servicedata = DB::select("select distinct complaint_register.seqno,complaint_register.customer_name,
                                                        complaint_register.complaint_date,
                                                        complaint_register.mobileno,
                                                        GROUP_CONCAT(coalesce(service_engineer.name,'')) as serviceengineer,
                                                        case when complaint_register.salesorder_no is null then '' else complaint_register.salesorder_no end as salesorder_no,
                                                        replace(service_spares_register.scope_of_work,'\"','') as scope_of_work,
                                                        sum(coalesce(service_spares_register.advance_amt,0)) + sum(coalesce(service_spares_register.payment_received,0)) as incomeamt,
                                                        sum(coalesce(visitplan_summary.loading_expenses,0)) +  sum(coalesce(visitplan_summary.boarding_expenses,0)) + sum(coalesce(visitplan_summary.travel_expenses,0)) + sum(coalesce(visitplan_summary.local_conveyance,0)) as expenses
                                                        
                                                        from 
                                                            complaint_register,
                                                            service_spares_register
                                                            left join visit_plan on visit_plan.servicespare_id = service_spares_register.id and visit_plan.deleted_at is null
                                                            left join visitplan_engineer on  visit_plan.id = visitplan_engineer.visitplan_id and visitplan_engineer.deleted_at is null
                                                            left join service_engineer on service_engineer.id = visitplan_engineer.engineer_id
                                                            left join service_agent on service_agent.id = visit_plan.agent_id
                                                            left join visitplan_summary on visitplan_summary.visitplan_id = visit_plan.id

                                                        where complaint_register.id = service_spares_register.complaint_register_id
                                                        and service_spares_register.deleted_at is null
                                                        and complaint_register.complaint_type = 0 ".$date ."
                                                        and scope_of_work like  '%$ordervalue%' 
                                                        group by complaint_register.seqno,
                                                                complaint_register.customer_name,
                                                                complaint_register.complaint_date,
                                                                complaint_register.mobileno,
                                                                complaint_register.salesorder_no,
                                                                service_spares_register.scope_of_work
                                                        order by complaint_register.seqno
                                                            ");
            
        $this->data['status']=1;
        
        $this->data['servicedata']=$servicedata;
       // print_r($inputs);die;
        //$this->data['servicedata']=$servicedata;
        return response()->json($this->data);
    }
    
    public function engineer_exp_report()
    {
        $previousmonthstart= date("Y-m-d", strtotime("first day of previous month"));
        $previousmonthend =  date("Y-m-d", strtotime("last day of previous month"));
        $currentmonthstart = date('Y-m-01');
        $currentmonthend = date('Y-m-t');
        
        $inputs = request()->all();
        
        $engineername = $inputs['engineername'];
        $type = $inputs['type'];
        
        
        if($type == 'current')
        {
            $date = " and visitplan_summary.date_of_complete >= '$currentmonthstart'
                                and visitplan_summary.date_of_complete <= '$currentmonthend'";
        }
        else
        {
            if($type == 'previous')
            {
                $date = " and visitplan_summary.date_of_complete >= '$previousmonthstart'
                                and visitplan_summary.date_of_complete <= '$previousmonthend'";
            }
            else
            {
                $date = " and visitplan_summary.date_of_complete <= '$currentmonthend'";
            }

        }
        $servicedata = DB::select("select complaint_register.seqno,complaint_register.customer_name,
                                    complaint_register.complaint_date,
                                    case when complaint_register.salesorder_no is null then '' else complaint_register.salesorder_no end as salesorder_no,
                                    visitplan_summary.date_of_attend,
                                    visitplan_summary.date_of_complete,
                                    service_engineer.name as serviceengineer,
                                    replace(service_spares_register.scope_of_work,'\"','') as scope_of_work,
                                    visit_expenses.loading_expenses + visit_expenses.boarding_expenses + visit_expenses.travel_expenses +
                                    visit_expenses.local_expenses as expenses
                                    from visitplan_summary,visit_expenses,visit_plan,complaint_register,service_spares_register,visitplan_engineer,service_engineer 
                                    where visitplan_summary.visitplan_id = visit_plan.id
                                    and visit_expenses.visitplan_summary_id = visitplan_summary.id
                                    and visit_plan.complaint_register_id = complaint_register.id
                                    and visit_plan.id = visitplan_engineer.visitplan_id
                                    and service_engineer.id = visit_expenses.engineer_id
                                    and service_spares_register.complaint_register_id = complaint_register.id
                                    and service_spares_register.deleted_at is null
                                    and visit_plan.status=1
                                    and visit_plan.deleted_at is null
                                    and service_engineer.name like '$engineername'
                                    $date
                                    and visitplan_summary.deleted_at is null
                                    order by  complaint_register.complaint_date,complaint_register.seqno  ");
        
            
        $this->data['status']=1;
        
        $this->data['servicedata']=$servicedata;
       // print_r($inputs);die;
        //$this->data['servicedata']=$servicedata;
        return response()->json($this->data);
    }
}
