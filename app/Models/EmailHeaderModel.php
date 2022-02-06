<?php

namespace App\Models;

use App\Models\BaseModel;


class EmailHeaderModel extends BaseModel {
    
    public $table = 'email_header';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','emailid','emailaddress','name','subject','body','recieved_datetime','conversation_id','isread','isspares','status','created_at','updated_at');    
    protected $selectable = array('email_header.id','email_header.emailid','email_header.emailaddress','email_header.subject','email_header.body','email_header.name','email_header.conversation_id','email_header.recieved_datetime','email_header.isread','email_header.isspares','email_header.status','email_header.created_at','email_header.updated_at');

    
    public function __construct()
    {
        parent::__construct();
    }    
    
}

