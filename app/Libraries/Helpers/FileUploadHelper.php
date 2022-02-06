<?php
 
namespace App\Libraries\Helpers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;

/**
 * Description of FileUploadHelper
 *
 * @author user
 */
class FileUploadHelper {
    //put your code here
    
    public static function fileUploadCustomer()
    {
        $baseroot_url = Config::get('constant.UPLOAD_PATH_CUSTOMERS_URL');
        $baseroot_uploadpath  = public_path($baseroot_url);
        
        $file_name = self::fileUpload($baseroot_uploadpath);
        
        $filePath = null;
        if($file_name != null)
        {
            $filePath = $baseroot_url . $file_name;
        }
        return $file_name;
    }
    
    public static function fileUploadMember()
    {
        $baseroot_url = Config::get('constant.UPLOAD_PATH_MEMBERS_URL');
        $baseroot_uploadpath  = public_path($baseroot_url);
        
        $file_name = self::fileUpload($baseroot_uploadpath);
        
        $filePath = null;
        if($file_name != null)
        {
            $filePath = $baseroot_url . $file_name;
        }
        return $file_name;
    }
    
    public static function fileUploadUser()
    {
        $baseroot_url = Config::get('constant.UPLOAD_PATH_USERS_URL');
        $orgid = session()->get('org_id');
        $baseroot_uploadpath  = public_path($baseroot_url.$orgid);
        $file_name = self::fileUpload($baseroot_uploadpath);
        
        $filePath = null;
        if($file_name != null)
        {
            $filePath = $baseroot_url . $file_name;
        }
        return $file_name;
    }
    
    public static function fileUpload($destinationPath) 
    {
        $fileName = null;
        $images  = Input::file('image');
        if($images)
        {
            $fileName          = $images->getClientOriginalName();
            
            //$fileName = $file_name;
            
            $fileName3 = $fileName;
            $fileNames = explode(".",$fileName3);
            $fileNames2 = $fileNames;
            array_pop($fileNames2);        
            $fileName2 = join('',$fileNames2);        
            $extension = end($fileNames);   
            
            // check if file exists
            $fileNamePath = $destinationPath. $fileName;
            //$destinationPath = $memberBasePath_withDate;
            $n = 0;
            while(file_exists($fileNamePath))
            {
                $n++;
                $fileName = $fileName2 . "_" . $n . "." . $extension;
                $fileNamePath = $destinationPath . $fileName;
            }
            
            $images->move($destinationPath, $fileName);
        }
        return $fileName;
    }
    
}
