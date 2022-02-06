<?php

namespace App\Models;

use App\Models\BaseModel;


class UserModel extends BaseModel {
    
    public $table = 'users';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','name','email','password','username','user_type','created_at','updated_at');    
    protected $selectable = array('users.id','users.name','users.email','users.password','users.username','users.user_type','users.created_at','users.updated_at');

    
    public function __construct()
    {
        parent::__construct();
    }    
    
}
