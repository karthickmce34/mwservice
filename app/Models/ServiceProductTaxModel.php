<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ServiceProductTaxModel extends BaseModel {
    
    public $table = 'service_product_tax';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','service_spares_product_id','tax_id','tax_group_id','tax_rate_id','taxable_amount','tax_amt','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('service_product_tax.id','service_product_tax.service_spares_product_id','service_product_tax.tax_id','service_product_tax.tax_group_id','service_product_tax.tax_rate_id','service_product_tax.taxable_amount','service_product_tax.tax_amt','service_product_tax.created_by_id','service_product_tax.status','service_product_tax.created_at','service_product_tax.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    public function taxrate()
    {
        return $this->hasOne('App\Models\TaxrateModel','id','tax_rate_id');
    }
    
    public function tax()
    {
        return $this->hasOne('App\Models\TaxModel','id','tax_id');
    }
    
}
