<?php

namespace App\Models;

use App\Models\BaseModel;


class MessagetplModel extends BaseModel {
    

    public $perPage = 2000;
    public $pageNo = 1;    
    
    static $TYPE = array(0,1,2);
    static $TYPE_MAIL = 0;
    static $TYPE_SMS = 1;
    static $TYPE_NOTIFICATION = 2;
    static $TYPE_VALUES = array('0' => 'Mail', '1' => 'SMS','2' => 'Notification');


    public $table = 'message_tpl';

    protected $fillable = array('id','tpl_key','tpl_name','tpl_subject','tpl_desc',
        'tpl_content','type','member_type','created_by_id','status','create_at','update_at');
    
    protected $selectable = array('message_tpl.id','message_tpl.tpl_key','message_tpl.tpl_name','message_tpl.tpl_subject','message_tpl.tpl_desc',
        'message_tpl.tpl_content','message_tpl.type','message_tpl.member_type','message_tpl.created_by_id','message_tpl.status',
        'message_tpl.create_at','message_tpl.update_at','users.id as userId', 'users.fullname');

    protected $rules = array(
        //'name' => array('required', 'regex:/^[a-zA-Z\s]+$/','max:15'),
        //'type' => array('required', 'regex:/^[a-zA-Z\s]+$/','max:15'),
        //'branch_id' => array('required'),
    );
    protected $messages = array();
       // 'name.regex' => 'The :attribute should be character only',
    //);
    
    public function __construct()
    {
        parent::__construct();
    }     
    
        
    public function msgpartial()
    {
           return $this->hasMany('App\Models\MessagetplpartialModel', 'tpl_id');
    }
}
