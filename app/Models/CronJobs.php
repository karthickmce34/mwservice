<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use App\Models\BaseModel;

/**
 * Description of CronJobs
 *
 * @author user
 */


class CronJobs extends BaseModel {
    
    
    public $table = 'cron_jobs';
    
    public function __construct()
    {
        parent::__construct();
       
    }    
    
}
