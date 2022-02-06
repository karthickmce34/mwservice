<?php

namespace App\Models;

use App\Models\BaseModel;


class TaxgroupModel extends BaseModel {
    
    public $table = 'tax_group';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','sno','tax_id','tax_rate_id','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('tax_group.id','tax_group.sno','tax_group.tax_id','tax_group.tax_rate_id','tax_group.created_by_id','tax_group.status','tax_group.created_at','tax_group.updated_at');

    
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function taxrate()
    {
        return $this->hasOne('App\Models\TaxrateModel','id','tax_rate_id');
    }
}
