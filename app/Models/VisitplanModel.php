<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class VisitplanModel extends BaseModel {
    
    public $table = 'visit_plan';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','complaint_register_id','servicespare_id','is_agent','agent_id','date_of_depature','date_of_return','days_site','loading_expenses','boarding_expenses','travel_expenses','local_conveyance','tools_required','material_requirements','contact_person','visit_status','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('visit_plan.id','visit_plan.complaint_register_id','visit_plan.servicespare_id','visit_plan.is_agent','visit_plan.agent_id',
        'visit_plan.date_of_depature','visit_plan.date_of_return','visit_plan.days_site',
        'visit_plan.loading_expenses','visit_plan.boarding_expenses','visit_plan.travel_expenses',
                                    'visit_plan.tools_required','visit_plan.local_conveyance','visit_plan.material_requirements','visit_plan.contact_person','visit_plan.visit_status','visit_plan.created_by_id','visit_plan.status','visit_plan.created_at','visit_plan.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    public function agent()
    {
        return $this->hasOne('App\Models\ServiceAgentModel','id','agent_id');
    }
    public function visitengs()
    {
        return $this->hasMany('App\Models\VisitplanEngineerModel','visitplan_id','id');
    }
    public function compreg()
    {
        return $this->hasOne('App\Models\ComplaintRegisterModel','id','complaint_register_id');
    }
    public function servicespare()
    {
        return $this->hasOne('App\Models\ServiceSpareRegisterModel','id','servicespare_id');
    }
    
}
