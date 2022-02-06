<?php

namespace App\Models;

use App\Models\BaseModel;


class OfferDetailsModel extends BaseModel {
    
    public $table = 'offer_details';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','service_spares_register_id','offer_date','revision_no','offervalidity','freight','deliveryperiod','paymentterms','dayscredit','terms','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('offer_details.id','offer_details.offer_date','offer_details.service_spares_register_id','offer_details.revision_no','offer_details.offervalidity','offer_details.freight','offer_details.deliveryperiod','offer_details.paymentterms','offer_details.dayscredit','offer_details.terms','offer_details.created_by_id','offer_details.status','offer_details.created_at','offer_details.updated_at');

    
    public function __construct()
    {
        parent::__construct();
    }

    public function registerprds()
    {
        return $this->hasMany('App\Models\ServiceSpareProductModel','offer_details_id','id')->where('invoicable',0)->where('isserviceproduct',0);
    }
}
