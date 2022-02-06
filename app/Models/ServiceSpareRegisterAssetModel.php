<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ServiceSpareRegisterAssetModel extends BaseModel {
    
    public $table = 'service_spares_register_asset';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','service_spares_register_id','name','file_name','file_path','file_type','file_ext','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('service_spares_register_asset.id','service_spares_register_asset.service_spares_register_id','service_spares_register_asset.name','service_spares_register_asset.file_name','service_spares_register_asset.file_path','service_spares_register_asset.file_type','service_spares_register_asset.file_ext','service_spares_register_asset.created_by_id','service_spares_register_asset.status','service_spares_register_asset.created_at','service_spares_register_asset.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    
}
