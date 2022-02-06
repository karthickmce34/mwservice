<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Libraries\Helpers\DateHelper as DTH;



class BaseModel extends Model
{
    public $joinBy = array();
    
    static $STATUS = array(0,1);
    static $STATUS_INACTIVE = 0;
    static $STATUS_ACTIVE = 1;
    static $STATUS_VALUES = array('0' => 'InActive', '1' => 'Active');
    static $COMPLAINT_MODE = array(0,1);
    static $COMPLAINT_MODE_PHONE = 0;
    static $COMPLAINT_MODE_EMAIL = 1;
    static $COMPLAINT_MODE_VALUES = array('0' => 'Phone', '1' => 'Email');
    static $COMPLAINT_TYPE = array(0,1,2);
    static $COMPLAINT_TYPE_SPARES = 0;
    static $COMPLAINT_TYPE_SERVICE = 1;
    static $COMPLAINT_TYPE_SPARES_SERVICE = 1;
    static $COMPLAINT_TYPE_VALUES = array('0' => 'Service', '1' => 'Spares', '2' => 'Spares & Service');
    
    
    
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function __construct()
    {
        parent::__construct();
    }  
    
    public function saveData($formData) {

        foreach ($formData as $key => $data) {
            $mykey = trim($key);
            if (in_array($mykey, $this->fillable) && !isset($this->$mykey)) {

                $this->$mykey = $data;
            }
        }

        if ($this->ValidateFormData($formData) == 1) {
            unset($this->rules);
            unset($this->messages);
            return $this->save();
        } else {
            return $this->ValidateFormData($formData);
        }
    }
    
    public function ValidateFormData($formData) {

        Validator::extend('less_than', function($attribute, $value, $parameters) {
            $other = Input::get($parameters[0]);

            return isset($other) and intval($value) < intval($other);
        });

        Validator::extend('less_than_equal_to', function($attribute, $value, $parameters) {
            $other = Input::get($parameters[0]);

            return isset($other) and intval($value) <= intval($other);
        });

        Validator::extend('greater_than', function($attribute, $value, $parameters) {
            if (isset($parameters[1])) {
                $other = $parameters[1];

                return intval($value) > intval($other);
            } else {
                return true;
            }
        });
        Validator::extend('custom_unique', function($attribute, $value, $parameters) {
            $unique_rule ='unique:';
               
            $custom_unique_rule = array();
            if (!empty($parameters)) {
                if (isset($parameters[0]))
                    $unique_rule.=$parameters[0];
                if (isset($parameters[1]))
                    $unique_rule.=',' . $parameters[1];
              
                
                if (isset($parameters[2])) {
                    if ($parameters[2] == 'NULL' || $parameters[2] == 'null')
                        $unique_rule.=',' . 'NULL';
                    else
                        $unique_rule.=',' . $this->$parameters[2];
                    }
                if (isset($parameters[3]))
                    $unique_rule.=',' . $parameters[3];
                if (isset($parameters[4]))
                    $unique_rule.=',' . $parameters[4] . ',' . $this->$parameters[4];

                 $custom_unique_rule[$attribute] = $unique_rule;                
                $message = Validator::make(array($attribute => $value), $custom_unique_rule, $this->messages);
            
            } else {
                return true;
            }
            $messageArray = $message->messages()->toArray();
            if (empty($messageArray)) {
                return true;
            } else {
                return false;
            }
        });

        foreach ($formData as $key => $value) {
            if (!is_array($value)) {
                $formData[$key] = trim($value);
            }
        }

        /*if (count($this->rules) > 0) {

            $validator = Validator::make($formData, $this->rules, $this->messages);

            if (null !== $validator->fails() && $validator->fails()) {

                return $validator->messages()->toArray();
            } else {

                return 1;
            }
        } else {
            return 1;
        }*/
        return 1;
    }

    
    
    public function storeRecord($data)
    {
        //$crrDate = date("Y-m-d H:i:s");
       // $data['create_at'] = $crrDate;
        //print_r($data);
        return $this->saveData($data);           
    }
    
    public function addRecord($data)
    {
        $crrDate = DTH::mysqlCurrent();//date("Y-m-d H:i:s");
        $data['create_at'] = $crrDate;            
        return $this->saveData($data);           
    }   
    
    public function getStaticVar($stn)
    {
        return self::$$stn;
    } 
    
    public function updateData($formData) {
        $originalData = $this->getOriginal();
        //print_r($originalData);
        $result = $this->ValidateFormData($formData);
        if ($result == 1) {
            foreach ($formData as $key => $data) {
                $mykey = trim($key);
                
                if (in_array($mykey, $this->fillable) && $originalData[$mykey] == $this->$mykey) {
                    //echo "<br> $mykey = $data";
                    $this->$mykey = $data;
                }
            }



            unset($this->rules);
            unset($this->messages);


            $result = $this->save();
        }

        return $result;
    }


  
}
