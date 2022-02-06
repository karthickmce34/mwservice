<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class VisitplanEngineerModel extends BaseModel {
    
    public $table = 'visitplan_engineer';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','visitplan_id','engineer_id','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('visitplan_engineer.id','visitplan_engineer.visitplan_id','visitplan_engineer.engineer_id',
                        'visitplan_engineer.created_by_id','visitplan_engineer.status','visitplan_engineer.created_at','visitplan_engineer.updated_at');

    
    public function __construct()
    {
        parent::__construct();
    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    public function engineer()
    {
        return $this->hasOne('App\Models\ServiceEngineerModel','id','engineer_id');
    }
    
}
