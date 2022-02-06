<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;


class DocseqModel extends BaseModel {
    
    public $table = 'docseq';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','doctype','is_spares','year','month','monthname','prefix','seqno','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('docseq.id','docseq.doctype','docseq.is_spares','docseq.year','docseq.month','docseq.monthname','docseq.prefix','docseq.seqno','docseq.created_by_id','docseq.status','docseq.created_at','docseq.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
       
}
