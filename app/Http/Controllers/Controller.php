<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use \Illuminate\Http\Request;


class Controller extends BaseController
{
    //print_r("de");die;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public $created_by = true;

    
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new $this->modelName();
        $modelData = $model->get();
        
        $data['data'] = $modelData;
        $data['baseName'] = $this->baseName;
        $data['basePath'] = $this->basePath;
        return view($this->basePath . $this->baseName, $data);
    }

    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['modeName'] = "Add";
        
        $data['moduleName'] = $this->baseName;
        $this->data['modeName'] = $data['modeName'];
        
        return view($this->basePath . $this->baseName . '_add', $data); 

    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $status = 1;
        $message = "success";
       
        $inputs = $request->all();
        if($this->created_by)
        {
            $inputs['created_by_id'] = session()->get('user_id');
        }

        
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
        $this->data['modelData'] = $record;
        $this->data['baseName'] = $this->baseName;
        $this->data['basePath'] = $this->basePath;
        return view($this->basePath . $this->baseName . '_edit', $this->data);
    }
    
    public function createPath($path) 
    {
        
        if (is_dir($path)) return true;
        $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );

        $chdr = false;
        
        if(is_writable($prev_path))
        {
            //$mdr = mkdir($path, 0777);
            $oldmask = umask(0);
            
            $mdr = mkdir($path, 0777, true);
            umask($oldmask);
            
            if($mdr)
                $chdr = chmod($path, 0777);    
            
        }  
        
        return $chdr;
    }    
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status = 1;
        $message = "success";
        if( !isset($id) ||  (!($id > 0)) )
        {
            return redirect()->route($this->baseRedirect);    
        }
        
        $inputs = $request->all();
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
    
    public function show($id)
    {
        
        $model = new $this->modelName();
        $record = $model->find($id);
        if(!$record)
        {
            return redirect()->route($this->baseRedirect);    
        } 
        
        $record->STATUS_VALUES = $model->getStaticVar('STATUS_VALUES');
        $this->data['record'] = $record;
        $this->data['baseName'] = $this->baseName;
        $this->data['basePath'] = $this->basePath;
        return view($this->basePath . $this->baseName . '_detail', $this->data); 
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = new $this->modelName();
        $record = $model->find($id);
        $record->delete();
        return redirect()->route($this->baseRedirect);
    }

}
