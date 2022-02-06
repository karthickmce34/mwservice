<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ComplaintRegisterModel extends BaseModel {
    
    public $table = 'complaint_register';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','seqno','mode_of_complaint','complaint_type','complaint_date','customer_name','address1','address2','city','state','pincode','phoneno','mobileno','gstin','panno','emailid','contact_person','salesorder_no','serial_no','panel_descrption','commissioned_date','complaint_nature','outgoing_load','relay_make_type','relay_status','cable_length','fault_current','vcb_interlock','after_commissioned','event_before_failure','warrenty','date_supply','complaint_status','document_status','solved_date','payment_status','order_status','remark','eheader_id','region_id','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('complaint_register.id','complaint_register.seqno','complaint_register.mode_of_complaint','complaint_register.complaint_type','complaint_register.complaint_date','complaint_register.customer_name','complaint_register.address1','complaint_register.address2','complaint_register.city','complaint_register.state','complaint_register.pincode','complaint_register.phoneno','complaint_register.mobileno','complaint_register.gstin','complaint_register.panno','complaint_register.emailid','complaint_register.contact_person','complaint_register.salesorder_no',
                                    'complaint_register.panel_descrption','complaint_register.commissioned_date','complaint_register.complaint_nature','complaint_register.serial_no',
                                   'complaint_register.outgoing_load','complaint_register.relay_make_type','complaint_register.relay_status','complaint_register.cable_length','complaint_register.fault_timestamp','complaint_register.vcb_interlock','complaint_register.after_commissioned',
                                   'complaint_register.event_before_failure','complaint_register.warrenty','complaint_register.date_supply','complaint_register.complaint_status','complaint_register.document_status','complaint_register.payment_status','complaint_register.order_status','complaint_register.solved_date','complaint_register.remark','complaint_register.eheader_id','complaint_register.region_id','complaint_register.created_by_id','complaint_register.status','complaint_register.created_at','complaint_register.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    public function registeraudits()
    {
        return $this->hasMany('App\Models\ComplaintRegisterAssetModel','complaint_register_id','id');
    }
    public function region()
    {
        return $this->hasOne('App\Models\RegionModel','id','region_id');
    }
}
