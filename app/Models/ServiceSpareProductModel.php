<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ServiceSpareProductModel extends BaseModel {
    
    public $table = 'service_spares_product';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','service_spares_register_id','offer_details_id','invoicable','isserviceproduct','product_id','prd_description','description','unit_price','quantity','discount','net_amt','total_price','isreturn','tax_id','tax_amt','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('service_spares_product.id','service_spares_product.service_spares_register_id','service_spares_product.offer_details_id','service_spares_product.invoicable','service_spares_product.isserviceproduct','service_spares_product.product_id','service_spares_product.prd_description','service_spares_product.description','service_spares_product.unit_price','service_spares_product.quantity','service_spares_product.discount','service_spares_product.net_amt','service_spares_product.total_price','service_spares_product.tax_amt','service_spares_product.isreturn','service_spares_product.tax_id','service_spares_product.created_by_id','service_spares_product.status','service_spares_product.created_at','service_spares_product.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    public function register()
    {
        return $this->hasOne('App\Models\ServiceSpareRegisterModel','id','service_spares_register_id');
    }
    public function product()
    {
        return $this->hasOne('App\Models\ProductModel','id','product_id');
    }
    public function tax()
    {
        return $this->hasOne('App\Models\TaxModel','id','tax_id');
    }
    
}
