<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;


use App\Models\UserModel;


class UserController extends Controller
{
    public $modelName       = 'App\Models\UserModel';
    public $baseRedirect    = 'user.index';
    public $baseName        = 'user';
    public $basePath        = 'user/';
    public $detailName   = 'UserController@getIndex';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    

    public function store(Request $request)
    {
         $status = 1;
        $message = "success";
       
        $inputs = $request->all();
        $inputs['password']=base64_encode($inputs['password']);
        
        if($this->created_by)
        {
            $inputs['created_by_id'] = session()->get('user_id');
        }
        
        $inputs['created_at'] = now();
        
        $model = new $this->modelName();

        $stored = $model->addRecord($inputs);
        
        if($stored && is_array($stored))
        {
            return redirect()->back()->withErrors($stored)->withInput();
        }
        return redirect()->route($this->baseName.'.show',$model->id);
              
    }
    
    public function edit($id)
    {
        $model = new $this->modelName();
        $record = $model->find($id);
        
        if(!$record)
        {
            return redirect()->route($this->baseRedirect);    
        }
        $record->password = base64_decode($record->password);
        $this->data['modelData'] = $record;
        $this->data['baseName'] = $this->baseName;
        $this->data['basePath'] = $this->basePath;
        return view($this->basePath . $this->baseName . '_edit', $this->data);
    }
    
    
    
    public function update(Request $request, $id)
    {
        $status = 1;
        $message = "success";
        if( !isset($id) ||  (!($id > 0)) )
        {
            return redirect()->route($this->baseRedirect);    
        }
        
        $inputs = $request->all();
        $inputs['password']=base64_encode($inputs['password']);

        $model = new $this->modelName();
        $modelData = $model->find($id);
        
        if(!$modelData)
        {
            return redirect()->route($this->baseRedirect);   
        }
        
        $saved = $modelData->updateData($inputs);
        if($saved && is_array($saved))
        {
            return redirect()->back()->withErrors($saved)->withInput();
        }
        return redirect()->route($this->baseName.'.show',$id);

    }
    
    
    
    
}
