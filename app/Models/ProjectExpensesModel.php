<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ProjectExpensesModel extends BaseModel {
    
    public $table = 'project_expenses';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','project_summary_id','project_id','is_agent','engineer_id','loading_expenses','boarding_expenses','travel_expenses','local_expenses','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('project_expenses.id','project_expenses.project_summary_id','project_expenses.project_id','project_expenses.is_agent','project_expenses.engineer_id','project_expenses.loading_expenses','project_expenses.boarding_expenses','project_expenses.travel_expenses','project_expenses.local_expenses','project_expenses.created_by_id','project_expenses.status','project_expenses.created_at','project_expenses.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    
    public function projectsummary()
    {
        return $this->hasOne('App\Models\ProjectSummaryModel','id','project_summary_id');
    }
    
    public function engineer()
    {
        return $this->hasOne('App\Models\ServiceEngineerModel','id','engineer_id');
    }
    
}
