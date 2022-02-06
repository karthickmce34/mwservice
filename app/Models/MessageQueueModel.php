<?php

namespace App\Models;

use App\Models\BaseModel;


class MessageQueueModel extends BaseModel {
    

    public $perPage = 1000;
    public $pageNo = 1;    
    
    static $MESSAGE_TYPES = array(0,1,2);
    static $MESSAGE_EMAIL = 0;
    static $MESSAGE_SMS = 1;    
    

    public $table = 'message_queue';
    // 	id	message_action_group_id	message_action_id if multiple then coma seperated	
    // 	message_action_tpl_id if multiple then coma seperated	message_tpl_id if multiple then coma seperated	
    // 	subject	m_from	m_to	m_cc	m_bcc	m_replyto	message	attach 1/0 Yes/No	message_type
    protected $fillable = array('id','message_tpl_id','user_id'
        ,'action_name','subject','m_from','m_to','m_cc','m_bcc','m_replyto','message','message_type','time_interval','attach'
        //,'','','','','','','','','','',''
        //,'','','','','','','','','','','','','','','',''
        ,'created_by_id','status','create_at','update_at');
    protected $selectable = array('message_queue.id','message_queue.message_tpl_id','message_queue.user_id'
        ,'message_queue.action_name','message_queue.subject','message_queue.m_from','message_queue.m_to','message_queue.m_cc','message_queue.m_bcc','message_queue.m_replyto','message_queue.message','message_queue.message_type','message_queue.time_interval'
        ,'message_queue.created_by_id','message_queue.status','message_queue.create_at','message_queue.update_at');

    //static $STATUS = array('0' => 'No', '1' => 'Yes');
    protected $rules = array(
        
    );
    protected $messages = array(
       
    );
    
    public function __construct()
    {
        parent::__construct();
        
        //$this->setJoinBy('users', array('users.id', '=', 'uom.created_by_id'));
    }     
    
        
    public function attachments()
    {
        return $this->hasMany('App\Models\MessageQueueAttachModel', 'message_queue_id');
    }
    
}


