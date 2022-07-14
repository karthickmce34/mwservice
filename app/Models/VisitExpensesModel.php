<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class VisitExpensesModel extends BaseModel {
    
    public $table = 'visit_expenses';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','visitplan_summary_id','visitplan_id','is_agent','engineer_id','loading_expenses','boarding_expenses','travel_expenses','local_expenses','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('visit_expenses.id','visit_expenses.visitplan_summary_id','visit_expenses.visitplan_id','visit_expenses.is_agent','visit_expenses.engineer_id','visit_expenses.loading_expenses','visit_expenses.boarding_expenses','visit_expenses.travel_expenses','visit_expenses.local_expenses','visit_expenses.created_by_id','visit_expenses.status','visit_expenses.created_at','visit_expenses.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    
    public function visitplansummary()
    {
        return $this->hasOne('App\Models\VisitplanSummaryModel','id','visitplan_summary_id');
    }
    
    
}
