<?php

namespace App\Models;

use App\Models\BaseModel;


class MessagetplpartialModel extends BaseModel {
    

    public $perPage = 20000;
    public $pageNo = 1;    
    
    static $TYPE = array(0,1);
    static $TYPE_HEADER = 0;
    static $TYPE_FOOTER = 1;
    static $TYPE_VALUES = array('0' => 'Header', '1' => 'Footer');

   

    public $table = 'message_tpl_partial';

    protected $fillable = array('id','name','desc','content','tpl_id','type','created_by_id','status','create_at','update_at');
    
    protected $selectable = array('message_tpl_partial.id','message_tpl_partial.name','message_tpl_partial.desc','message_tpl_partial.tpl_id',
        'message_tpl_partial.content','message_tpl_partial.type','message_tpl_partial.created_by_id',
        'message_tpl_partial.status','message_tpl_partial.create_at','message_tpl_partial.update_at',
        'users.id as userId','users.fullname');
    
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
        
    public function messagepartial() 
    {
        return $this->hasOne('App\Models\MessagetplModel','id','tpl_id');
    }
}
