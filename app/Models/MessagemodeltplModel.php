<?php

namespace App\Models;

use App\Models\BaseModel;


class MessagemodeltplModel extends BaseModel {
    

    public $perPage = 2000;
    public $pageNo = 1;    
    
    /*static $TYPE = array(0,1);
    static $TYPE_MAIL = 0;
    static $TYPE_SMS = 1;
    static $TYPE_VALUES = array('0' => 'Mail', '1' => 'SMS');*/

    public $table = 'message_model_tpl';

    protected $fillable = array('id','tpl_id','model','created_by_id','status','create_at','update_at');
    
    protected $selectable = array('message_model_tpl.id','message_model_tpl.tpl_id','message_model_tpl.model',
        'message_model_tpl.created_by_id','message_model_tpl.status','message_model_tpl.create_at','message_model_tpl.update_at',
        'users.id as userId', 'users.fullname');

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
    
      
}
