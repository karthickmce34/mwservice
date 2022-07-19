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
    public $modelVsExp      = 'App\Models\VisitExpensesModel';
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
        //print_r($user_type);die;
        if($user_type == 0 || $user_type == 2)
        {
           
            $model = new $this->modelName();
            $registerData = $model->where('visit_status',1)->get();
            //print_r($registerData);die;
        }
        else if ($user_type == 5)
        {
            $servicedatas = DB::select("SELECT distinct visit_plan.id FROM visit_plan,visitplan_engineer,service_engineer
                                        WHERE visit_plan.id = visitplan_engineer.visitplan_id
                                        and visitplan_engineer.engineer_id = service_engineer.id
                                        and visitplan_engineer.engineer_id = '$user_id'
                                        and visitplan_engineer.deleted_at is null
                                        and visit_status in (1)");
            $id=array();
             foreach($servicedatas as $servicedata)
             {
                 if(isset($servicedata->id))
                 {
                    $id[]=$servicedata->id;
                 }
             }

            $model = new $this->modelName();
            $registerData = $model->whereIn('id',$id)                    
                    ->get();
   //print_r($registerData);die;
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
        
        $report_file = request()->file('servicereport');
        $lodgingbill_file = request()->file('lodgingbill');
        $travelbill_file = request()->file('travelbill');
        $sld_file = request()->file('sld');
        $panelfront_file = request()->file('panelfront');
        $panelleft_file = request()->file('panelleft');
        $panelright_file = request()->file('panelright');
        $panelinside_file = request()->file('panelinside');
        $invoicecopy = request()->file('invoicecopy');
        $UPLOAD_PATH_URL   = Config::get('constant.UPLOAD_PATH_URL'); 
        $UPLOAD_PATH  = public_path($UPLOAD_PATH_URL);
        
        
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
                $inpData['file_path'] = "";
                $inpData['file_name'] = "";
                if($this->created_by)
                {
                    $inpData['created_by_id'] = session()->get('user_id');
                }
                if($inputs['is_agent']==0)
                {
                    $inpData['days_site']= $inputs['days_site'];
                    $loading=0;
                    $boarding = 0;
                    $travel = 0;
                    $local = 0;
                    for($i=1;$i<=count($inputs['engineer_id']);$i++)
                    {
                        $loading = $loading + $inputs['loading_expenses'][$i];
                        $boarding = $boarding + $inputs['boarding_expenses'][$i];
                        $travel = $travel + $inputs['travel_expenses'][$i];
                        $local = $local + $inputs['local_conveyance'][$i];
                    }
                    $inpData['loading_expenses']= $loading;
                    $inpData['boarding_expenses']= $boarding;
                    $inpData['travel_expenses']= $travel;
                    $inpData['local_conveyance']= $local;
                }
                else
                {
                    $inpData['invoice_bill'] = $inputs['invoice_bill'];
                }

                $inpData['date_of_attend']= $inputs['act_attend_date_from'];
                $inpData['date_of_complete']= $inputs['act_attend_date_to'];
                $inpData['work_description']= $inputs['work_description'];
                
                $inpData['outgoing_load']= $inputs['outgoing_load'];
                $inpData['relay_make_type']= $inputs['relay_make_type'];
                $inpData['cable_length']= $inputs['cable_length'];
                $inpData['fault_current']= $inputs['fault_current'];
                $inpData['vcb_interlock']= $inputs['vcb_interlock'];
                $inpData['after_commissioned']= $inputs['after_commissioned'];
                $inpData['event_before_failure']= $inputs['event_before_failure'];
                $inpData['serial_no']= $inputs['serial_no'];
                $inpData['transformer_rating']= $inputs['transformer_rating'];
                $inpData['others']= $inputs['others'];
                
                $inpData['status'] = 1;
                
                $modelsum = new $this->modelVsSum();
                $stored = $modelsum->addRecord($inpData);
                //print_r($inputs);die;
                if($stored && is_array($stored))
                {
                    return redirect()->back()->withErrors($stored)->withInput();
                }
                else
                {
                    if($inputs['is_agent']==0)
                    {
                        for($i=1;$i<=count($inputs['engineer_id']);$i++)
                        {
                            $inpexp = array();
                            $inpexp['visitplan_summary_id'] = $modelsum->id;
                            $inpexp['engineer_id'] = $inputs['engineer_id'][$i];
                            $inpexp['visitplan_id']= $docid;
                            $inpexp['is_agent']= $inputs['is_agent'];
                            $inpexp['loading_expenses'] = $inputs['loading_expenses'][$i];
                            $inpexp['boarding_expenses'] = $inputs['boarding_expenses'][$i];
                            $inpexp['travel_expenses'] = $inputs['travel_expenses'][$i];
                            $inpexp['local_expenses'] = $inputs['local_conveyance'][$i];
                            $inpexp['created_by_id'] = session()->get('user_id');
                            $inpexp['status'] = 1;
                            $modelsumexp = new $this->modelVsExp();
                            $storedexp = $modelsumexp->addRecord($inpexp);
                        }
                    }
                    
                    $service_report = $this->imageSummaryUploadFile($modelsum->id,$report_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);
                    
                    $modelsum->file_path = $service_report['file_path'];
                    $modelsum->file_name = $service_report['file_name'];
                    
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
                     
                    if(isset($invoicecopy))
                    {
                        /*****invoicecopy****/
                        $invoicecopy_bill = $this->imageSummaryUploadFile($modelsum->id,$invoicecopy,$UPLOAD_PATH,$UPLOAD_PATH_URL);

                        $modelsum->invoicebill_file_path = $invoicecopy_bill['file_path'];
                        $modelsum->invoicebill_file_name = $invoicecopy_bill['file_name'];
                    }
                    
                    /*****sld****/
                    $sld = $this->imageSummaryUploadFile($modelsum->id,$sld_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);
                    
                    $modelsum->sld_file_path = $sld['file_path'];
                    $modelsum->sld_file_name = $sld['file_name'];
                    
                    $panelfront = $this->imageSummaryUploadFile($modelsum->id,$panelfront_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);
                    
                    $modelsum->panelfront_file_path = $panelfront['file_path'];
                    $modelsum->panelfront_file_name = $panelfront['file_name'];
                    
                    $panelleft = $this->imageSummaryUploadFile($modelsum->id,$panelleft_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);
                    
                    $modelsum->panelleft_file_path = $panelleft['file_path'];
                    $modelsum->panelleft_file_name = $panelleft['file_name'];
                    
                    $panelright = $this->imageSummaryUploadFile($modelsum->id,$panelright_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);
                    
                    $modelsum->panelright_file_path = $panelright['file_path'];
                    $modelsum->panelright_file_name = $panelright['file_name'];
                    
                    $panelinside = $this->imageSummaryUploadFile($modelsum->id,$panelinside_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);
                    
                    $modelsum->panelinside_file_path = $panelinside['file_path'];
                    $modelsum->panelinside_file_name = $panelinside['file_name'];
                    $modelsum->save();
                    

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
                                $assetUpload = $this->postSummaryAsset($modelsum->id,$i);
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
                                
                                if(isset($inputs['billimage'][$j]))
                                {
                                    $assetUpload2 = $this->postProductSummaryAsset($modelsum->id,$j);
                                    if($assetUpload2['uploaded'])
                                    {
                                        $inpLnData1['file_path'] = $assetUpload2['file_path'];
                                        $inpLnData1['file_name'] = $assetUpload2['file_name'];
                                    }
                                    else
                                    {
                                        $inpLnData1['file_path'] = "";
                                        $inpLnData1['file_name'] = "";
                                    }
                                }
                                else
                                {
                                    $inpLnData1['file_path'] = "";
                                    $inpLnData1['file_name'] = "";
                                }

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
                    $registerData->visit_completed_date = date('Y-m-d');
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
                $loading=0;
                $boarding = 0;
                $travel = 0;
                $local = 0;
                for($i=1;$i<=count($inputs['engineer_id']);$i++)
                {
                    $loading = $loading + $inputs['loading_expenses'][$i];
                    $boarding = $boarding + $inputs['boarding_expenses'][$i];
                    $travel = $travel + $inputs['travel_expenses'][$i];
                    $local = $local + $inputs['local_conveyance'][$i];
                }
                $inpData['loading_expenses']= $loading;
                $inpData['boarding_expenses']= $boarding;
                $inpData['travel_expenses']= $travel;
                $inpData['local_conveyance']= $local;
            }
            else
            {
                $inpData['invoice_bill'] = $inputs['invoice_bill'];
            }

                $inpData['date_of_attend']= $inputs['act_attend_date_from'];
                $inpData['date_of_complete']= $inputs['act_attend_date_to'];
                $inpData['work_description']= $inputs['work_description'];
                
                $inpData['outgoing_load']= $inputs['outgoing_load'];
                $inpData['relay_make_type']= $inputs['relay_make_type'];
                $inpData['cable_length']= $inputs['cable_length'];
                $inpData['fault_current']= $inputs['fault_current'];
                $inpData['vcb_interlock']= $inputs['vcb_interlock'];
                $inpData['after_commissioned']= $inputs['after_commissioned'];
                $inpData['event_before_failure']= $inputs['event_before_failure'];
                $inpData['serial_no']= $inputs['serial_no'];
                $inpData['transformer_rating']= $inputs['transformer_rating'];
                $inpData['others']= $inputs['others'];
                
            $inpData['status'] = 1;
            $modelsum = new $this->modelVsSum();
            $stored = $modelsum->addRecord($inpData);

            if($stored && is_array($stored))
            {
                return redirect()->back()->withErrors($stored)->withInput();
            }
            else
            {
                if($inputs['is_agent']==0)
                {
                    for($i=1;$i<=count($inputs['engineer_id']);$i++)
                    {
                        $inpexp = array();
                        $inpexp['visitplan_summary_id'] = $modelsum->id;
                        $inpexp['engineer_id'] = $inputs['engineer_id'][$i];
                        $inpexp['visitplan_id']= $docid;
                        $inpexp['is_agent']= $inputs['is_agent'];
                        $inpexp['loading_expenses'] = $inputs['loading_expenses'][$i];
                        $inpexp['boarding_expenses'] = $inputs['boarding_expenses'][$i];
                        $inpexp['travel_expenses'] = $inputs['travel_expenses'][$i];
                        $inpexp['local_expenses'] = $inputs['local_conveyance'][$i];
                        $inpexp['created_by_id'] = session()->get('user_id');
                        $inpexp['status'] = 1;
                        $modelsumexp = new $this->modelVsExp();
                        $storedexp = $modelsumexp->addRecord($inpexp);
                    }
                }
                
                $service_report = $this->imageSummaryUploadFile($modelsum->id,$report_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);
                    
                $modelsum->file_path = $service_report['file_path'];
                $modelsum->file_name = $service_report['file_name'];
                
                
                    
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

                if(isset($invoicecopy))
                {
                    /*****invoicecopy****/
                    $invoicecopy_bill = $this->imageSummaryUploadFile($modelsum->id,$invoicecopy,$UPLOAD_PATH,$UPLOAD_PATH_URL);

                    $modelsum->invoicebill_file_path = $invoicecopy_bill['file_path'];
                    $modelsum->invoicebill_file_name = $invoicecopy_bill['file_name'];
                }

                /*****sld****/
                $sld = $this->imageSummaryUploadFile($modelsum->id,$sld_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);

                $modelsum->sld_file_path = $sld['file_path'];
                $modelsum->sld_file_name = $sld['file_name'];

                $panelfront = $this->imageSummaryUploadFile($modelsum->id,$panelfront_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);

                $modelsum->panelfront_file_path = $panelfront['file_path'];
                $modelsum->panelfront_file_name = $panelfront['file_name'];

                $panelleft = $this->imageSummaryUploadFile($modelsum->id,$panelleft_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);

                $modelsum->panelleft_file_path = $panelleft['file_path'];
                $modelsum->panelleft_file_name = $panelleft['file_name'];

                $panelright = $this->imageSummaryUploadFile($modelsum->id,$panelright_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);

                $modelsum->panelright_file_path = $panelright['file_path'];
                $modelsum->panelright_file_name = $panelright['file_name'];

                $panelinside = $this->imageSummaryUploadFile($modelsum->id,$panelinside_file,$UPLOAD_PATH,$UPLOAD_PATH_URL);

                $modelsum->panelinside_file_path = $panelinside['file_path'];
                $modelsum->panelinside_file_name = $panelinside['file_name'];
                $modelsum->save();

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

                            if(isset($inputs['billimage'][$j]))
                            {
                                $assetUpload2 = $this->postProductSummaryAsset($modelsum->id,$j);
                                if($assetUpload2['uploaded'])
                                {
                                    $inpLnData1['file_path'] = $assetUpload2['file_path'];
                                    $inpLnData1['file_name'] = $assetUpload2['file_name'];
                                }
                                else
                                {
                                    $inpLnData1['file_path'] = "";
                                    $inpLnData1['file_name'] = "";
                                }
                            }
                            else
                            {
                                $inpLnData1['file_path'] = "";
                                $inpLnData1['file_name'] = "";
                            }
                            
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
                $registerData->visit_completed_date = date('Y-m-d');
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
            

            $model = new $this->modelVsSumLn();
            $assetBasePath = $basePath .'VisitplanSummary/'.$docid;
            $baseAssetURL = $baseURL .'VisitplanSummary/'.$docid;
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
    
    public function postSummaryAsset($docid,$i)
    {        
        $inputs = request()->all();
        $_doc_file = request()->file('img_upload');
        $UPLOAD_PATH_URL   = Config::get('constant.UPLOAD_PATH_URL'); 
        $UPLOAD_PATH  = public_path($UPLOAD_PATH_URL);
        if($_doc_file)
            return $this->imageSummaryUploadFile($docid,$_doc_file[$i],$UPLOAD_PATH,$UPLOAD_PATH_URL);
        else
           return null;
    }
    
    public function postProductSummaryAsset($docid,$i)
    {        
        $inputs = request()->all();
        $_doc_file = request()->file('billimage');
        $UPLOAD_PATH_URL   = Config::get('constant.UPLOAD_PATH_URL'); 
        $UPLOAD_PATH  = public_path($UPLOAD_PATH_URL);
        if($_doc_file)
            return $this->imageSummaryUploadFile($docid,$_doc_file[$i],$UPLOAD_PATH,$UPLOAD_PATH_URL);
        else
           return null;
    }
}
