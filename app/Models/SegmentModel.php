<?php

namespace App\Models;

use App\Models\BaseModel;


class SegmentModel extends BaseModel {
    
    public $table = 'segment';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','segment_id','segment_name','bank_details','terms','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('segment.id','segment.segment_id','segment.segment_name','segment.bank_details','segment.terms','segment.created_by_id','segment.status','segment.created_at','segment.updated_at');

    
    public function __construct()
    {
        parent::__construct();
    }

    
}
