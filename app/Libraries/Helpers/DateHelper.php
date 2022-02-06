<?php
 
namespace App\Libraries\Helpers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Support\Facades\Config;

/**
 * Description of DateHelper
 *
 * @author user
 */
class DateHelper {
    //put your code here

    /*
     * Format date
     */
    public static function formatTimeStamp($dateTimestamp,$dateFormat=null) 
    {
        // string date ( string $format [, int $timestamp = time() ] )
        if(empty($dateFormat) || $dateFormat == null)
            $dateFormat  = Config::get('constant.DATE_FORMAT') . ' ' . Config::get('constant.TIME_FORMAT');   
        return date($dateFormat,strtotime($dateTimestamp));
    }
    
    public static function currentTimeStamp($dateFormat=null) 
    {
        // string date ( string $format [, int $timestamp = time() ] )
        if(empty($dateFormat) || $dateFormat == null)
            $dateFormat  = Config::get('constant.DATE_FORMAT') . ' ' . Config::get('constant.TIME_FORMAT');
        return date($dateFormat);
    }
    
    public static function formatDate($dateTimestamp,$dateFormat=null) 
    {
        //echo "$dateTimestamp";
        //echo "$dateFormat";
        //die;
        if(empty($dateFormat) || $dateFormat == null)
            $dateFormat  = Config::get('constant.DATE_FORMAT');   
        return date($dateFormat,strtotime($dateTimestamp));
    }
    
    public static function currentDate($dateFormat=null) 
    {
        if(empty($dateFormat) || $dateFormat == null)
            $dateFormat  = Config::get('constant.DATE_FORMAT');
        return date($dateFormat);
    }  
    public static function formatTime($dateTimestamp,$dateFormat=null) 
    {
        if(empty($dateFormat) || $dateFormat == null)
            $dateFormat  = Config::get('constant.TIME_FORMAT');   
        return date($dateFormat,strtotime($dateTimestamp));
    }
    
    public static function currentTime($dateFormat=null) 
    {
        if(empty($dateFormat) || $dateFormat == null)
            $dateFormat  = Config::get('constant.TIME_FORMAT');
        return date($dateFormat);
    }     
    
    public static function mysqlFormat($datetimestr) 
    {
        // 24-hour time to 12-hour time 
        //$time_in_12_hour_format  = date("g:i a", strtotime($datetimestr,time()));        
        //echo $time_in_12_hour_format;
        // MySQL date('Y-m-d h:i:s')        
        $timestampstr = strtotime($datetimestr, time());
        //echo $timestampstr;
        if ($timestampstr === false) 
        {
            // date time string not proper
            return $datetime;
        } 
        else 
        {
            // format to as per MYSQL timestamp date time format
            $datetimeFormat = "Y-m-d H:i:s"; // this fix mysql timestamp format
            return date($datetimeFormat, $timestampstr);
        }
    }
    
    
    public static function mysqlCurrent() 
    {

        // format to as per MYSQL timestamp date time format
        $datetimeFormat = "Y-m-d H:i:s"; // this fix mysql timestamp format
        return date($datetimeFormat);
       
    }    
    
    public static function dateFormat() 
    {
        return Config::get('constant.DATE_FORMAT');
    }
    
    public static function timeFormat() 
    {
        return Config::get('constant.TIME_FORMAT');
    }     
    
    public static function datetimeFormat() 
    {
        return Config::get('constant.DATE_FORMAT') . ' ' . Config::get('constant.TIME_FORMAT');
    }    
    
        
    public static function convertTime($timestr_duration) 
    {
        $timeStr = '';
        if($timestr_duration)
        {
            //explode($delimiter, $string)
            $timestr_durations = explode(':',$timestr_duration);
            if(is_array($timestr_durations))
            {
                if(count($timestr_durations) == 3) // hh:mm:ss
                {
                    $hour = intval($timestr_durations[0]);
                    if($hour > 0)
                        $timeStr = "$hour hour";
                    $min = intval($timestr_durations[1]);
                    if($min > 0)
                    {
                        if($timeStr=='')
                            $timeStr = "$min min";
                        else
                            $timeStr .= " $min min";                       
                    }
                    $sec = intval($timestr_durations[2]);
                    if($sec > 0)
                    {
                        if($timeStr=='')
                            $timeStr = "$sec sec";
                        else
                            $timeStr .= " $sec min";                       
                    }
                }
                elseif(count($timestr_durations) == 2) // hh:mm
                {
                    $hour = intval($timestr_durations[0]);
                    if($hour > 0)
                        $timeStr = "$hour hour";
                    $min = intval($timestr_durations[1]);
                    if($min > 0)
                    {
                        if($timeStr=='')
                            $timeStr = "$min min";
                        else
                            $timeStr .= " $min min";                       
                    }
                }
                else // mm
                {
                    $min = intval($timestr_durations[0]);
                    if($min > 0)
                    {
                        $timeStr = "$min min";                     
                    }
                }
            }
            else
            {
                $timeStr = $timestr_duration;
            }
        }
        return $timeStr;
    }  
    
}
