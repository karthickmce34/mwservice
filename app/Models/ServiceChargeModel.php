<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ServiceChargeModel extends BaseModel {
    
    public $table = 'service_charge';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','code','name','amount','hsn','uom','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('service_charge.id','service_charge.code','service_charge.name','service_charge.amount','service_charge.hsn','service_charge.uom','service_charge.created_by_id','service_charge.status','service_charge.created_at','service_charge.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    
    
}
