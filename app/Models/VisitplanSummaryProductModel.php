<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class VisitplanSummaryProductModel extends BaseModel {
    
    public $table = 'visitplan_summary_product';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','visitplan_summary_id','product','qty','unitprice','amount','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('visitplan_summary_product.id','visitplan_summary_product.visitplan_summary_id','visitplan_summary_product.product','visitplan_summary_product.qty','visitplan_summary_product.unitprice','visitplan_summary_product.amount','visitplan_summary_product.created_by_id','visitplan_summary_product.status','visitplan_summary_product.created_at','visitplan_summary_product.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
    
    public function visitplansummary()
    {
        return $this->hasOne('App\Models\VisitplanSummaryModel','id','visitplan_summary_id');
    }
    
    
}
