<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ProjectSummaryModel extends BaseModel {
    
    public $table = 'project_summary';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','project_id','engineer_id','lodgingbill_file_path','lodgingbill_file_name','travelbill_file_path','travelbill_file_name','site_file_path','site_file_name','visit_status','work_description','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('project_summary.id','project_summary.project_id','project_summary.engineer_id','project_summary.lodgingbill_file_path','project_summary.lodgingbill_file_name','project_summary.travelbill_file_path','project_summary.travelbill_file_name','project_summary.site_file_path','project_summary.site_file_name','project_summary.visit_status','project_summary.work_description','project_summary.created_by_id','project_summary.status','project_summary.created_at','project_summary.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    
    public function projectplan()
    {
        return $this->hasOne('App\Models\projectModel','id','project_id');
    }

    public function engineer()
    {
        return $this->hasOne('App\Models\ServiceEngineerModel','id','engineer_id');
    }
    
    public function expense()
    {
        return $this->hasOne('App\Models\ProjectExpensesModel','project_summary_id','id');
    }
    
}
