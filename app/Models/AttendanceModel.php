<?php

namespace App\Models;

use App\Models\BaseModel;


class AttendanceModel extends BaseModel {
    
    public $table = 'attendance';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','user_id','loged_in','user_type','login_type','logged_by_id','created_at','updated_at');    
    protected $selectable = array('attendance.id','attendance.user_id','attendance.loged_in','attendance.user_type','attendance.login_type','attendance.logged_by_id','attendance.created_at','attendance.updated_at');

    
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','user_id');
    }
}
