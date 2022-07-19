<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class VisitplanSummaryModel extends BaseModel {
    
    public $table = 'visitplan_summary';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','visitplan_id','is_agent','date_of_attend','date_of_complete','days_site','loading_expenses','boarding_expenses','travel_expenses','local_conveyance','invoice_bill','work_description','file_name','file_path','lodgingbill_file_path','lodgingbill_file_name','travelbill_file_name','travelbill_file_path','sld_file_path','sld_file_name','panelfront_file_path','panelfront_file_name','panelleft_file_path','panelleft_file_name','panelright_file_path','panelright_file_name','panelinside_file_path','panelinside_file_name','outgoing_load','invoicebill_file_name','invoicebill_file_path','relay_make_type','cable_length','fault_current','vcb_interlock','after_commissioned','event_before_failure','serial_no','transformer_rating','others','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('visitplan_summary.id','visitplan_summary.visitplan_id','visitplan_summary.is_agent','visitplan_summary.date_of_attend','visitplan_summary.date_of_complete','visitplan_summary.days_site','visitplan_summary.loading_expenses','visitplan_summary.boarding_expenses','visitplan_summary.travel_expenses','visitplan_summary.local_conveyance','visitplan_summary.invoice_bill','visitplan_summary.work_description','visitplan_summary.file_name','visitplan_summary.file_path','visitplan_summary.lodgingbill_file_path','visitplan_summary.lodgingbill_file_name','visitplan_summary.travelbill_file_name','visitplan_summary.travelbill_file_path','visitplan_summary.sld_file_path','visitplan_summary.sld_file_name','visitplan_summary.panelfront_file_path','visitplan_summary.panelfront_file_name','visitplan_summary.panelleft_file_path','visitplan_summary.panelleft_file_name','visitplan_summary.panelright_file_path','visitplan_summary.panelright_file_name','visitplan_summary.panelinside_file_path','visitplan_summary.panelinside_file_name','visitplan_summary.invoicebill_file_name','visitplan_summary.invoicebill_file_path','visitplan_summary.outgoing_load','visitplan_summary.relay_make_type','visitplan_summary.cable_length','visitplan_summary.fault_current','visitplan_summary.vcb_interlock','visitplan_summary.after_commissioned','visitplan_summary.event_before_failure','visitplan_summary.serial_no','visitplan_summary.transformer_rating','visitplan_summary.others','visitplan_summary.created_by_id','visitplan_summary.status','visitplan_summary.created_at','visitplan_summary.updated_at');

    
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
    
    public function visitsummaryAsset()
    {
        return $this->hasMany('App\Models\VisitplanSummaryAssetModel','visitplan_summary_id','id');
    }
    
    public function visitsummaryProduct()
    {
        return $this->hasMany('App\Models\VisitplanSummaryProductModel','visitplan_summary_id','id');
    }
}
