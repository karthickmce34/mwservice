<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class VisitplanSummaryLineModel extends BaseModel {
    
    public $table = 'visitplan_summaryline';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','visitplan_summary_id','things_to_do_id','remarks','ischecked','file_name','file_path','file_type','file_ext','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('visitplan_summaryline.id','visitplan_summaryline.visitplan_summary_id','visitplan_summaryline.things_to_do_id','visitplan_summaryline.remarks','visitplan_summaryline.ischecked','visitplan_summaryline.file_name','visitplan_summaryline.file_path','visitplan_summaryline.file_type','visitplan_summaryline.file_ext','visitplan_summaryline.created_by_id','visitplan_summaryline.status','visitplan_summaryline.created_at','visitplan_summaryline.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    
    public function visitsummary()
    {
        return $this->hasOne('App\Models\VisitplanSummaryModel','id','visitplan_summary_id');
    }
    
    public function thingstodo()
    {
        return $this->hasOne('App\Models\ServiceSpareThingstodoModel','id','things_to_do_id');
    }
    
}
