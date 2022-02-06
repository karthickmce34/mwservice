<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class VisitplanPhotoModel extends BaseModel {
    
    public $table = 'visitplan_photo';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','visitplan_id','name','file_name','file_path','file_type','file_ext','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('visitplan_photo.id','visitplan_photo.service_spares_register_id','visitplan_photo.name','visitplan_photo.file_name','visitplan_photo.file_path','visitplan_photo.file_type','visitplan_photo.file_ext','visitplan_photo.created_by_id','visitplan_photo.status','visitplan_photo.created_at','visitplan_photo.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    
}
