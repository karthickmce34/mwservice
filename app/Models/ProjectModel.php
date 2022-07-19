<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ProjectModel extends BaseModel {
    
    public $table = 'project_plan';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','is_agent','engineer_id','project_name','site_details','visit_date','approval_status','visit_status','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('project_plan.id','project_plan.is_agent','project_plan.engineer_id','project_plan.project_name','project_plan.site_details','project_plan.visit_date','project_plan.approval_status','project_plan.visit_status','project_plan.created_by_id','project_plan.status','project_plan.created_at','project_plan.updated_at');

    
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
        return $this->hasOne('App\Models\ProjectSummaryModel','project_id','id');
    }
    
    public function engineer()
    {
        return $this->hasOne('App\Models\ServiceEngineerModel','id','engineer_id');
    }
    
}
