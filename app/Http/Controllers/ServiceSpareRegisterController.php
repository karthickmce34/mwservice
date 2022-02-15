<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;


use App\Models\ServiceSpareRegisterModel;
use App\Models\ServiceSpareRegisterAssetModel;
use App\Models\ProductModel as Product;

use JasperPHP\JasperPHP as JasperPHP;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class ServiceSpareRegisterController extends Controller
{
    public $modelName           = 'App\Models\ServiceSpareRegisterModel';
    public $modelAssetName      = 'App\Models\ServiceSpareRegisterAssetModel';
    public $modelCompName       = 'App\Models\ComplaintRegisterModel';
    public $modelThingstodo     = 'App\Models\ServiceSpareThingstodoModel';
    public $modelOfferdeatils   = 'App\Models\OfferDetailsModel';
    public $modelVisit          = 'App\Models\VisitplanModel';
    public $modelEngineer       = 'App\Models\ServiceEngineerModel';
    public $modelAgent          = 'App\Models\ServiceAgentModel';
    public $modelVsEng          = 'App\Models\VisitplanEngineerModel';
    public $modelPrdName        = 'App\Models\ProductModel';
    public $modelSSPrdName      = 'App\Models\ServiceSpareProductModel';
    public $modelSSPrdTax       = 'App\Models\ServiceProductTaxModel';
    public $modelSCPrd          = 'App\Models\ServiceChargeModel';
    public $modelTax            = 'App\Models\TaxModel';
    public $modelRegion         = 'App\Models\RegionModel';
    public $modelSegment        = 'App\Models\SegmentModel';
    public $baseRedirect        = 'servicespareregister.index';
    public $baseName            = 'servicespareregister';
    public $basePath            = 'servicespareregister/';
    public $detailName          = 'ServiceSpareRegisterController@getIndex';
    
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
        
        if(session()->get('user_type') == 0)
        {
            $registerData = $model->get();
            
        }
        if(session()->get('user_type') == 1)
        {
            $registerData = $model->where('complaint_type',1)->get();
        }
        if(session()->get('user_type') == 2)
        {
            $registerData = $model->where('complaint_type',0)->get();
        }
        $data['data'] = $registerData;
        $data['baseName'] = $this->baseName;
        $data['basePath'] = $this->basePath;
        return view($this->basePath . $this->baseName, $data);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $model = new $this->modelName();
        $record = $model->find($id);
        if(!$record)
        {
            return redirect()->route($this->baseRedirect);    
        } 
        
        $modeloffer = new $this->modelOfferdeatils();
        $offerdata = $modeloffer->where('service_spares_register_id',$id)->orderBy('id','desc')->first();
        $modelagent = new $this->modelAgent();
        $modelengineer = new $this->modelEngineer();
        $recagent = $modelagent->get();
        $engineerlists = $modelengineer->get();
        
        $modelprd = new $this->modelPrdName();
        $products = $modelprd->get();
        
        $modelscprd = new $this->modelSCPrd();
        $scproducts = $modelscprd->get();
        $terms="";
        
        $offervalidity   = Config::get('constant.OFFERVALIDITY');
        $freight   = Config::get('constant.FREIGHT');
        $deliveryperiod   = Config::get('constant.DELIVERYPERIOD');
        $paymentterms = Config::get('constant.PAYMENTTERM');
        $SegmentModel = new $this->modelSegment();
        $segmentData = $SegmentModel->where('segment_id',$record->complaint_type)->first();
        if($offerdata)
        {
            if($offerdata->terms == "" || $offerdata->terms == null)
            {
                
                $terms = $segmentData->terms;

            }
            else
            {
                $terms = $offerdata->terms;
            }
        }
        else
        {
            $offerdata=array();
            
            $terms = $segmentData->terms;
        }
        
        $this->data['modelAgents'] = $recagent;
        $this->data['modelEngLists'] = $engineerlists;
        
        $record->STATUS_VALUES = $model->getStaticVar('STATUS_VALUES');
        $record->COMPLAINT_TYPE_VALUES = $model->getStaticVar('COMPLAINT_TYPE_VALUES');
        $record->COMPLAINT_MODE_VALUES = $model->getStaticVar('COMPLAINT_MODE_VALUES');
        

        $this->data['record'] = $record;
        $this->data['baseName'] = $this->baseName;
        $this->data['basePath'] = $this->basePath;
        $this->data['terms'] = $terms;
        $this->data['offerdata'] = $offerdata;
        $this->data['offervalidity'] = $offervalidity;
        $this->data['freight'] = $freight;
        $this->data['deliveryperiod'] = $deliveryperiod;
        $this->data['paymentterms'] = $paymentterms;
        $this->data['products'] = $products;
        $this->data['services'] = $scproducts;
        return view($this->basePath . $this->baseName . '_detail', $this->data); 
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
        $inputs['scope_of_work'] ="";
        if($request->input('scope_of_work') != "")
        $inputs['scope_of_work'] = json_encode(implode(',', $request->input('scope_of_work')));
        //print_r($inputs);die;
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
        $modelComp = new $this->modelCompName();
        $modelCompData = $modelComp->find($modelData->complaint_register_id);
        $modelCompData->region_id = $inputs['region_id'];
        $modelCompData->save();
        return redirect()->route($this->baseName.'.show',$id);

    }
    
    public function edit($id)
    {
        $model = new $this->modelName();
        $record = $model->find($id);
        $offervalidity   = Config::get('constant.OFFERVALIDITY');
        $freight   = Config::get('constant.FREIGHT');
        $deliveryperiod   = Config::get('constant.DELIVERYPERIOD');
        
        if(!$record)
        {
            return redirect()->route($this->baseRedirect);    
        }
        if($record->terms == "" || $record->terms == null)
        {
            $SegmentModel = new $this->modelSegment();
            $segmentData = $SegmentModel->where('segment_id',$record->complaint_type)->first();
            $terms = $segmentData->terms;
            
        }
        else
        {
            $terms = $record->terms;
        }
        $modelRegion = new $this->modelRegion();
        $regiondata = $modelRegion->get();
        $this->data['modelData'] = $record;
        $this->data['terms'] = $terms;
        $this->data['offervalidity'] = $offervalidity;
        $this->data['freight'] = $freight;
        $this->data['deliveryperiod'] = $deliveryperiod;
        $this->data['regiondata'] = $regiondata;
        $this->data['baseName'] = $this->baseName;
        $this->data['basePath'] = $this->basePath;
        return view($this->basePath . $this->baseName . '_edit', $this->data);
    }

    
    public function addnew($id)
    {
        $data['modeName'] = "Add";
        
        $data['moduleName'] = $this->baseName;
        $data['id'] = $id;
        $this->data['modeName'] = $data['modeName'];
        
        return view($this->basePath . $this->baseName . '_addnew', $data); 

    }
    
    public function editprd($id)
    {
        $modelprd = new $this->modelPrdName();
        $products = $modelprd->get();
        $modelspprd = new $this->modelSSPrdName();
        $spprd = $modelspprd->find($id); 
        $data['moduleName'] = $this->baseName;
        $data['id'] = $id;
        $data['products'] = $products;
        $data['spprds'] = $spprd;
        
        return view($this->basePath . $this->baseName . '_editprd', $data); 

    }
    
    public function updateprd(Request $request, $id)
    {
        $status = 1;
        $message = "success";
        if( !isset($id) ||  (!($id > 0)) )
        {
            return redirect()->route($this->baseRedirect);    
        }
        
        $inputs = $request->all();
        $docid = $inputs['service_spares_register_id'];
        $inputs = request()->all();
        $model = new $this->modelSSPrdName();
        $modelData = $model->find($inputs['id']);
        $modelData->product_id = $inputs['product_id'];
        $modelData->prd_description = $inputs['product_id'];
        $modelData->unit_price = $inputs['unit_price'];
        $modelData->quantity = $inputs['quantity'];
        $modelData->total_price = $inputs['total_price'];
        $saved = $modelData->save();
        return redirect()->route($this->baseName.'.show',$docid);

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
        $modelcomp = new $this->modelCompName();
        $modelCompData = $modelcomp->find($inputs['compid']);
        
        if(isset($inputs['pay_mode']))
        {
            $modelData->payment_mode = $inputs['pay_mode'];
        }
        if(isset($inputs['pay_date']))
        {
            $modelData->paid_date = $inputs['pay_date'];
        }
        if(isset($inputs['pay_status']))
        {
            $modelCompData->payment_status = $inputs['pay_status'];
        }
        
        if($inputs['pay_status'] == 2)
        {
            $modelData->advance_amt = $inputs['advance_amt'];
            if($modelData->total_gross_amt == $inputs['advance_amt'])
            {
                $modelData->order_status = 5;
            }
            else
            {
                $modelData->order_status = 4;
            }
            
        }
        
        if($inputs['pay_status'] == 3)
        {
            $modelData->payment_received = $modelData->payment_received+$inputs['payment_amt'];
            $amt = $modelData->payment_received+$inputs['payment_amt'];
            if($modelData->total_gross_amt == $amt)
            {
                $modelData->order_status = 5;
            }
            else
            {
                $modelData->order_status = 4;
            }
                
        }
        
        if($inputs['pay_status'] == 4)
        {
            $modelData->payment_received = $modelData->total_gross_amt - $modelData->advance_amt;
            $modelData->order_status = 5;
        }
        
        if(!$modelData || !$modelCompData)
        {
            $this->data['status']=0;
            $this->data['message']="Not Success";
            return response()->json($this->data); 
        }
        else
        {
            $saved = $modelData->save();
            $saved2 = $modelCompData->save();
            $this->data['status']=1;
            $this->data['message']=$message;
            return response()->json($this->data);
        }
        
    }
    
    public function postThingstodo()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        
        $cnt =count($inputs['things_to_do']);
        $register_id = $inputs['register_id'];
        
        for($i=1;$i<=$cnt;$i++)
        {
           $things['things_to_do']=$inputs['things_to_do'][$i];
           $things['answer_type']=$inputs['answer_type'][$i];
           $things['created_by_id'] = session()->get('user_id');
           $things['service_spares_register_id'] = $register_id;
           $things['status'] = 1;
           $modelthings = new $this->modelThingstodo();
           $stored = $modelthings->addRecord($things);
        }
        
        $this->data['status']=1;
        $this->data['message']="Things To Do Added Successfully";
        return response()->json($this->data);
        
    }
    
    public function postServicecharge()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        
        $cnt =count($inputs['product']);
        $register_id = $inputs['register_id'];
        
        for($i=1;$i<=$cnt;$i++)
        {
            $prd['product_id']=$inputs['product_id'][$i];
            $prd['prd_description']=$inputs['product'][$i];
            $prd['description']=$inputs['description'][$i];
            $prd['quantity']=$inputs['qty'][$i];
            $prd['isreturn']=0;
            $prd['unit_price']=$inputs['unit_price'][$i];
            $prd['net_amt']=$inputs['qty'][$i]*$inputs['unit_price'][$i];
            $prd['total_price']=$inputs['total'][$i];
            $prd['tax_id']=$inputs['tax_id'][$i];
            $prd['tax_amt']=$inputs['tax_amt'][$i];
            $prd['created_by_id'] = session()->get('user_id');
            $prd['service_spares_register_id'] = $register_id;
            $prd['invoicable'] = 0;
            $prd['isserviceproduct'] = 1;
            $prd['status'] = 1;
            $modelprd = new $this->modelSSPrdName();
            $storedprd = $modelprd->addRecord($prd);
            if ($storedprd && is_array($storedprd)) {
                $this->data['status'] = 0;
                $this->data['message'] = "Not Successfully added";
                return response()->json($this->data);
            } 
            else
            {
                $modelTax = new $this->modelTax();
                $taxdata = $modelTax->find($inputs['tax_id'][$i]);
                $discount = 0;
                foreach($taxdata->taxgroup as $taxgroup)
                {
                    if(isset($inputs['discount'][$i]))
                    {
                        if($inputs['discount'][$i] != "")
                        {
                            $discount = $inputs['discount'][$i];
                        }
                    }
                        $netamt = (($inputs['qty'][$i]*$inputs['unit_price'][$i])-(($inputs['qty'][$i]*$inputs['unit_price'][$i])*($discount/100)));
                        $taxamt = (($netamt)*($taxgroup->taxrate->rate/100));
                        $prdtx['service_spares_product_id']=$modelprd->id;
                        $prdtx['tax_id']=$inputs['tax_id'][$i];
                        $prdtx['tax_group_id']=$taxgroup->id;
                        $prdtx['tax_rate_id']=$taxgroup->taxrate->id;
                        $prdtx['taxable_amount']=$netamt;
                        $prdtx['tax_amt']=$taxamt;
                        $prdtx['created_by_id'] = session()->get('user_id');
                        $prdtx['status'] = 1;
                    $modelsptax = new $this->modelSSPrdTax();
                    $storedprdtax = $modelsptax->addRecord($prdtx);
                }
            }
        }
        
        $this->data['status']=1;
        $this->data['message']="Things To Do Added Successfully";
        return response()->json($this->data);
        
    }
    
    public function postThingsedit()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        $modelthings = new $this->modelThingstodo();
        $modelData = $modelthings->find($inputs['id']);
       
        $this->data['status']=$status;
        $this->data['data']=$modelData;
        return response()->json($this->data);
    }
    
    public function postThingsupdate()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        
        $modelthings = new $this->modelThingstodo();
        $modelData = $modelthings->find($inputs['id']);
        
        $modelData->things_to_do = $inputs['things_to_do'];
        $modelData->answer_type = $inputs['answer_type'];
        $modelData->save();
        
        $this->data['status']=$status;

        return response()->json($this->data);
        
    }
    
    public function postThingstotaken()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        
        $cnt =count($inputs['things_to_taken']);
        $register_id = $inputs['register_id'];
        
        for($i=1;$i<=$cnt;$i++)
        {
           $things['prd_description']=$inputs['things_to_taken'][$i];
           $things['quantity']=$inputs['quantity'][$i];
           if(isset($inputs['isreturn'][$i]))
           {
               $things['isreturn']=0;
           }
           else
           {
               $things['isreturn']=1;
           }
           
           $things['created_by_id'] = session()->get('user_id');
           $things['service_spares_register_id'] = $register_id;
           $things['invoicable'] = 1;
           $things['isserviceproduct'] = 0;
           $things['status'] = 1;
           $modelthings = new $this->modelSSPrdName();
           $stored = $modelthings->addRecord($things);
        }
        
        $this->data['status']=1;
        $this->data['message']="Things To Do Added Successfully";
        return response()->json($this->data);
        
    }
    
    
    public function postTakenedit()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        $modelthings = new $this->modelSSPrdName();
        $modelData = $modelthings->find($inputs['id']);
        if(!$modelData)
        {
            $status=0;
        }
        $this->data['status']=$status;
        $this->data['data']=$modelData;
        return response()->json($this->data);
    }
    
    public function postTakenupdate()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        $modelthings = new $this->modelSSPrdName();
        $modelData = $modelthings->find($inputs['id']);
        
        $modelData->prd_description = $inputs['prd_description'];
        $modelData->quantity = $inputs['quantity'];
        $modelData->isreturn = $inputs['isreturn'];
        $modelData->save();
        
        $this->data['status']=$status;

        return response()->json($this->data);
        
    }
    
    public function addprd($id)
    {
        $data['modeName'] = "Add"; 
        $modelprd = new $this->modelPrdName();
        $products = $modelprd->get();
        $data['moduleName'] = $this->baseName;
        $data['id'] = $id;
        $this->data['modeName'] = $data['modeName'];
        $data['products'] = $products;
        
        return view($this->basePath . $this->baseName . '_addprd', $data); 
    }

    public function postStoreprd()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        $docid = $inputs['service_spares_register_id'];
        $inputs['status']=$status;
        if($this->created_by)
        {
            $inputs['created_by_id'] = session()->get('user_id');
        }
        $model = new $this->modelSSPrdName();
        $stored = $model->addRecord($inputs);
        
        if($stored && is_array($stored))
        {
            return redirect()->back()->withErrors($stored)->withInput();
        }
        
        return redirect()->route($this->baseName.'.show',$docid);
              
    }
    
    public function postDeputeengineer()
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
        
        $modelvisits = new $this->modelVisit();
        
        $regData=array();
        if($inputs['depute_engineer'] == 1 )
        {
            $regData['is_agent']=1;
            $regData['agent_id']=$inputs['agent_id'];
        }
        else
        {
            $regData['is_agent']=0;
        }
        $regData['complaint_register_id'] = $modelData->complaint_register_id;
        $regData['servicespare_id'] = $modelData->id;
        $regData['created_by_id'] = session()->get('user_id');
        $regData['date_of_depature']=$inputs['date_of_depature'];
        $regData['date_of_return']=$inputs['date_of_return'];
        $regData['days_site']=$inputs['days_site'];
        $regData['loading_expenses']=$inputs['loading_expenses'];
        $regData['boarding_expenses']=$inputs['boarding_expenses'];
        $regData['travel_expenses']=$inputs['travel_expenses'];
        $regData['local_conveyance']=$inputs['local_conveyance'];
        $regData['contact_person']=$inputs['contact_person'];
        $regData['status']=1;
        //print_r($regData);die;
        $stored = $modelvisits->addRecord($regData);
        
        if($stored && is_array($stored))
        {
            
            $this->data['status']=0;
            $this->data['message']="Not Success";
            return response()->json($this->data); 
        }
        else
        {
            if($inputs['depute_engineer'] == 0 )
            {
                $modelvisiteng = new $this->modelVsEng();
                
                foreach($inputs['engineer_id'] as $input)
                {
                    $inp=array();
                    $inp['visitplan_id'] = $modelvisits->id;
                    $inp['engineer_id'] = $input;
                    $inp['created_by_id'] = session()->get('user_id');
                    $inp['status'] = 1;
                    $modelEng = new $this->modelVsEng();
                    $stored = $modelEng->addRecord($inp);
                }
            }
            $modelData->site_depute=1;
            $modelData->order_status = 10;
            $saved = $modelData->save();
            $this->data['status']=1;
            $this->data['message']=$message;
            return response()->json($this->data);
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
    
    public function postProductadd()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        $inputs['status']=$status;
        
        $register_id=$inputs['service_spares_register_id'];
        $offer_id=$inputs['offer_details_id'];
        $cnt =count($inputs['product']);
        for($i=1;$i<=$cnt;$i++)
        {
            if($inputs['product'][$i] == "" || $inputs['product'][$i] == null )
            {
                if($inputs['description'][$i] == "" || $inputs['description'][$i] == null)
                {
                    
                }
                else
                {
                    $prd['product_id']=$inputs['product_id'][$i];
                    $prd['prd_description']=$inputs['product'][$i];
                    $prd['description']=$inputs['description'][$i];
                    $prd['quantity']=$inputs['qty'][$i];
                    $prd['isreturn']=0;
                    $prd['unit_price']=$inputs['unit_price'][$i];
                    $prd['discount']=$inputs['discount'][$i];
                    $prd['tax_id']=$inputs['tax_id'][$i];
                    $prd['net_amt']=(($inputs['qty'][$i]*$inputs['unit_price'][$i])-(($inputs['qty'][$i]*$inputs['unit_price'][$i])*($inputs['discount'][$i]/100)));
                    $prd['tax_amt']=$inputs['tax_amt'][$i];
                    $prd['total_price']=$inputs['total'][$i];
                    $prd['created_by_id'] = session()->get('user_id');
                    $prd['service_spares_register_id'] = $register_id;
                    $prd['offer_details_id'] = $offer_id;
                    $prd['invoicable'] = 0;
                    $prd['isserviceproduct'] = 0;
                    $prd['status'] = 1;
                    $modelprd = new $this->modelSSPrdName();
                    $storedprd = $modelprd->addRecord($prd);
                    if ($storedprd && is_array($storedprd)) {
                        $this->data['status'] = 0;
                        $this->data['message'] = "Not Successfully added";
                        return response()->json($this->data);
                    } 
                    else
                    {
                        if($inputs['tax_id'][$i] == "" || $inputs['tax_id'][$i] == null)
                        {
                            
                        }
                        else
                        {
                            $modelTax = new $this->modelTax();
                            $taxdata = $modelTax->find($inputs['tax_id'][$i]);

                            foreach($taxdata->taxgroup as $taxgroup)
                            {
                                $netamt = (($inputs['qty'][$i]*$inputs['unit_price'][$i])-(($inputs['qty'][$i]*$inputs['unit_price'][$i])*($inputs['discount'][$i]/100)));
                                $taxamt = (($netamt)*($taxgroup->taxrate->rate/100));
                                $prdtx['service_spares_product_id']=$modelprd->id;
                                $prdtx['tax_id']=$inputs['tax_id'][$i];
                                $prdtx['tax_group_id']=$taxgroup->id;
                                $prdtx['tax_rate_id']=$taxgroup->taxrate->id;
                                $prdtx['taxable_amount']=$netamt;
                                $prdtx['tax_amt']=$taxamt;
                                $prdtx['created_by_id'] = session()->get('user_id');
                                $prdtx['status'] = 1;
                                $modelsptax = new $this->modelSSPrdTax();
                                $storedprdtax = $modelsptax->addRecord($prdtx);
                            }
                        }
                            
                    }
                }
            }
            else
            {
                    $prd['product_id']=$inputs['product_id'][$i];
                    $prd['prd_description']=$inputs['product'][$i];
                    $prd['description']=$inputs['description'][$i];
                    $prd['quantity']=$inputs['qty'][$i];
                    $prd['isreturn']=0;
                    $prd['unit_price']=$inputs['unit_price'][$i];
                    $prd['discount']=$inputs['discount'][$i];
                    $prd['tax_id']=$inputs['tax_id'][$i];
                    $prd['net_amt']=(($inputs['qty'][$i]*$inputs['unit_price'][$i])-(($inputs['qty'][$i]*$inputs['unit_price'][$i])*($inputs['discount'][$i]/100)));
                    $prd['tax_amt']=$inputs['tax_amt'][$i];
                    $prd['total_price']=$inputs['total'][$i];
                    $prd['created_by_id'] = session()->get('user_id');
                    $prd['service_spares_register_id'] = $register_id;
                    $prd['offer_details_id'] = $offer_id;
                    $prd['invoicable'] = 0;
                    $prd['isserviceproduct'] = 0;
                    $prd['status'] = 1;
                    $modelprd = new $this->modelSSPrdName();
                    $storedprd = $modelprd->addRecord($prd);
                    if ($storedprd && is_array($storedprd)) {
                        $this->data['status'] = 0;
                        $this->data['message'] = "Not Successfully added";
                        return response()->json($this->data);
                    } 
                    else
                    {
                        if($inputs['tax_id'][$i] == "" || $inputs['tax_id'][$i] == null)
                        {
                            
                        }
                        else
                        {
                            $modelTax = new $this->modelTax();
                            $taxdata = $modelTax->find($inputs['tax_id'][$i]);

                            foreach($taxdata->taxgroup as $taxgroup)
                            {
                                $netamt = (($inputs['qty'][$i]*$inputs['unit_price'][$i])-(($inputs['qty'][$i]*$inputs['unit_price'][$i])*($inputs['discount'][$i]/100)));
                                $taxamt = (($netamt)*($taxgroup->taxrate->rate/100));
                                $prdtx['service_spares_product_id']=$modelprd->id;
                                $prdtx['tax_id']=$inputs['tax_id'][$i];
                                $prdtx['tax_group_id']=$taxgroup->id;
                                $prdtx['tax_rate_id']=$taxgroup->taxrate->id;
                                $prdtx['taxable_amount']=$netamt;
                                $prdtx['tax_amt']=$taxamt;
                                $prdtx['created_by_id'] = session()->get('user_id');
                                $prdtx['status'] = 1;
                                $modelsptax = new $this->modelSSPrdTax();
                                $storedprdtax = $modelsptax->addRecord($prdtx);
                            }
                        }
                            
                    }   
            }
                
        }
        
        $modelprd = new $this->modelSSPrdName();
        $prdDatas = $modelprd->where('service_spares_register_id',$register_id)->get();
        $total_price=0;
        foreach($prdDatas as $prdData)
        {
            $total_price = $total_price+$prdData->total_price;
        }
        $modelName = new $this->modelName();
        $modelData = $modelName->find($register_id);
        $modelData->total_gross_amt = $total_price;
        $modelData->save();
        
        $this->data['status']=1;
        $this->data['message']="Things To Do Added Successfully";
        return response()->json($this->data);
       
        
              
    }
    
    public function postProductupdte()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        if($inputs['discount'] == "")
        {
            $discount = 0;
        }
        else
        {
            $discount = $inputs['discount'];
        }
        $modelprd = new $this->modelSSPrdName();
        $modelData = $modelprd->find($inputs['service_product_id']);
        $modelData->product_id = $inputs['product_id'];
        $modelData->prd_description = $inputs['product'];
        $modelData->description = $inputs['description'];
        $modelData->unit_price = $inputs['unit_price'];
        $modelData->discount = $discount;
        $modelData->net_amt = (($inputs['qty']*$inputs['unit_price'])-(($inputs['qty']*$inputs['unit_price'])*($discount/100)));
        $modelData->quantity = $inputs['qty'];
        $modelData->total_price = $inputs['total'];
        $modelData->tax_id = $inputs['tax_id'];
        $modelData->tax_amt = $inputs['tax_amt'];
        $modelData->save();
        $modelssprdtx = new $this->modelSSPrdTax();
        $records = $modelssprdtx->where('service_spares_product_id',$inputs['service_product_id'])->get();
        foreach($records as $record)
        {
            $prddel = $modelssprdtx->find($record->id);
            $prddel->forcedelete();
        }
        $modelTax = new $this->modelTax();
        $taxdata = $modelTax->find($inputs['tax_id']);
        foreach($taxdata->taxgroup as $taxgroup)
        {
            $netamt = (($inputs['qty']*$inputs['unit_price'])-(($inputs['qty']*$inputs['unit_price'])*($discount/100)));
            $taxamt = (($netamt)*($taxgroup->taxrate->rate/100));
            $prdtx['service_spares_product_id']=$inputs['service_product_id'];
            $prdtx['tax_id']=$inputs['tax_id'];
            $prdtx['tax_group_id']=$taxgroup->id;
            $prdtx['tax_rate_id']=$taxgroup->taxrate->id;
            $prdtx['taxable_amount']=$netamt;
            $prdtx['tax_amt']=$taxamt;
            $prdtx['created_by_id'] = session()->get('user_id');
            $prdtx['status'] = 1;
            $modelsptax = new $this->modelSSPrdTax();
            $storedprdtax = $modelsptax->addRecord($prdtx);
        }
        
        $modelprd = new $this->modelSSPrdName();
        $prdDatas = $modelprd->where('service_spares_register_id',$modelData->service_spares_register_id)->get();
        $total_price=0;
        foreach($prdDatas as $prdData)
        {
            $total_price = $total_price+$prdData->total_price;
        }
        $modelName = new $this->modelName();
        $modelSSData = $modelName->find($modelData->service_spares_register_id);
        $modelSSData->total_gross_amt = $total_price;
        $modelSSData->save();
        
        $this->data['status']=1;
        $this->data['message']="Product Updated Successfully";
        return response()->json($this->data);
       
        
              
    }
    
    public function postOfferprint()
    {
        $inputs = request()->all();
        
        $status = 1;
        
        //$user_branch_id = session()->get('user-branch-id');
        
        $UPLOAD_PATH_REPORT_URL   = Config::get('constant.UPLOAD_PATH_REPORT_URL');
        $UPLOAD_PATH_RESULT_URL   = Config::get('constant.UPLOAD_PATH_RESULT_URL');
        //$clienttype = $inputs['client_type'];
        $reporttype = 'pdf';
        $filetype = 'pdf';
        $id = $inputs['id'];
        $fileexport = array();
        $cckey = array();
        $model = new $this->modelName();
        $modelData = $model->find($inputs['id']);
        $connection =     array(
                'driver' => 'mysql',
                'username' => env('DB_USERNAME','root'),
                'host' => env('DB_HOST','localhost'),
                'password' => env('DB_PASSWORD','12345'),
                'database' => env('DB_DATABASE','spares'),
                'port' => env('DB_PORT','3306')
              );
        
        //print_r($connection);die;
        
        $jaspername = "OfferPrint";
                $parameter = array(
                    'DOCUMENT_ID'=>$id,
                    'SUBREPORT_DIR' => public_path($UPLOAD_PATH_REPORT_URL).'/',
                    'BASE_IMAGE' => public_path($UPLOAD_PATH_REPORT_URL).'/',
                );
        //$UPLOAD_PATH_REPORT_URL   = Config::get('constant.UPLOAD_PATH_REPORT_URL');
       // echo "<pre>";print_r($inputs);die;
        
        ////**********download in  server starts *******************/////
        $jasper = new JasperPHP;
        
        $jasper1= $jasper->process(
            public_path($UPLOAD_PATH_REPORT_URL).'/'.$jaspername.'.jasper',
            public_path($UPLOAD_PATH_RESULT_URL).'/'."SparesAndServiceOffer".$id,
            array($filetype),
            $parameter,
            $connection
        )->execute();
        //print_r($jasper1);die;
        $data['name'] = 'OfferPrint';
        $data['ext'] = $filetype;
        $data['path'] = $UPLOAD_PATH_RESULT_URL;
        ////**********download in  server ends *******************/////
        $filepath = url($UPLOAD_PATH_RESULT_URL).'/'."SparesAndServiceOffer".$id.'.'.$filetype;
        $filename = public_path($UPLOAD_PATH_RESULT_URL).'/'."SparesAndServiceOffer".$id.'.'.$filetype;
        
        //$filename= $filename;
        $file_headers = $this->UR_exists($filepath);
        if ($file_headers == 0) 
        {
            $status=1;
        }
        
        
        $this->data['status'] = $status;
        $this->data['filepath'] = $filepath;
        $this->data['filetype'] = $filetype;
        //$headers = header("Content-Type: application/pdf");
        //echo "<pre>";print_r($filepath);print_r($file_headers);die;
        return response()->json($this->data);
      
    }
    
    public function postInvperformaprint()
    {
        $inputs = request()->all();

        $status = 1;
        
        //$user_branch_id = session()->get('user-branch-id');
        
        $UPLOAD_PATH_REPORT_URL   = Config::get('constant.UPLOAD_PATH_REPORT_URL');
        $UPLOAD_PATH_RESULT_URL   = Config::get('constant.UPLOAD_PATH_RESULT_URL');
        //$clienttype = $inputs['client_type'];
        $reporttype = 'pdf';
        $filetype = 'pdf';
        $id = $inputs['id'];
        $fileexport = array();
        $cckey = array();
           
        $connection =     array(
                'driver' => 'mysql',
                'username' => env('DB_USERNAME','root'),
                'host' => env('DB_HOST','localhost'),
                'password' => env('DB_PASSWORD','12345'),
                'database' => env('DB_DATABASE','spares'),
                'port' => env('DB_PORT','3306')
              );
        
        //print_r($connection);die;
        
        $jaspername = "ProformaInvoicenew";
                $parameter = array(
                    'DOCUMENT_ID'=>$id,
                    'SUBREPORT_DIR' => public_path($UPLOAD_PATH_REPORT_URL).'/',
                    'BASE_IMAGE' => public_path($UPLOAD_PATH_REPORT_URL).'/',
                );
        //$UPLOAD_PATH_REPORT_URL   = Config::get('constant.UPLOAD_PATH_REPORT_URL');
       // echo "<pre>";print_r($inputs);die;
        
        ////**********download in  server starts *******************/////
        $jasper = new JasperPHP;
        
        $jasper1= $jasper->process(
            public_path($UPLOAD_PATH_REPORT_URL).'/'.$jaspername.'.jasper',
            public_path($UPLOAD_PATH_RESULT_URL).'/'."Proformainvoice",
            array($filetype),
            $parameter,
            $connection
        )->execute();
        //print_r($jasper1);die;
        $data['name'] = 'Proformainvoice';
        $data['ext'] = $filetype;
        $data['path'] = $UPLOAD_PATH_RESULT_URL;
        ////**********download in  server ends *******************/////
        $filepath = url($UPLOAD_PATH_RESULT_URL).'/'."Proformainvoice".'.'.$filetype;
        $filename = public_path($UPLOAD_PATH_RESULT_URL).'/'."Proformainvoice".'.'.$filetype;
        
        //$filename= $filename;
        $file_headers = $this->UR_exists($filepath);
        if ($file_headers == 0) 
        {
            $status=1;
        }
        
        
        $this->data['status'] = $status;
        $this->data['filepath'] = $filepath;
        $this->data['filetype'] = $filetype;
        //$headers = header("Content-Type: application/pdf");
        //echo "<pre>";print_r($filepath);print_r($file_headers);die;
        return response()->json($this->data);
      
    }
    
    public function UR_exists($url)
    {
        $headers=get_headers($url);
        return stripos($headers[0],"200 OK")? 0 :1;
    }
    
    public function postOfferdata()
    {
        $inputs = request()->all();
        $id = $inputs['id'];
        $regid = $inputs['regid'];
        $compModel = new $this->modelCompName();
        $compData = $compModel->find($inputs['compid']);
        
        if(session()->get('user_type') == 0)
        {
            $fromaddress = Config::get('constant.ADMINID');
            
        }
        if(session()->get('user_type') == 1)
        {
            $fromaddress = Config::get('constant.spareid');//'spares@megawin.co.in';
        }
        if(session()->get('user_type') == 2)
        {
            $fromaddress = Config::get('constant.serviceid');//'service@megawin.co.in';
        }
        if($inputs['type'] == 0)
        {
            $filename = "Spares_Offer_".str_replace(" ","-",$compData->seqno);
            $jaspername = "OfferPrint";

        }
        else
        {
            $filename = "PerformaInvoice_".str_replace(" ","-",$compData->seqno);
            $jaspername = "ProformaInvoicenew";
        }
        $region_email = "";
        $reportfile = $this->generatereport($id,$filename,$jaspername);
        $this->data['filepath']=$reportfile;
        $this->data['subject']="Spares Offer - ".str_replace(" ","-",$compData->seqno);
        $this->data['filename']=$filename.".pdf";
        $this->data['fromaddress']=$fromaddress;
        $this->data['type']=$compData['complaint_type'];
        $this->data['toaddress']=$compData['emailid'];
        $this->data['contact_person']=$compData['contact_person'];
        if($compData->region)
        {
            $region_email=$compData->region->region_email;
        }
        $this->data['ccaddress']=$region_email;
        $this->data['status']=1;
        return response()->json($this->data);
    }
    
    public function postEmailsend()
    {
        $inputs = request()->all();
        
        $mail = new PHPMailer(true);
        $UPLOAD_PATH_RESULT_URL   = Config::get('constant.UPLOAD_PATH_RESULT_URL');

        if(session()->get('user_type') == 0)
        {
            $fromaddress = Config::get('constant.ADMINID');
            $fromname = 'Megawin-Admin';
            $frompassword = Config::get('constant.adminpassword');
            
        }
        if(session()->get('user_type') == 1)
        {
            $fromaddress = Config::get('constant.spareid');//'spares@megawin.co.in';
            $fromname = 'Megawin-Spares';
            $frompassword = Config::get('constant.sparepassword');
        }
        if(session()->get('user_type') == 2)
        {
            $fromaddress = Config::get('constant.serviceid');//'service@megawin.co.in';
            $fromname = 'Megawin-Service';
            $frompassword = Config::get('constant.servicepassword');
        }
        
        
        
        try {

            // Email server settings
            $mail->SMTPDebug = 1;
            $mail->isSMTP();
            $mail->Host = 'smtp-mail.outlook.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = $fromaddress;   //  sender username
            $mail->Password = $frompassword;       // sender password
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465

            $mail->setFrom($fromaddress, $fromname);
            $toaddress = explode(',',$inputs['toaddress']);
            foreach($toaddress as $toaddr)
            {
            $mail->addAddress($toaddr);
            }
            if($inputs['ccaddress'])
            {
                $ccaddress = explode(',',$inputs['ccaddress']);
                foreach($ccaddress as $ccaddr)
                {
                $mail->addAddress($ccaddr);
                }
            }
            $mail->Subject = $inputs['subject'];
            $body = $inputs['content'];
            /*if(preg_match('/img.*?>/', $body))
            { // there is a prob here and next line the preg_match is img tags
                preg_match_all('/<img.*?>/', $body, $matches);
                print_r($matches);die;
                $i = 1;
                /*foreach ($matches[0] as $img)
                {
                    $id = 'img_'.($i++);
                    preg_match('/src="(.*?)"/', $img, $m);
                    $imgdata = explode(',',$m[1]);
                    //print_r($m[1]);   was a test and showed the encoded image code
                    $mime = explode(';', $imgdata[0]);
                    $imgtype = explode(':', $mime[0]);  
                    $mail->AddStringEmbeddedImage(base64_decode($imgdata[1]), $id, 'new_'.$id, $mime[1], $imgtype[1] );
                    //$mail->AddStringEmbeddedImage($imgdata[1], $id, 'new_'.$id, $mime[1], $imgtype[1] );
            //imgtype alternative was to try this 'application/octet-stream'
                    $nbody = str_replace($img, '', $body);
                    //print_r($nbody);
                    //$mail->MsgHTML($nbody);
                    $mail->Body    =  $nbody;
                }
            } 
            else 
            {
                $mail->MsgHTML($body);
            }*/
            $mail->MsgHTML($body);
            
            $filepath = public_path($UPLOAD_PATH_RESULT_URL).'/'.$inputs['attachname'];
                $mail->addAttachment($filepath,$inputs['attachname']);
            if(isset($_FILES['attachment'])) {
                for ($i=0; $i < count($_FILES['attachment']['tmp_name']); $i++) {
                    $mail->addAttachment($_FILES['attachment']['tmp_name'][$i], $_FILES['attachment']['name'][$i]);
                }
            }

            $mail->WordWrap   = 80;
            
            $mail->isHTML(true);                // Set email content format to HTML

            // $mail->AltBody = plain text version of email body;
            $mailsend=$mail->send();
            if( !$mailsend ) {
                $this->data['message']='Email not sent.';
                $this->data['status']=0;
                return response()->json($this->data);
            }
            
            else {
                $model = new $this->modelName();
                $modeldata = $model->find($inputs['regid']);
                $modeldata->offer_date=date('Y-m-d');
                $modeldata->order_status=1;
                $modeldata->save();
                $this->data['message']='Email has been sent.';
                $this->data['status']=1;
                return response()->json($this->data);
            }

        } catch (Exception $e) {
			//print_r("failed");die;
            $this->data['message']='Message Could not be sent.';
            $this->data['status']=0;
            return response()->json($this->data);
        }
    }
    
    function generatereport($id,$filename,$jaspername)
    {
        $UPLOAD_PATH_REPORT_URL   = Config::get('constant.UPLOAD_PATH_REPORT_URL');
        $UPLOAD_PATH_RESULT_URL   = Config::get('constant.UPLOAD_PATH_RESULT_URL');
        //$clienttype = $inputs['client_type'];
        $reporttype = 'pdf';
        $filetype = 'pdf';

        $fileexport = array();
        $cckey = array();
        $model = new $this->modelName();
        $modelData = $model->find($id);
        $connection =     array(
                'driver' => 'mysql',
                'username' => env('DB_USERNAME','root'),
                'host' => env('DB_HOST','localhost'),
                'password' => env('DB_PASSWORD','12345'),
                'database' => env('DB_DATABASE','spares'),
                'port' => env('DB_PORT','3306')
              );
        
        //print_r($connection);die;
        
                $parameter = array(
                    'DOCUMENT_ID'=>$id,
                    'SUBREPORT_DIR' => public_path($UPLOAD_PATH_REPORT_URL).'/',
                    'BASE_IMAGE' => public_path($UPLOAD_PATH_REPORT_URL).'/',
                );
        //$UPLOAD_PATH_REPORT_URL   = Config::get('constant.UPLOAD_PATH_REPORT_URL');
       // echo "<pre>";print_r($inputs);die;
        
        ////**********download in  server starts *******************/////
        $jasper = new JasperPHP;
        
        $jasper1= $jasper->process(
            public_path($UPLOAD_PATH_REPORT_URL).'/'.$jaspername.'.jasper',
            public_path($UPLOAD_PATH_RESULT_URL).'/'.$filename,
            array($filetype),
            $parameter,
            $connection
        )->execute();
        ////**********download in  server ends *******************/////
        $filepath = url($UPLOAD_PATH_RESULT_URL).'/'.$filename.'.'.$filetype;
        $filename = public_path($UPLOAD_PATH_RESULT_URL).'/'.$filename.'.'.$filetype;
        
        //$filename= $filename;
        $file_headers = $this->UR_exists($filepath);
        if ($file_headers == 0) 
        {
            $status=1;
        }
        return $filepath;
    }
    
    public function postServicechargeedit()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        $modelthings = new $this->modelSSPrdName();
        $modelData = $modelthings->find($inputs['id']);
        if(!$modelData)
        {
            $status=0;
        }
        $this->data['status']=$status;
        $this->data['data']=$modelData;
        return response()->json($this->data);
    }
    
    public function postServicechargeupdate()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        $discount=0;
        //dd($inputs);
        $modelprd = new $this->modelSSPrdName();
        $modelData = $modelprd->find($inputs['service_product_id']);
        $modelData->product_id = $inputs['product_id'];
        $modelData->prd_description = $inputs['product'];
        $modelData->description = $inputs['description'];
        $modelData->unit_price = $inputs['unit_price'];
        $modelData->discount = $discount;
        $modelData->net_amt = (($inputs['qty']*$inputs['unit_price'])-(($inputs['qty']*$inputs['unit_price'])*($discount/100)));
        $modelData->quantity = $inputs['qty'];
        $modelData->total_price = $inputs['total'];
        $modelData->tax_id = $inputs['tax_id'];
        $modelData->tax_amt = $inputs['tax_amt'];
        $modelData->save();
        $modelssprdtx = new $this->modelSSPrdTax();
        $records = $modelssprdtx->where('service_spares_product_id',$inputs['service_product_id'])->get();
        foreach($records as $record)
        {
            $prddel = $modelssprdtx->find($record->id);
            $prddel->forcedelete();
        }
        $modelTax = new $this->modelTax();
        $taxdata = $modelTax->find($inputs['tax_id']);
        foreach($taxdata->taxgroup as $taxgroup)
        {
            $netamt = (($inputs['qty']*$inputs['unit_price'])-(($inputs['qty']*$inputs['unit_price'])*($discount/100)));
            $taxamt = (($netamt)*($taxgroup->taxrate->rate/100));
            $prdtx['service_spares_product_id']=$inputs['service_product_id'];
            $prdtx['tax_id']=$inputs['tax_id'];
            $prdtx['tax_group_id']=$taxgroup->id;
            $prdtx['tax_rate_id']=$taxgroup->taxrate->id;
            $prdtx['taxable_amount']=$netamt;
            $prdtx['tax_amt']=$taxamt;
            $prdtx['created_by_id'] = session()->get('user_id');
            $prdtx['status'] = 1;
            $modelsptax = new $this->modelSSPrdTax();
            $storedprdtax = $modelsptax->addRecord($prdtx);
        }
        
        $modelprd = new $this->modelSSPrdName();
        $prdDatas = $modelprd->where('service_spares_register_id',$modelData->service_spares_register_id)->get();
        $total_price=0;
        foreach($prdDatas as $prdData)
        {
            $total_price = $total_price+$prdData->total_price;
        }
        $modelName = new $this->modelName();
        $modelSSData = $modelName->find($modelData->service_spares_register_id);
        $modelSSData->total_gross_amt = $total_price;
        $modelSSData->save();
        
        $this->data['status']=1;
        $this->data['message']="Product Updated Successfully";
        return response()->json($this->data);
       
        
              
    }
    
    public function postUpdateorderstatus()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        $model = new $this->modelName();
        $modelData = $model->find($inputs['id']);
        
        $modelData->order_status=$inputs['orderstatus'];
        if($inputs['orderstatus']== 2)
        {
            $modelData->po_ref=$inputs['order_ref_no'];
            $modelData->po_date=$inputs['po_date'];
        }
        if($inputs['orderstatus']== 1)
        {
            $modelData->offer_date = date('Y-m-d');
        }
        if($inputs['orderstatus']== 3)
        {
            $modelData->pi_date = date('Y-m-d');
        }
        
        $modelData->save();
        $this->data['status']=1;
        $this->data['message']="Status Updated Successfully";
        return response()->json($this->data);
    }
    
    public function deletePrd($id)
    {
        $model = new $this->modelSSPrdName();
        $record = $model->find($id);
        $docid = $record->service_spares_register_id;
        $record->delete();
        $modelssprdtx = new $this->modelSSPrdTax();
        $records = $modelssprdtx->where('service_spares_product_id',$id)->get();
        foreach($records as $record)
        {
            $prddel = $modelssprdtx->find($record->id);
            $prddel->forcedelete();
        }
        return redirect()->route($this->baseName . '.show', $docid);
    }
    
    public function deletethingstodo($id)
    {
        $model = new $this->modelThingstodo();
        $record = $model->find($id);
        $docid = $record->service_spares_register_id;
        $record->delete();
        
        return redirect()->route($this->baseName . '.show', $docid);
    }
    
    public function offeradd()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        //print_r($inputs);die;
        $offer['service_spares_register_id']=$inputs['spares_register_id'];
        $offer['offer_date']=date('Y-m-d');
        $offer['revision_no']=$inputs['revision_no'];
        $offer['offervalidity']=$inputs['offervalidity'];
        $offer['freight']=$inputs['freight'];
        $offer['deliveryperiod']=$inputs['deliveryperiod'];
        $offer['paymentterms']=$inputs['paymentterms'];
        $offer['dayscredit']=$inputs['dayscredit'];
        $offer['terms']=$inputs['terms'];
        $offer['created_by_id'] = session()->get('user_id');
        $offer['status'] = 1;
        $offerModel = new $this->modelOfferdeatils();
        
        $storedoffer = $offerModel->addRecord($offer);
        if ($storedoffer && is_array($storedoffer)) {
            $this->data['status'] = 0;
            $this->data['message'] = "Not Successfully added";
            return response()->json($this->data);
        } 
        else
        {
            $modelssprd = new $this->modelSSPrdName();
            $SSproducts = $modelssprd->where('offer_details_id',$inputs['last_offer_id'])->get();
            if($SSproducts)
            {
                foreach($SSproducts as $SSproduct)
                {
                    $prd=array();
                    $prd['product_id']=$SSproduct['product_id'];
                    $prd['prd_description']=$SSproduct['prd_description'];
                    $prd['description']=$SSproduct['description'];
                    $prd['quantity']=$SSproduct['quantity'];
                    $prd['isreturn']=$SSproduct['isreturn'];
                    $prd['unit_price']=$SSproduct['unit_price'];
                    $prd['discount']=$SSproduct['discount'];
                    $prd['tax_id']=$SSproduct['tax_id'];
                    $prd['net_amt']=$SSproduct['net_amt'];
                    $prd['tax_amt']=$SSproduct['tax_amt'];
                    $prd['total_price']=$SSproduct['total_price'];
                    $prd['created_by_id'] = session()->get('user_id');
                    $prd['service_spares_register_id'] = $SSproduct['service_spares_register_id'];
                    $prd['offer_details_id'] = $offerModel->id;
                    $prd['invoicable'] = $SSproduct['invoicable'];
                    $prd['isserviceproduct'] = $SSproduct['isserviceproduct'];
                    $prd['status'] = 1;
                    $modelprd = new $this->modelSSPrdName();
                    $storedprd = $modelprd->addRecord($prd);
                    if ($storedprd && is_array($storedprd)) {
                        $this->data['status'] = 0;
                        $this->data['message'] = "Not Successfully added";
                        return response()->json($this->data);
                    } 
                    else
                    {
                        if($SSproduct['tax_id'] == "" || $SSproduct['tax_id'] == null)
                        {
                            
                        }
                        else
                        {
                            $modelTax = new $this->modelTax();
                            $taxdata = $modelTax->find($SSproduct['tax_id']);

                            foreach($taxdata->taxgroup as $taxgroup)
                            {
                                $netamt = $SSproduct['net_amt'];
                                $taxamt = (($netamt)*($taxgroup->taxrate->rate/100));
                                $prdtx['service_spares_product_id']=$modelprd->id;
                                $prdtx['tax_id']=$SSproduct['tax_id'];
                                $prdtx['tax_group_id']=$taxgroup->id;
                                $prdtx['tax_rate_id']=$taxgroup->taxrate->id;
                                $prdtx['taxable_amount']=$netamt;
                                $prdtx['tax_amt']=$taxamt;
                                $prdtx['created_by_id'] = session()->get('user_id');
                                $prdtx['status'] = 1;
                                $modelsptax = new $this->modelSSPrdTax();
                                $storedprdtax = $modelsptax->addRecord($prdtx);
                            }
                        }
                            
                    }  
                }
            }
            
            $modelName = new $this->modelName();
            $modelData = $modelName->find($inputs['spares_register_id']);
            $modelData->final_offer_id=$offerModel->id;
            $modelData->save();
            
            $this->data['status'] = 1;
            $this->data['message'] = "Successfully added";
            return response()->json($this->data);
            
        }
    }
    
    public function postUpdatedefault()
    {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        $model = new $this->modelName();
        $modelData = $model->find($inputs['ssid']);
        $offerid = $inputs['offerid'];
        
        if(!$modelData)
        {
            $this->data['status']=0;
            $this->data['message']="Not Success";
            return response()->json($this->data); 
        }
        else
        {
            $modelData->final_offer_id = $offerid;
            $saved = $modelData->save();
            $this->data['status']=1;
            $this->data['message']=$message;
            return response()->json($this->data);
        }
        
    }
}
