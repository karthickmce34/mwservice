<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ServiceSpareThingstodoModel extends BaseModel {
    
    public $table = 'service_spares_thingstodo';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','service_spares_register_id','things_to_do','answer_type','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('service_spares_product.id','service_spares_product.service_spares_register_id','service_spares_product.things_to_do','service_spares_product.answer_type','service_spares_product.created_by_id','service_spares_product.status','service_spares_product.created_at','service_spares_product.updated_at');

    
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
    
}
