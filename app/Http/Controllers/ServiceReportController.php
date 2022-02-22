<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;


use App\Models\UserModel;


class ServiceReportController extends Controller
{
    public $baseRedirect    = 'servicereport.index';
    public $baseName        = 'servicereport';
    public $basePath        = 'reports/';
    public $detailName   = 'ServiceReportController@getIndex';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        return view($this->basePath . $this->baseName);
    }
}
