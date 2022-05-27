<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\UserModel;
use App\Models\EmailHeaderModel;


class TicketModel extends BaseModel {
    
    public $table = 'ticket';
    // 	id	name	address	created_by	status	create_date	update_date
    protected $fillable = array('id','doc_no','type','mode','email_id','email_address','customer_name','contact_person','mobileno','complaint_nature','otherscope','jobid','ticket_status','close_reason','description','created_by_id','status','created_at','updated_at');    
    protected $selectable = array('ticket.id','ticket.doc_no','ticket.type','ticket.email_id','ticket.email_address','ticket.customer_name','ticket.contact_person','ticket.mobileno','ticket.complaint_nature','ticket.jobid','ticket.otherscope','ticket.close_reason','ticket.ticket_status','ticket.description','ticket.created_by_id','ticket.status','ticket.created_at','ticket.updated_at');

    
    public function __construct()
    {
        parent::__construct();

    } 
    public function usr()
    {
        return $this->hasOne('App\Models\UserModel','id','created_by_id');
    }
      
    public function email()
    {
        return $this->hasOne('App\Models\EmailHeaderModel','id','email_id');
    }
    
    public function complaint()
    {
        return $this->hasOne('App\Models\ComplaintRegisterModel','ticket_id','id');
    }
}
