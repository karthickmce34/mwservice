<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ServiceEngineerModel extends BaseModel {
    
    public $table = 'service_engineer';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','name','address1','address2','city','state','pincode','mobileno','emailid','file_name','file_path','file_ext','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('service_engineer.id','service_engineer.name','service_engineer.address1','service_engineer.address2','service_engineer.city','service_engineer.state','service_engineer.pincode','service_engineer.mobileno','service_engineer.emailid',
                                    'service_engineer.file_name','service_engineer.file_path','service_engineer.file_ext','service_engineer.created_by_id','service_engineer.status','service_engineer.created_at','service_engineer.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    
    
}
