<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class VisitplanSummaryModel extends BaseModel {
    
    public $table = 'visitplan_summary';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','visitplan_id','is_agent','date_of_attend','date_of_complete','days_site','loading_expenses','boarding_expenses','travel_expenses','local_conveyance','work_description','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('visitplan_summary.id','visitplan_summary.visitplan_id','visitplan_summary.is_agent','visitplan_summary.date_of_attend','visitplan_summary.date_of_complete','visitplan_summary.days_site','visitplan_summary.loading_expenses','visitplan_summary.boarding_expenses','visitplan_summary.travel_expenses','visitplan_summary.local_conveyance','visitplan_summary.work_description','visitplan_summary.created_by_id','visitplan_summary.status','visitplan_summary.created_at','visitplan_summary.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    
    public function visitplan()
    {
        return $this->hasOne('App\Models\VisitplanModel','id','visitplan_id');
    }
    
    public function visitlines()
    {
        return $this->hasMany('App\Models\VisitplanSummaryLineModel','visitplan_summary_id','id');
    }
}
