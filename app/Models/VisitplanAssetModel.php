<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class VisitplanAssetModel extends BaseModel {
    
    public $table = 'visitplan_asset';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','visitplan_id','name','file_name','file_path','file_type','file_ext','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('visitplan_asset.id','visitplan_asset.visitplan_id','visitplan_asset.name','visitplan_asset.file_name','visitplan_asset.file_path','visitplan_asset.file_type','visitplan_asset.file_ext','visitplan_asset.created_by_id','visitplan_asset.status','visitplan_asset.created_at','visitplan_asset.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    
}
