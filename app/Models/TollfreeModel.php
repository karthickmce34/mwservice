<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;
use App\Models\EmailHeaderModel;


class TollfreeModel extends BaseModel {
    
    public $table = 'tollfree';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','toll_id','calltype','customernumber','tollfree_time','recording','disposition','receivedby','duration','ivrdata','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('tollfree.id','tollfree.toll_id','tollfree.calltype','tollfree.customernumber','tollfree.tollfree_time','tollfree.recording','tollfree.disposition','tollfree.receivedby','tollfree.duration','tollfree.ivrdata','tollfree.created_by_id','tollfree.status','tollfree.created_at','tollfree.updated_at');    

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
      
    
}
