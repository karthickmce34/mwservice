<?php

namespace App\Models;

use App\Models\BaseModel;


class RegionModel extends BaseModel {
    
    public $table = 'region';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','region_id','region_name','region_email','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('region.id','region.region_id','region.region_name','region.region_email','region.created_by_id','region.status','region.created_at','region.updated_at');

    
    public function __construct()
    {
        parent::__construct();
    }

    
    
}
