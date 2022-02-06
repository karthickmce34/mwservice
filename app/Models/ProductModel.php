<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class ProductModel extends BaseModel {
    
    public $table = 'product';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','product_id','code','name','name2','uom_id','uom','price','prdcat','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('product.id','product.product_id','product.code','product.name','product.name2','product.uom_id','product.uom','product.price','product.prdcat','product.created_by_id','product.status','product.created_at','product.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
       
}
