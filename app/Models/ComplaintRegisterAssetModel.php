<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ComplaintRegisterAssetModel extends BaseModel {
    
    public $table = 'complaint_register_asset';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','complaint_register_id','name','file_name','file_path','file_type','file_ext','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('complaint_register_asset.id','complaint_register_asset.complaint_register_id','complaint_register_asset.name','complaint_register_asset.file_name','complaint_register_asset.file_path','complaint_register_asset.file_type','complaint_register_asset.file_ext','complaint_register_asset.created_by_id','complaint_register_asset.status','complaint_register_asset.created_at','complaint_register_asset.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    
}
