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


class PendingvisitplanController extends Controller
{
    public $modelName       = 'App\Models\VisitplanModel';
    public $modelAssetName  = 'App\Models\VisitplanAssetModel';
    public $modelPhoto      = 'App\Models\VisitplanPhotoModel';
    public $modelAgent      = 'App\Models\ServiceAgentModel';
    public $modelEngineer   = 'App\Models\ServiceEngineerModel';
    public $modelVsEng      = 'App\Models\VisitplanEngineerModel';
    public $modelVsSum      = 'App\Models\VisitplanSummaryModel';
    public $modelVsSumLn    = 'App\Models\VisitplanSummaryLineModel';
    public $modelProduct    = 'App\Models\VisitplanSummaryProductModel';
    public $modelComplaint  = 'App\Models\ComplaintRegisterModel';
    public $modelSerSp      = 'App\Models\ServiceSpareRegisterModel';
    public $baseRedirect    = 'pendingvisit.index';
    public $baseName        = 'pendingvisit';
    public $basePath        = 'pendingvisit/';
    public $detailName      = 'PendingvisitplanController@getIndex';
    public $detailSumName      = 'VisitplansummaryController@getIndex';
    
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
            $registerData = $model->where('visit_status',1)->get();
            //print_r($registerData);die;
        }
        else if ($user_type == 4)
        {
            $model = new $this->modelName();
            $registerData = $model->where('visit_status',1)
                    ->join('visitplan_engineer', 'visitplan_engineer.visitplan_id', '=', 'visit_plan.id')
                    ->where("visitplan_engineer.engineer_id","=",$user_id)
                    ->get();
        }
        
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
    
    public function postInsertsummary()
    {
         $status = 1;
        $message = "success";
        $inputs = request()->all();
        $docid = $inputs['id'];
        $test=request()->file('img_upload');
        $model = new $this->modelName();
        $registerData = $model->find($docid);
        $cnt = 0;
        if(isset($inputs['todo_id']))
        {
            $cnt = count($inputs['todo_id']);
            if($cnt > 0)
            {
                $inpData =array();
                $inpData['visitplan_id']= $docid;
                $inpData['is_agent']= $inputs['is_agent'];
                $inpData['days_site']=0;
                $inpData['loading_expenses']= 0;
                $inpData['boarding_expenses']= 0;
                $inpData['travel_expenses']= 0;
                $inpData['local_conveyance']= 0;
                if($this->created_by)
                {
                    $inpData['created_by_id'] = session()->get('user_id');
                }
                if($inputs['is_agent']==0)
                {
                    $inpData['days_site']= $inputs['days_site'];
                    $inpData['loading_expenses']= $inputs['loading_expenses'];
                    $inpData['boarding_expenses']= $inputs['boarding_expenses'];
                    $inpData['travel_expenses']= $inputs['travel_expenses'];
                    $inpData['local_conveyance']= $inputs['local_conveyance'];
                }

                $inpData['date_of_attend']= $inputs['act_attend_date_from'];
                $inpData['date_of_complete']= $inputs['act_attend_date_to'];
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

                    for($i=1;$i<=$cnt;$i++)
                    {
                        $inpLnData['visitplan_summary_id']= $modelsum->id;
                        $inpLnData['things_to_do_id']= $inputs['todo_id'][$i];

                        if(isset($inputs['ischecked'][$i]))
                        {
                            $inpLnData['remarks']= $inputs['remarks'][$i];
                            $inpLnData['ischecked']= $inputs['ischecked'][$i];
                            if(isset($inputs['img_upload'][$i]))
                            {
                                $assetUpload = $this->postImageuploadAsset($modelsum->id,$i);
                                if($assetUpload['uploaded'])
                                {
                                    $inpLnData['file_path'] = $assetUpload['file_path'];
                                    $inpLnData['file_name'] = $assetUpload['file_name'];
                                    $inpLnData['file_ext']  = $assetUpload['file_ext'];
                                    $inpLnData['file_type'] = 0;
                                }
                                else
                                {
                                    $inpLnData['remarks']= "";
                                    $inpLnData['ischecked']= 0;
                                    $inpLnData['file_path'] = "";
                                    $inpLnData['file_name'] = "";
                                    $inpLnData['file_ext'] = "";
                                    $inpLnData['file_type'] = 0;
                                }
                            }
                            else
                            {
                                $inpLnData['remarks']= "";
                                $inpLnData['ischecked']= 0;
                                $inpLnData['file_path'] = "";
                                $inpLnData['file_name'] = "";
                                $inpLnData['file_ext'] = "";
                                $inpLnData['file_type'] = 0;
                            }
                        }
                        else
                        {
                            $inpLnData['remarks']= "";
                            $inpLnData['ischecked']= 0;
                            $inpLnData['file_path'] = "";
                            $inpLnData['file_name'] = "";
                            $inpLnData['file_ext'] = "";
                            $inpLnData['file_type'] = 0;
                        }
                        if($this->created_by)
                        {
                            $inpLnData['created_by_id'] = session()->get('user_id');
                        }
                        $inpLnData['status'] = 1;
                        $modelsumln = new $this->modelVsSumLn();
                        $storedln = $modelsumln->addRecord($inpLnData);
                    }

                    $cnt2 = count($inputs['product']);
                    if($cnt2 > 0)
                    {
                        for($j=1;$j<=$cnt2;$j++)
                        {
                            if($inputs['product'][$j] != "")
                            {
                                $inpLnData1['visitplan_summary_id']= $modelsum->id;
                                $inpLnData1['product']= $inputs['product'][$j];
                                $inpLnData1['qty']= $inputs['qty'][$j];
                                $inpLnData1['unitprice']= $inputs['unitprice'][$j];
                                $inpLnData1['amount']= $inputs['amount'][$j];


                                if($this->created_by)
                                {
                                    $inpLnData1['created_by_id'] = session()->get('user_id');
                                }
                                $inpLnData1['status'] = 1;
                                $modelsumprd = new $this->modelProduct();
                                $storedprd = $modelsumprd->addRecord($inpLnData1);
                            }
                        }
                    }

                    $modelComp = new $this->modelComplaint();
                    $compdata = $modelComp->find($registerData->complaint_register_id);
                    $compdata->document_status = 2;
                    $compdata->complaint_status = 5;
                    $compdata->save();
                    
                    $modelService = new $this->modelSerSp();
                    $modelSerData = $modelService->find($registerData->servicespare_id);
                    $modelSerData->order_status = 8;
                    $modelSerData->save();
                    
                    $registerData->visit_status=2;
                    $registerData->save();
                }
                return redirect()->route('visitplansummary.show',$modelsum->id);
            }
            else
            {
                return redirect()->route('pendingvisit.show',$docid);
            }
             
        }
        else
        {
            
            $inpData =array();
            $inpData['visitplan_id']= $docid;
            $inpData['is_agent']= $inputs['is_agent'];
            $inpData['days_site']=0;
            $inpData['loading_expenses']= 0;
            $inpData['boarding_expenses']= 0;
            $inpData['travel_expenses']= 0;
            $inpData['local_conveyance']= 0;
            if($this->created_by)
            {
                $inpData['created_by_id'] = session()->get('user_id');
            }
            if($inputs['is_agent']==0)
            {
                $inpData['days_site']= $inputs['days_site'];
                $inpData['loading_expenses']= $inputs['loading_expenses'];
                $inpData['boarding_expenses']= $inputs['boarding_expenses'];
                $inpData['travel_expenses']= $inputs['travel_expenses'];
                $inpData['local_conveyance']= $inputs['local_conveyance'];
            }

            $inpData['date_of_attend']= $inputs['act_attend_date_from'];
            $inpData['date_of_complete']= $inputs['act_attend_date_to'];
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

                $cnt2 = count($inputs['product']);
                if($cnt2 > 0)
                {
                    for($j=1;$j<=$cnt2;$j++)
                    {
                        if($inputs['product'][$j] != "")
                        {
                            $inpLnData1['visitplan_summary_id']= $modelsum->id;
                            $inpLnData1['product']= $inputs['product'][$j];
                            $inpLnData1['qty']= $inputs['qty'][$j];
                            $inpLnData1['unitprice']= $inputs['unitprice'][$j];
                            $inpLnData1['amount']= $inputs['amount'][$j];


                            if($this->created_by)
                            {
                                $inpLnData1['created_by_id'] = session()->get('user_id');
                            }
                            $inpLnData1['status'] = 1;
                            $modelsumprd = new $this->modelProduct();
                            $storedprd = $modelsumprd->addRecord($inpLnData1);
                        }
                    }
                }

                $modelComp = new $this->modelComplaint();
                $compdata = $modelComp->find($registerData->complaint_register_id);
                $compdata->document_status = 2;
                $compdata->complaint_status = 5;
                $compdata->save();
                
                $modelService = new $this->modelSerSp();
                $modelSerData = $modelService->find($registerData->servicespare_id);
                $modelSerData->order_status = 8;
                $modelSerData->save();
                
                $registerData->visit_status=2;
                $registerData->save();
            }
            return redirect()->route('visitplansummary.show',$modelsum->id);
            
            
        }
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
            $assetBasePath = $basePath .'Visitplan/'.$docid;
            $baseAssetURL = $baseURL .'Visitplan/'.$docid;
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
    
}
