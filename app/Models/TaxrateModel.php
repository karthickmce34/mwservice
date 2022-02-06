<?php

namespace App\Models;

use App\Models\BaseModel;


class TaxrateModel extends BaseModel {
    
    public $table = 'tax_rate';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','tax_rate_name','rate','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('tax_rate.id','tax_rate.tax_rate_name','tax_rate.rate','tax_rate.created_by_id','tax_rate.status','tax_rate.created_at','tax_rate.updated_at');

    
    public function __construct()
    {
        parent::__construct();
    }    
    
}
