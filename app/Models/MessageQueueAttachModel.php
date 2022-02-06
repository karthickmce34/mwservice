<?php

namespace App\Models;

use App\Models\BaseModel;


class MessageQueueAttachModel extends BaseModel {
    

    public $perPage = 1000;
    public $pageNo = 1;    
    
       
    

    public $table = 'message_queue_attach';
  
    protected $fillable = array('id','message_queue_id','file_name','file_path','file_type','file_ext','doc_type'
        ,'attach_type','created_by_id','status','create_at','update_at');
    protected $selectable = array('message_queue_attach.id','message_queue_attach.message_queue_id','message_queue_attach.file_name','message_queue_attach.file_path','message_queue_attach.file_type','message_queue_attach.file_ext','message_queue_attach.doc_type'
        ,'message_queue_attach.attach_type','message_queue_attach.created_by_id','message_queue_attach.status','message_queue_attach.create_at','message_queue_attach.update_at');

    protected $rules = array(
        //'amt' => array('less_than:val', 'regex:/^\d*(\.\d{2})?$/'),
    );
    protected $messages = array(
       
    );
    
    public function __construct()
    {
        parent::__construct();
        
    }     
    
    
}


