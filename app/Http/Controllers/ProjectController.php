<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;


class ProjectController extends Controller
{
    public $modelName       = 'App\Models\ProjectModel';
    public $modelEngineer   = 'App\Models\ServiceEngineerModel';
    public $modelVsSum      = 'App\Models\ProjectSummaryModel';
    public $modelExpense      = 'App\Models\ProjectExpensesModel';
    public $baseRedirect    = 'project.index';
    public $baseName        = 'project';
    public $basePath        = 'project/';
    public $detailName      = 'ProjectController@getIndex';
    
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
        
    public function show($id)
    {
        
        $model = new $this->modelName();
        $record = $model->find($id);
        //echo "<pre>";
        //print_r($record->projectsummary->expense);die;
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
    
    public function create()
    {
        $data['modeName'] = "Add";
        
        if(Session::get('user_type') == 5)
        {
            $user_id = Session::get('user_id');
        }
        else
        {
            $user_id = '';
        }
        
        $data['user_id'] = $user_id;
        $data['moduleName'] = $this->baseName;
        $this->data['modeName'] = $data['modeName'];
        
        return view($this->basePath . $this->baseName . '_add', $data); 

    }
        
    public function store(Request $request)
    {
         $status = 1;
        $message = "success";
       
        $inputs = $request->all();
        if($this->created_by)
        {
            $inputs['created_by_id'] = session()->get('user_id');
        }

        $inputs['status'] = 1;
        
        $model = new $this->modelName();

        $stored = $model->addRecord($inputs);
        
        if($stored && is_array($stored))
        {
            return redirect()->back()->withErrors($stored)->withInput();
        }
        return redirect()->route($this->baseName.'.show',$model->id);
              
    }
    
    public function postUpdateapprove(Request $request)
    {
        $inputs = $request->all();
        
        $id = $inputs['id'];
        
        $model = new $this->modelName();
        $modelData = $model->find($id);
        $modelData->approval_status = 1;
        $modelData->save();
        
        $this->data['status']=1;
        return response()->json($this->data);
    }
    
    public function postInsertsummary()
    {
         $status = 1;
        $message = "success";
        $inputs = request()->all();
        
        $docid = $inputs['id'];
        $test=request()->file('img_upload');
        
        $lodgingbill_file = request()->file('lodgingbill');
        $travelbill_file = request()->file('travelbill');
        $sld_file = request()->file('site_photo');
        $UPLOAD_PATH_URL   = Config::get('constant.UPLOAD_PATH_URL'); 
        $UPLOAD_PATH  = public_path($UPLOAD_PATH_URL);
        
        
        $model = new $this->modelName();
        $registerData = $model->find($docid);
        $cnt = 0;
         
            $inpData =array();
            $inpData['project_id']= $docid;
            $inpData['is_agent']= 0;
            $inpData['engineer_id']= $inputs['engineer_id'];
            $inpData['loading_expenses']= $inputs['loading_expenses'];
            $inpData['boarding_expenses']= $inputs['boarding_expenses'];
            $inpData['travel_expenses']= $inputs['travel_expenses'];
            $inpData['local_expenses']= $inputs['local_conveyance'];
            if($this->created_by)
            {
                $inpData['created_by_id'] = session()->get('user_id');
            }
            
            $inpData['visit_status']= 1;
            $inpData['visit_date']= $inputs['visit_date'];
            $inpData['work_description']= $inputs['work_description'];
          
                
            $inpData['status'] = 1;
            $modelsum = new $this->modelVsSum();
            $stored = $modelsum->addRecord($inpData);

            if($stored && is_array($stored))
            {
                return redirect()->back()->withErrors($stored)->withInput();
            }
            else
            {
                $modelexpense = new $this->modelExpense();
                $inpData['project_summary_id'] = $modelsum->id;
                $storeExpense = $modelexpense->addRecord($inpData);
                if(isset($lodgingbill_file))
                {
                    /*****lodging****/
                    $lodging_bill = $this->imageSummaryUploadFile($modelsum->id,$lodgingbill_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);

                    $modelsum->lodgingbill_file_path = $lodging_bill['file_path'];
                    $modelsum->lodgingbill_file_name = $lodging_bill['file_name'];
                }

                if(isset($travelbill_file))
                {
                    /*****travel****/
                    $travel_bill = $this->imageSummaryUploadFile($modelsum->id,$travelbill_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);

                    $modelsum->travelbill_file_path = $travel_bill['file_path'];
                    $modelsum->travelbill_file_name = $travel_bill['file_name'];
                }


                /*****sld****/
                $sld = $this->imageSummaryUploadFile($modelsum->id,$sld_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);

                $modelsum->site_file_path = $sld['file_path'];
                $modelsum->site_file_name = $sld['file_name'];

                
                $modelsum->save();

                
                $registerData->visit_status=1;
                $registerData->save();
            }
            return redirect()->route('project.show',$docid);
        
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
            

            $model = new $this->modelVsSumLn();
            $assetBasePath = $basePath .'Project/'.$docid;
            $baseAssetURL = $baseURL .'Project/'.$docid;
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
                /*$response['file_type'] = 0;
                if(isset($this->file_types[strtolower($extension)]))
                    $response['file_type'] = $this->file_types[strtolower($extension)];*/
                $response['file_type'] = $extension;
                $response['file_ext'] = $extension;                                
            }        
            
        }
        return $response;
    }
    
    public function postImageuploadAsset($docid,$i)
    {        
        $inputs = request()->all();
        $_doc_file = request()->file('img_upload');
        $UPLOAD_PATH_URL   = Config::get('constant.UPLOAD_PATH_URL'); 
        $UPLOAD_PATH  = public_path($UPLOAD_PATH_URL);
        if($_doc_file)
            return $this->imageUploadFile($docid,$_doc_file[$i],$UPLOAD_PATH,$UPLOAD_PATH_URL);
        else
           return null;
    }
    
    public function imageSummaryUploadFile($docid,$fileObj,$basePath,$baseURL)
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
            

            //$model = new $this->modelVsSumLn();
            $assetBasePath = $basePath .'ProjectplanSummary/'.$docid;
            $baseAssetURL = $baseURL .'ProjectplanSummary/'.$docid;
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
                /*$response['file_type'] = 0;
                if(isset($this->file_types[strtolower($extension)]))
                    $response['file_type'] = $this->file_types[strtolower($extension)];*/
                $response['file_type'] = $extension;
                $response['file_ext'] = $extension;                                
            }        
            
        }
        return $response;
    }
    
}
