<?php

namespace App\Models;

use App\Models\BaseModel;


class TaxModel extends BaseModel {
    
    public $table = 'tax';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','tax_name','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('tax.id','tax.tax_name','tax.created_by_id','tax.status','tax.created_at','tax.updated_at');

    
    public function __construct()
    {
        parent::__construct();
    }

    public function taxgroup()
    {
        return $this->hasMany('App\Models\TaxgroupModel','tax_id','id');
    }
    
}
