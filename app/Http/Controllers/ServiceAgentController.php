<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;


use App\Models\ServiceAgentModel;
use App\Models\RegionModel;

class ServiceAgentController extends Controller
{
    public $modelName       = 'App\Models\ServiceAgentModel';
    public $baseRedirect    = 'serviceagent.index';
    public $baseName        = 'serviceagent';
    public $basePath        = 'serviceagent/';
    public $detailName   = 'ServiceAgentController@getIndex';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        $data['modeName'] = "Add";
        $regionModal = new RegionModel();
        $regionData = $regionModal->where('status',1)->get();
        $data['regions'] = $regionData;
        $data['moduleName'] = $this->baseName;
        $this->data['modeName'] = $data['modeName'];
        
        return view($this->basePath . $this->baseName . '_add', $data); 

    }
    
    public function edit($id)
    {
        $model = new $this->modelName();
        $record = $model->find($id);
        if(!$record)
        {
            return redirect()->route($this->baseRedirect);    
        }
        
        $regionModal = new RegionModel();
        $regionData = $regionModal->where('status',1)->get();
        $this->data['regions'] = $regionData;
        
        $this->data['modelData'] = $record;
        $this->data['baseName'] = $this->baseName;
        $this->data['basePath'] = $this->basePath;
        return view($this->basePath . $this->baseName . '_edit', $this->data);
    }
    
}
