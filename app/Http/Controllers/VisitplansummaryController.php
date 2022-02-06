<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;


use App\Models\ServiceSpareRegisterModel;
use App\Models\VisitplanAssetModel;


class VisitplansummaryController extends Controller
{
    public $modelName       = 'App\Models\VisitplanSummaryModel';
    public $modelLnName     = 'App\Models\VisitplanSummaryLineModel';
    public $modelProduct    = 'App\Models\VisitplanSummaryProductModel';
    public $baseRedirect    = 'visitplansummary.index';
    public $baseName        = 'visitplansummary';
    public $basePath        = 'visitplansummary/';
    public $detailName      = 'VisitplansummaryController@getIndex';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new $this->modelName();
        $registerData = $model->get();
        
        $data['data'] = $registerData;
        $data['baseName'] = $this->baseName;
        $data['basePath'] = $this->basePath;
        return view($this->basePath . $this->baseName, $data);
    }
    
    public function getIndex()
    {
         return $this->index();
        
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
    
    
    
        
    public function imageUploadFile($docid,$fileObj,$basePath,$baseURL)
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
            $assetBasePath = $basePath .'ServiceSpare/'.$docid;
            $baseAssetURL = $baseURL .'ServiceSpare/'.$docid;
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
    
    public function postImageuploadAsset($docid)
    {        
        $inputs = request()->all();
        $_doc_file = request()->file('doc_upload');
        $UPLOAD_PATH_URL   = Config::get('constant.UPLOAD_PATH_URL'); 
        $UPLOAD_PATH  = public_path($UPLOAD_PATH_URL);
        if($_doc_file)
            return $this->imageUploadFile($docid,$_doc_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);
        else
           return null;
    }
    
}
