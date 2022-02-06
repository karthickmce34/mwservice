<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;


use App\Models\ServiceSpareRegisterModel;
use App\Models\VisitplanAssetModel;


class VisitplanController extends Controller
{
    public $modelName       = 'App\Models\VisitplanModel';
    public $modelAssetName  = 'App\Models\VisitplanAssetModel';
    public $modelPhoto      = 'App\Models\VisitplanPhotoModel';
    public $modelAgent      = 'App\Models\ServiceAgentModel';
    public $modelEngineer   = 'App\Models\ServiceEngineerModel';
    public $modelVsEng      = 'App\Models\VisitplanEngineerModel';
    public $baseRedirect    = 'visitplan.index';
    public $baseName        = 'visitplan';
    public $basePath        = 'visitplan/';
    public $detailName      = 'VisitplanController@getIndex';
    
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
    
    public function edit($id)
    {
        $model = new $this->modelName();
        $record = $model->find($id);
        if(!$record)
        {
            return redirect()->route($this->baseRedirect);    
        }
        $modelagent = new $this->modelAgent();
        $modelengineer = new $this->modelEngineer();
        $modelVsEng = new $this->modelVsEng();
        $recagent = $modelagent->get();
        $engineerlists = $modelengineer->get();
        $recengineer = $modelVsEng->where('visitplan_id',$id)
                                     ->get();
       // print_r($record);die;
        $this->data['modelData'] = $record;
        $this->data['modelAgents'] = $recagent;
        $this->data['modelEngineers'] = $recengineer;
        $this->data['modelEngLists'] = $engineerlists;
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
        if(!isset($inputs['isbom']))
        $inputs['isbom'] =0;
        $inputs['scope_of_work'] = json_encode($request->input('scope_of_work'));//implode(',', (array) $request->input('scope_of_work'));
        $modelVsEng = new $this->modelVsEng();
        $recengineers = $modelVsEng->where('visitplan_id',$id)->get();
        $engineer=array();
        foreach($recengineers as $recengineer)
        {
            $engineer[]=$recengineer->engineer_id;
            if(in_array($recengineer->engineer_id,$inputs['engineer_id'] ))
            {
                
            }
            else
            {
                $model = new $this->modelVsEng();
                $record = $model->find($recengineer->id);
                $record->delete();
            }
        }
        if(isset($inputs['engineer_id']))
        {
            foreach($inputs['engineer_id'] as $input)
            {
                if(in_array($input,$engineer))
                {


                }
                else
                {
                    $inp=array();
                    $inp['visitplan_id'] = $id;
                    $inp['engineer_id'] = $input;
                    $inp['created_by_id'] = session()->get('user_id');
                    $inp['status'] = 1;
                    $modelEng = new $this->modelVsEng();
                    $stored = $modelEng->addRecord($inp);
                }

            }
        }
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
        
    public function addnew($id)
    {
        $data['modeName'] = "Add";
        
        $data['moduleName'] = $this->baseName;
        $data['id'] = $id;
        $this->data['modeName'] = $data['modeName'];
        
        return view($this->basePath . $this->baseName . '_addnew', $data); 

    }
    
    public function editdoc($id)
    {
        $data['modeName'] = "Add";
        $model = new $this->modelAssetName();
        $modelData = $model->find($id);
        $data['moduleName'] = $this->baseName;
        $data['modelData'] = $modelData;
        
        return view($this->basePath . $this->baseName . '_editdoc', $data); 

    }
    
    public function postStoredoc()
    {
         $status = 1;
        $message = "success";
        $inputs = request()->all();
        $docid = $inputs['service_spares_register_id'];
        $inputs['service_spares_register_id'] = $docid;
        $inputs['file_type'] = $inputs['doc_type'];
        $inputs['name'] = $inputs['doc_name'];
        $assetUpload = $this->postImageuploadAsset($docid);
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
        $model = new $this->modelAssetName();

        $stored = $model->addRecord($inputs);
        
        if($stored && is_array($stored))
        {
            return redirect()->back()->withErrors($stored)->withInput();
        }
        return redirect()->route($this->baseName.'.show',$docid);
              
    }
    
    public function updatedoc(Request $request, $id)
    {
        $status = 1;
        $message = "success";
        if( !isset($id) ||  (!($id > 0)) )
        {
            return redirect()->route($this->baseRedirect);    
        }
        
        $inputs = $request->all();
        $docid = $inputs['service_spares_register_id'];
        $inputs['service_spares_register_id'] = $docid;
        $inputs['file_type'] = $inputs['doc_type'];
        $inputs['name'] = $inputs['doc_name'];
        $assetUpload = $this->postImageuploadAsset($docid);
        
        $model = new $this->modelAssetName();
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
    
    public function postUpdatestatus()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        $model = new $this->modelName();
        $modelData = $model->find($inputs['id']);
        
        if(!$modelData)
        {
            $this->data['status']=0;
            $this->data['message']="Not Success";
            return response()->json($this->data); 
        }
        else
        {
            $modelData->visit_status=1;
            $modelData->save();
            $this->data['status']=1;
            $this->data['message']=$message;
            return response()->json($this->data);
        }
        
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
        $model = new $this->modelAssetName();
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
        $docid = $inputs['visitplan_id'];
        $inputs['visitplan_id'] = $docid;
        $inputs['file_type'] = $inputs['doc_type'];
        $inputs['name'] = $inputs['doc_name'];
        $assetUpload = $this->postImageuploadAsset($docid);
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
        $model = new $this->modelAssetName();

        $stored = $model->addRecord($inputs);
        
        if($stored && is_array($stored))
        {
            return redirect()->back()->withErrors($stored)->withInput();
        }
        return redirect()->route($this->baseName.'.show',$docid);
              
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
        $docid = $inputs['visitplan_id'];
        $inputs['visitplan_id'] = $docid;
        $inputs['file_type'] = $inputs['doc_type'];
        $inputs['name'] = $inputs['doc_name'];
        $assetUpload = $this->postImageuploadAsset($docid);
        
        $model = new $this->modelAssetName();
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
