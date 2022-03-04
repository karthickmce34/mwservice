<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


use App\Models\ServiceSpareRegisterModel;
use App\Models\VisitplanAssetModel;


class VisitplansummaryController extends Controller
{
    public $modelName       = 'App\Models\VisitplanSummaryModel';
    public $modelSummaryAssetName  = 'App\Models\VisitplanSummaryAssetModel';
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
        $user_type = session()->get('user_type');
        $user_id = session()->get('user_id');
       
        if($user_type == 0 || $user_type == 2)
        {
           
            $model = new $this->modelName();
            $registerData = $model->all();
            //print_r($registerData);die;
        }
        else if ($user_type == 4)
        {
            $servicedatas = DB::select("SELECT distinct visitplan_summary.id FROM visitplan_summary,visit_plan,visitplan_engineer,service_engineer
                                        WHERE visit_plan.id = visitplan_engineer.visitplan_id
                                        and visit_plan.id = visitplan_summary.visitplan_id
                                        and visitplan_engineer.engineer_id = service_engineer.id
                                        and visitplan_engineer.engineer_id = '$user_id'
                                        and visitplan_engineer.deleted_at is null");
            $id = array();
             foreach($servicedatas as $servicedata)
             {
              $id[]=$servicedata->id;
             }

            $model = new $this->modelName();
            $registerData = $model->whereIn('id',$id)                    
                    ->get();
            
        }
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
    
    public function addphoto($id)
    {
        $data['modeName'] = "Add";
        
        $data['moduleName'] = $this->baseName;
        $data['id'] = $id;
        $this->data['modeName'] = $data['modeName'];
        
        return view($this->basePath . $this->baseName . '_addphoto', $data); 

    }
    
    public function editphoto($id)
    {
        $data['modeName'] = "Add";
        $model = new $this->modelSummaryAssetName();
        $modelData = $model->find($id);
        $data['moduleName'] = $this->baseName;
        $data['modelData'] = $modelData;
        
        return view($this->basePath . $this->baseName . '_editphoto', $data); 

    }
    
    public function postStorephoto()
    {
         $status = 1;
        $message = "success";
        $inputs = request()->all();
        
        $id = $inputs['visitplansummary_id'];
        
        $inputs['visitplan_summary_id'] = $id;
        $inputs['file_type'] = $inputs['doc_type'];
        $inputs['name'] = $inputs['doc_name'];
        $assetUpload = $this->postImageuploadAsset($id);
        if($this->created_by)
        {
            $inputs['created_by_id'] = session()->get('user_id');
        }
        if($assetUpload['uploaded'])
        {
            $inputs['file_path'] = $assetUpload['file_path'];
            $inputs['file_name'] = $assetUpload['file_name'];
            $inputs['file_ext'] = $assetUpload['file_ext'];
        }
        else
        {
            return redirect()->back()->withErrors($inputs)->withInput();
        }
        $model = new $this->modelSummaryAssetName();

        $stored = $model->addRecord($inputs);
        
        if($stored && is_array($stored))
        {
            return redirect()->back()->withErrors($stored)->withInput();
        }
        return redirect()->route($this->baseName.'.show',$id);
              
    }
    
    public function updatephoto(Request $request, $id)
    {
        $status = 1;
        $message = "success";
        if( !isset($id) ||  (!($id > 0)) )
        {
            return redirect()->route($this->baseRedirect);    
        }
        
        $inputs = $request->all();
        $docid = $inputs['visitplan_summary_id'];
        $inputs['visitplan_summary_id'] = $docid;
        $inputs['file_type'] = $inputs['doc_type'];
        $inputs['name'] = $inputs['doc_name'];
        $assetUpload = $this->postImageuploadAsset($docid);
        
        $model = new $this->modelSummaryAssetName();
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
        else
        {
            return redirect()->back()->withErrors($saved)->withInput();
        }
        $saved = $modelData->updateData($inputs);
        if($saved && is_array($saved))
        {
            return redirect()->back()->withErrors($saved)->withInput();
        }
        return redirect()->route($this->baseName.'.show',$docid);

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
            $assetBasePath = $basePath .'VisitPlanSummary/'.$docid;
            $baseAssetURL = $baseURL .'VisitPlanSummary/'.$docid;
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
