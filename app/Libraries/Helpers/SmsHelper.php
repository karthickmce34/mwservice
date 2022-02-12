<?php
 
namespace App\Libraries\Helpers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Http;

/**
 * Description of FileUploadHelper
 *
 * @author user
 */
class SmsHelper {
    //put your code here
    
    
    
    public function CallAPI($url)
    {
        
        switch ($httpCode) {
            case 200:
                $error_status = "200: Success";
                return ($data);
                break;
            case 404:
                $error_status = "404: API Not found";
                $data1=["result"=>$error_status,"httpCode"=>$httpCode];
                return ($data1);
                break;
            case 500:
                $error_status = "500: servers replied with an error.";
                $data1=["result"=>$error_status,"httpCode"=>$httpCode];
                return ($data1);
                break;
            case 502:
                $error_status = "502: servers may be down or being upgraded. Hopefully they'll be OK soon!";
                $data1=["result"=>$error_status,"httpCode"=>$httpCode];
                return ($data1);
                break;
            case 503:
                $error_status = "503: service unavailable. Hopefully they'll be OK soon!";
                $data1=["result"=>$error_status,"httpCode"=>$httpCode];
                return ($data1);
                break;
            default:
                $error_status = "Undocumented error: " . $httpCode . " : " . curl_error($curl);
                $data1=["result"=>$error_status,"httpCode"=>$httpCode];
                return ($data1);
                break;
            }
        }
    
    public static function smsToCustomer($mobile,$message)
    {
        $base_url = Config::get('constant.API_REQUEST_DATA');
        
        /*$response = Http::get($base_url['sms-url'], [
            'user' => $base_url['sms-user'],
            'apikey' => $base_url['sms-apiKey'],
            'mobile' =>  $mobile,
            'message' => $message,
            'senderid' => $base_url['sms-senderid'],
            'type' =>  $base_url['sms-cType'],
            'tid' => $base_url['sms-tid'],
        ]);*/
        
        //print_r($response);die;
    }
    
}
