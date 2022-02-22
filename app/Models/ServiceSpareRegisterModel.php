<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ServiceSpareRegisterModel extends BaseModel {
    
    public $table = 'service_spares_register';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','complaint_register_id','complaint_type','site_eng_id','order_no','priority','paid_date','payment_mode','failure_cause','scope_of_work','scope_of_work_o','things_to_take','things_to_do','isbom','site_depute','po_ref','po_date','order_status','offer_date','pi_date','dispatch_date','advance_amt','total_gross_amt','payment_received','final_offer_id','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('service_spares_register.id','service_spares_register.complaint_register_id','service_spares_register.order_no','service_spares_register.complaint_type','service_spares_register.site_eng_id','service_spares_register.priority','service_spares_register.paid_date','service_spares_register.payment_mode','service_spares_register.failure_cause','service_spares_register.scope_of_work','service_spares_register.scope_of_work_o','service_spares_register.things_to_take','service_spares_register.things_to_do','service_spares_register.isbom','service_spares_register.site_depute','service_spares_register.po_ref','service_spares_register.po_date','service_spares_register.order_status','service_spares_register.offer_date','service_spares_register.pi_date','service_spares_register.dispatch_date','service_spares_register.advance_amt','service_spares_register.total_gross_amt','service_spares_register.payment_received','service_spares_register.final_offer_id','service_spares_register.created_by_id','service_spares_register.status','service_spares_register.created_at','service_spares_register.updated_at');

    
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
        return $this->hasMany('App\Models\ServiceSpareRegisterAssetModel','service_spares_register_id','id');
    }
    public function compreg()
    {
        return $this->hasOne('App\Models\ComplaintRegisterModel','id','complaint_register_id');
    }
    public function registerprds()
    {
        return $this->hasMany('App\Models\ServiceSpareProductModel','service_spares_register_id','id')->where('invoicable',0)->where('isserviceproduct',0);
    }
    public function thingstodos()
    {
        return $this->hasMany('App\Models\ServiceSpareThingstodoModel','service_spares_register_id','id');
    }
    
    public function prdtakens()
    {
        return $this->hasMany('App\Models\ServiceSpareProductModel','service_spares_register_id','id')->where('invoicable',1)->where('isserviceproduct',0);
    }
    
    public function sercharges()
    {
        return $this->hasMany('App\Models\ServiceSpareProductModel','service_spares_register_id','id')->where('invoicable',0)->where('isserviceproduct',1);
    }
    
    public function offerdata()
    {
        return $this->hasMany('App\Models\OfferDetailsModel','service_spares_register_id','id');
    }
    
    public function visitplan()
    {
        return $this->hasMany('App\Models\VisitplanModel','servicespare_id','id');
    }
}
