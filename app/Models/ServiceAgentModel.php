<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ServiceAgentModel extends BaseModel {
    
    public $table = 'service_agent';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','company_name','address1','address2','city','state','pincode','mobileno','emailid','gstin','panno','contact_person','region_id','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('service_agent.id','service_agent.name','service_agent.address1','service_agent.address2','service_agent.city','service_agent.state','service_agent.pincode','service_agent.mobileno','service_agent.emailid',
                                    'service_agent.gstin','service_agent.panno','service_agent.contact_person','service_agent.region_id','service_agent.created_by_id','service_agent.status','service_agent.created_at','service_agent.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    
    public function region()
    {
        return $this->hasOne('App\Models\RegionModel','id','region_id');
    }
}
