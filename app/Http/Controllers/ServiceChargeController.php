<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;


use App\Models\ServiceChargeModel;


class ServiceChargeController extends Controller
{
    public $modelName       = 'App\Models\ServiceChargeModel';
    public $baseRedirect    = 'servicecharge.index';
    public $baseName        = 'servicecharge';
    public $basePath        = 'servicecharge/';
    public $detailName   = 'ServiceChargeController@getIndex';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    

    public function store(Request $request)
    {
         $status = 1;
        $message = "success";
       
        $inputs = $request->all();
        
        $model = new $this->modelName();

        if($this->created_by)
        {
            $inputs['created_by_id'] = session()->get('user_id');
        }
        
        $stored = $model->addRecord($inputs);
        
        if($stored && is_array($stored))
        {
            return redirect()->back()->withErrors($stored)->withInput();
        }
        return redirect()->route($this->baseRedirect);   
              
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
        $assetUpload = $this->postImageuploadAsset();

        $model = new $this->modelName();
        $modelData = $model->find($id);
        if(!$modelData)
        {
            return redirect()->route($this->baseRedirect);   
        }
        if($assetUpload['uploaded'])
        {
            if($modelData->file_name <> $assetUpload['file_name'])
            {
                $inputs['file_path'] = $assetUpload['file_path'];
                $inputs['file_name'] = $assetUpload['file_name'];
                $inputs['file_ext'] = $assetUpload['file_ext'];
            }
        }
        $saved = $modelData->updateData($inputs);
        if($saved && is_array($saved))
        {
            return redirect()->back()->withErrors($saved)->withInput();
        }
        return redirect()->route($this->baseRedirect);   

    }
    
    
        
    public function imageUploadFile($fileObj,$basePath,$baseURL)
    {
        $response = array();
        $response['uploaded'] = false;
        $vlf =  $fileObj->isValid();
        if($vlf)
        {           
            $fileName   = $fileObj->getClientOriginalName();
            $fileName3 = $fileName;
            $fileNames = explode(".",$fileName3);
            $fileNames2 = $fileNames;
            array_pop($fileNames2);        
            $fileName2 = join('',$fileNames2);        
            $extension = end($fileNames);   
            
            $inputs = request()->all();

            $model = new $this->modelName();
            $assetBasePath = $basePath .'serviceengineer/';
            $baseAssetURL = $baseURL .'serviceengineer/';
            if (!is_dir($assetBasePath)) 
            {
                $this->createPath($assetBasePath);
            }
            // check if file exists
            $fileNamePath = $assetBasePath.'/'. $fileName;
            $destinationPath = $assetBasePath;
            $n = 0;
            while(file_exists($fileNamePath))
            {
                $n++;
                $fileName = $fileName2 . "_" . $n . "." . $extension;
                $fileNamePath = $assetBasePath . $fileName;
            }

            //$uploaded = move_uploaded_file($_FILES['file']['tmp_name'], $fileNamePath);
            $uploaded = $fileObj->move($destinationPath, $fileName);

            
            $response['uploaded'] = $uploaded;
            if($uploaded)
            {
                $response['file_name'] = $fileName;
                $response['file_path'] = $baseAssetURL;
                $response['file_type'] = 0;
                if(isset($this->file_types[strtolower($extension)]))
                    $response['file_type'] = $this->file_types[strtolower($extension)];
                
                $response['file_ext'] = $extension;                                
            }        
            
        }
        return $response;
    }
    
    public function postImageuploadAsset()
    {        
        $_doc_file = request()->file('img_upload');
        $UPLOAD_PATH_URL   = Config::get('constant.UPLOAD_PATH_URL'); 
        $UPLOAD_PATH  = public_path($UPLOAD_PATH_URL);
        if($_doc_file)
            return $this->imageUploadFile($_doc_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);
        else
           return null;
    }
    
}
