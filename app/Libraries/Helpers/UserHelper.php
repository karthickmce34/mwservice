<?php
 
namespace App\Libraries\Helpers;



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

use App\Models\BiuserdesignationModel;
use App\Models\BidesignationMatrixModel;

use Illuminate\Support\Facades\Session;

/*


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;

use App\Models\MembershipModel;
use App\Models\BranchModel;

use \Firebase\JWT\JWT;
*/
/**
 * Description of UserHelper
 *
 * @author user
 */
class UserHelper {
    //put your code here
    
    //public static function checkSectiuonAccess($sectionName)
    public static function chkSecAcc($sectionName)
    {
        $flag = false;
        
        
        return $flag;
    }
    
    public static function chkWdgtAcc($widgetName)
    {
        $flag = false;
        
        
        $_widget_modules = Config::get('sgbz._widget_modules');
        
        if(is_array($_widget_modules) && isset($_widget_modules[$widgetName]))
        {
            $moduleNames = $_widget_modules[$widgetName];
            
            if(is_array($moduleNames) && count($moduleNames)>0)
            {
                foreach($moduleNames as $moduleName)
                {
                    $flag = self::chkMdlAcc('Widget',$moduleName);
                    if($flag == true)
                    {
                        break;
                    }
                }
            }
            else if($moduleNames != null && $moduleNames != "")
            {
                $moduleName = $moduleNames;
                
                $flag = self::chkMdlAcc('Widget',$moduleName);
            }
            
        }
        //$flag = true;
        return $flag;
    }
    
    //public static function checkModuleAccess($sectionName,$moduleName)
    public static function chkMdlAcc($sectionName,$moduleName)
    {
        $flag = false;
        $user = session()->get('user_id');
        $userDesign = BiuserdesignationModel::where('status',1)
                        ->where('user_id','=',$user)
                        ->select('designation_id')
                        ->get()->toArray();
        //print_r($user);
        $desmatrx = BidesignationMatrixModel::whereIn('designation_id',$userDesign)
                        ->where('module_name','=',$moduleName)
                        ->sum('mtx_access');
        
        if($desmatrx > 0)
        {
           $flag = true; 
        }
       
        
        return $flag;
    }
    
    //public static function checkModuleAccessRoot($currentAction)
    public static function chkMdlAccRt($currentAction)
    {
        $flag = false;
        
        // $currentAction
        // App\Http\Controllers\DesignationController@getShow
        
        $controller = null;
        $methodName = null;
        list($controller, $methodName) = explode('@', $currentAction);
        //echo $controller;
        $controllerName = preg_replace('/.*\\\/', '', $controller);
        //echo $controller;
        //echo $method; 
        
        // controllerName : DesignationController
        // methodName : getShow
        $flag = self::chkMdlAccPrm($controllerName,$methodName);
        
        //$flag = true; // uncommnet thus line
        return $flag;        
    }
    
    
    //public static function checkModuleAccessPermission($controllerName,$methodName)
    public static function chkMdlAccPrm($controllerName,$methodName)
    {
        $flag = false;
        $user = session()->get('user_id');
        $userDesign = BiuserdesignationModel::where('status',1)
                        ->where('user_id','=',$user)
                        ->select('designation_id')
                        ->get()->toArray();
        $permissions = Config::get('sgbz.__default_permissions');
        $modules = Config::get('sgbz._modules');
        $accessname = "";
        $desmatrx = 0;
        $level2 = ['_name','_access','_parent','_root'];
            foreach($permissions as $key=>$defper)
            {
              if(in_array($methodName, $defper))
              {
                $accessname =  $key; 
              }

            }
        if($accessname == "")
        {
            foreach($modules as $key=>$module)
            {
                if($controllerName == $key)
                {
                   foreach($module as $key2=>$modlev2)
                   {
                       if(in_array($key2,$level2))
                       {
                           continue;
                       }
                       else
                       {
                            if(in_array($methodName, $modlev2))
                            {
                              $accessname =  $key2; 
                            }
                       }
                   }
                }
                
            }
        }
        if($accessname !="")
        {
            $access = 'mtx_'.$accessname;
            $desmatrx = BidesignationMatrixModel::whereIn('designation_id',$userDesign)
                        ->where('module_name','=',$controllerName)
                        ->sum($access);
        }
        
        if($desmatrx > 0)
        {
           $flag = true; 
        }
       // print_r($controllerName);die;
        return $flag;
    }
    
    //public static function checkWidgetAccess($sectionName,$moduleName)
    public static function chkWidAcc($moduleName)
    {
        $flag = false;
        $user = session()->get('user_id');
        $userDesign = BiuserdesignationModel::where('status',BiuserdesignationModel::$STATUS_ACTIVE)
                        ->where('user_id','=',$user)
                        ->select('designation_id')
                        ->get()->toArray();
        $desmatrx = WidgetMatrixModel::whereIn('designation_id',$userDesign)
                        ->where('module_name','=',$moduleName)
                        ->sum('mtx_access');
        
        if($desmatrx > 0)
        {
           $flag = true; 
        }
       
        
        return $flag;
    }
    
 
    
}
