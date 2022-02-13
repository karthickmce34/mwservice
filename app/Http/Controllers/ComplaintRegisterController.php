<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request2;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use App\Libraries\Helpers\SmsHelper;
use App\Models\ComplaintRegisterModel;
use App\Models\ComplaintRegisterAssetModel;
use App\Models\ServiceChargeModel;

class ComplaintRegisterController extends Controller {

    public $modelName       = 'App\Models\ComplaintRegisterModel';
    public $modelTax        = 'App\Models\TaxModel';
    public $modelAssetName  = 'App\Models\ComplaintRegisterAssetModel';
    public $modelRegName    = 'App\Models\ServiceSpareRegisterModel';
    public $modelSerName    = 'App\Models\ServiceChargeModel';
    public $modelSSPrdName  = 'App\Models\ServiceSpareProductModel';
    public $modelSSPrdTax   = 'App\Models\ServiceProductTaxModel';
    public $modelDocseq     = 'App\Models\DocseqModel';
    public $modelOfferdetails   = 'App\Models\OfferDetailsModel';
    public $modelRegion     = 'App\Models\RegionModel';
    public $modelSegment    = 'App\Models\SegmentModel';
    public $baseRedirect    = 'complaintregister.index';
    public $baseName        = 'complaintregister';
    public $basePath        = 'complaintregister/';
    public $detailName      = 'ComplaintRegisterController@getIndex';

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
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
    public function show($id) {

        $model = new $this->modelName();
        $record = $model->find($id);
        if (!$record) {
            return redirect()->route($this->baseRedirect);
        }
        $modelService = new $this->modelSerName();
        $modelData = $modelService->all();
        
        $record->STATUS_VALUES = $model->getStaticVar('STATUS_VALUES');
        $record->COMPLAINT_MODE_VALUES = $model->getStaticVar('COMPLAINT_MODE_VALUES');
        $record->COMPLAINT_TYPE_VALUES = $model->getStaticVar('COMPLAINT_TYPE_VALUES');
        $offervalidity   = Config::get('constant.OFFERVALIDITY');
        
        $SegmentModel = new $this->modelSegment();
        $segmentData = $SegmentModel->where('segment_id',$record->complaint_type)->first();
        $terms = $segmentData->terms;
        
        $this->data['record'] = $record;
        $this->data['modelData'] = $modelData;
        $this->data['offervalidity'] = $offervalidity;
        $this->data['terms'] = $terms;
        $this->data['baseName'] = $this->baseName;
        $this->data['basePath'] = $this->basePath;
        return view($this->basePath . $this->baseName . '_detail', $this->data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['modeName'] = "Add";
        
        $isspares=0;
        $year=date('Y');
        $month=date('m');
        $seqmodel = new $this->modelDocseq();
        $seqdata = $seqmodel->where('is_spares',$isspares)
                            ->where('year',$year)
                            ->where('month',$month)->first();
        if($seqdata->seqno <=9)
        {
            $seq=$seqdata->prefix.' '.substr($seqdata->year,2,4).$seqdata->month.'00'.$seqdata->seqno;
        }
        else
        {
            if($seqdata->seqno >9 )
            {
                $seq=$seqdata->prefix.' '.substr($seqdata->year,2,4).$seqdata->month.'0'.$seqdata->seqno;
            }
            else
            {
                $seq=$seqdata->prefix.' '.substr($seqdata->year,2,4).$seqdata->month.$seqdata->seqno;
            }
        }
        
        $data['docseq_no'] = $seq;
        
        $data['moduleName'] = $this->baseName;
        $this->data['modeName'] = $data['modeName'];
        $this->data['docseq_no'] = $data['docseq_no'];
        
        return view($this->basePath . $this->baseName . '_add', $data); 

    }
    
    public function edit($id)
    {
        $model = new $this->modelName();
        $record = $model->find($id);
        if(!$record)
        {
            return redirect()->route($this->baseRedirect);    
        }
        $modelRegion = new $this->modelRegion();
        $regiondata = $modelRegion->get();
        $this->data['modelData'] = $record;
        $this->data['regiondata'] = $regiondata;
        $this->data['baseName'] = $this->baseName;
        $this->data['basePath'] = $this->basePath;
        return view($this->basePath . $this->baseName . '_edit', $this->data);
    }

    public function store(Request2 $request) {
        $status = 1;
        $message = "success";

        $inputs = $request->all();
        if ($this->created_by) {
            $inputs['created_by_id'] = session()->get('user_id');
        }

        $inputs['status'] = 1;
        $model = new $this->modelName();

        $stored = $model->addRecord($inputs);

        if ($stored && is_array($stored)) {
            return redirect()->back()->withErrors($stored)->withInput();
        } else {
            $docid = $model->id;
            $inputs1['file_type'] = 0;
            $inputs1['complaint_register_id'] = $docid;
            $assetUpload = $this->postImageuploadAsset($docid);
            if ($this->created_by) {
                $inputs1['created_by_id'] = session()->get('user_id');
            }
            if ($assetUpload['uploaded']) {
                $inputs1['file_path'] = $assetUpload['file_path'];
                $inputs1['file_name'] = $assetUpload['file_name'];
                $inputs1['file_ext'] = $assetUpload['file_ext'];
                $inputs1['name'] = $assetUpload['file_name'];
            }
            $inputs1['status'] = 1;
            $model1 = new $this->modelAssetName();

            $stored1 = $model1->addRecord($inputs1);

            if ($stored1 && is_array($stored1)) {
                return redirect()->back()->withErrors($stored1)->withInput();
            } else {
                $mobile = $inputs['mobileno'];
                $usr = $inputs['mobileno'];
                $message = "Dear Customer, Thanks for contacting Megawin. Your Service request is registered in our portal(Ref Id: " . $docid . ")";
                $apirequest = new SmsHelper();
                $smspush = $apirequest->smsToCustomer($mobile, $message);
                return redirect()->route($this->baseName . '.show', $model->id);
            }
        }
    }

    public function addnew($id) {
        $data['modeName'] = "Add";

        $data['moduleName'] = $this->baseName;
        $data['id'] = $id;
        $this->data['modeName'] = $data['modeName'];

        return view($this->basePath . $this->baseName . '_addnew', $data);
    }

    public function editdoc($id) {
        $data['modeName'] = "Add";
        $model = new $this->modelAssetName();
        $modelData = $model->find($id);
        $data['moduleName'] = $this->baseName;
        $data['modelData'] = $modelData;

        return view($this->basePath . $this->baseName . '_editdoc', $data);
    }

    public function postStoredoc() {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        
        $docid = $inputs['complaint_register_id'];
        $inputs['complaint_register_id'] = $docid;
        $inputs['file_type'] = $inputs['doc_type'];
        $inputs['name'] = $inputs['doc_name'];
        
        $_doc_files = request()->file('doc_upload');
        
        $UPLOAD_PATH_URL = Config::get('constant.UPLOAD_PATH_URL');
        $UPLOAD_PATH = public_path($UPLOAD_PATH_URL);
        if(count($_doc_files) > 0)
        {
            foreach($_doc_files as $_doc_file)
            {
                if ($_doc_file)
                {
                    $assetUpload = $this->imageUploadFile($docid, $_doc_file, $UPLOAD_PATH, $UPLOAD_PATH_URL);
                    if ($this->created_by) {
                        $inputs['created_by_id'] = session()->get('user_id');
                    }
                    if ($assetUpload['uploaded']) {
                        $inputs['file_path'] = $assetUpload['file_path'];
                        $inputs['file_name'] = $assetUpload['file_name'];
                        $inputs['file_ext'] = $assetUpload['file_ext'];
                    }

                    $model = new $this->modelAssetName();

                    $stored = $model->addRecord($inputs);
                    if ($stored && is_array($stored)) {
                        return redirect()->back()->withErrors($stored)->withInput();
                    }
                }
                else
                {
                    
                }
                    
            }
        }
        //$assetUpload = $this->postImageuploadAsset($docid);
                    

                
        return redirect()->route($this->baseName . '.show', $docid);
    }

    public function updatedoc(Request2 $request, $id) {
        $status = 1;
        $message = "success";
        if (!isset($id) || (!($id > 0))) {
            return redirect()->route($this->baseRedirect);
        }

        $inputs = $request->all();
        $docid = $inputs['complaint_register_id'];
        $inputs['complaint_register_id'] = $docid;
        $inputs['file_type'] = $inputs['doc_type'];
        $inputs['name'] = $inputs['doc_name'];
        $assetUpload = $this->postImageuploadAsset($docid);

        $model = new $this->modelAssetName();
        $modelData = $model->find($id);
        if (!$modelData) {
            return redirect()->route($this->baseRedirect);
        }
        if ($assetUpload['uploaded']) {
            if ($modelData->file_name <> $assetUpload['file_name']) {
                $inputs['file_path'] = $assetUpload['file_path'];
                $inputs['file_name'] = $assetUpload['file_name'];
                $inputs['file_ext'] = $assetUpload['file_ext'];
            }
        }
        $saved = $modelData->updateData($inputs);
        if ($saved && is_array($saved)) {
            return redirect()->back()->withErrors($saved)->withInput();
        }
        return redirect()->route($this->baseName . '.show', $docid);
    }

    public function postUpdatestatus() {
        $status = 1;
        $message = "success";
        $inputs = request()->all();
        $model = new $this->modelName();
       
        //for($)
             
        $modelData = $model->find($inputs['id']);
        $modelData->complaint_status = $inputs['comp_status'];
        $modelData->remark = $inputs['remark'];
        
        
        $compstatus = '';
        if ($inputs['comp_status'] == 1)
        {
            $compstatus=0;
        }
        else
        {
           if ($inputs['comp_status'] == 3)
            {
                $compstatus=1;
            }
            else
            {
                $compstatus=2;
            } 
        }
        
        
        
        
        if (!$modelData) {
            $this->data['status'] = 0;
            $this->data['message'] = "Not Success";
            return response()->json($this->data);
        } else {
            if ($inputs['comp_status'] == 0) {
                $this->data['status'] = 1;
                $modelData->document_status = 2;
                $modelData->save();
                $this->data['message'] = $message;
                $mobile = $modelData->mobileno;
                $smsmessage = "Dear Customer, Your Service request (Ref Id: " . $modelData->id . ") is resolved by our expert through Phone/Email. Thanks for contacting Megawin. ";
                $apirequest = new SmsHelper();
                //$smspush = $apirequest->smsToCustomer($mobile, $smsmessage);
                return response()->json($this->data);
            } else {
                $modelRegister = new $this->modelRegName();

                $inputs['scope_of_work'] = json_encode($inputs['chkval']);//json_encode($request->input('scope_of_work'));//implode(',', (array) $request->input('scope_of_work'));
                $cnt = count($inputs['product']);
                
                $regData = array();
                $regData['complaint_register_id'] = $modelData->id;
                $regData['complaint_type'] = $compstatus;
                $regData['created_by_id'] = session()->get('user_id');
                $regData['scope_of_work'] = $inputs['scope_of_work'];
                $regData['scope_of_work_o'] = $inputs['scopeofwork'];
                $regData['failure_cause'] = $inputs['failure_cause'];
                $regData['status'] = 1;
                $stored = $modelRegister->addRecord($regData);

                if ($stored && is_array($stored)) {
                    $this->data['status'] = 0;
                    $this->data['message'] = "Not Success";
                    return response()->json($this->data);
                } else {
                    $SegmentModel = new $this->modelSegment();
                    $segmentData = $SegmentModel->where('segment_id',$compstatus)->first();
                    
                    $offer['service_spares_register_id']=$modelRegister->id;
                    $offer['offer_date']=date('Y-m-d');
                    $offer['revision_no']='R0';
                    $offer['offervalidity']=0;
                    $offer['freight']=0;
                    $offer['deliveryperiod']=0;
                    $offer['paymentterms']=0;
                    $offer['dayscredit']=0;
                    $offer['terms']=$inputs['terms'];
                    $offer['created_by_id'] = session()->get('user_id');
                    $offer['status'] = 1;
                    $offerModel = new $this->modelOfferdetails();
                    $storedoffer = $offerModel->addRecord($offer);
                    
                    if ($storedoffer && is_array($storedoffer)) 
                    {
                        $this->data['status'] = 0;
                        $this->data['message'] = "Not Successfully added";
                        return response()->json($this->data);
                    } 
                    else
                    {
                        $modelRegister->final_offer_id =  $offerModel->id;
                        $modelRegister->save();
                        
                        if($cnt > 0)
                        {
                            for($i=1;$i<=$cnt;$i++)
                            {
                                if($inputs['product_id'][$i] = "" && $inputs['product'][$i] = "" && $inputs['qty'][$i] == "")
                                {

                                }
                                else
                                {
                                    $prd['product_id']=$inputs['product_id'][$i];
                                    $prd['prd_description']=$inputs['product'][$i];
                                    $prd['quantity']=$inputs['qty'][$i];
                                    $prd['isreturn']=0;
                                    $prd['unit_price']=$inputs['amount'][$i];
                                    $prd['net_amt']=$inputs['qty'][$i]*$inputs['amount'][$i];
                                    $prd['total_price']=$inputs['total'][$i];
                                    $prd['tax_id']=$inputs['tax_id'][$i];
                                    $prd['tax_amt']=$inputs['tax_amt'][$i];
                                    $prd['created_by_id'] = session()->get('user_id');
                                    $prd['service_spares_register_id'] = $modelRegister->id;
                                    $prd['offer_details_id'] = $offerModel->id;
                                    $prd['invoicable'] = 0;
                                    $prd['isserviceproduct'] = 1;
                                    $prd['status'] = 1;
                                    $modelprd = new $this->modelSSPrdName();
                                    $storedprd = $modelprd->addRecord($prd);
                                    if ($storedprd && is_array($storedprd)) {
                                        $this->data['status'] = 0;
                                        $this->data['message'] = "Not Success";
                                        return response()->json($this->data);
                                    } 
                                    else
                                    {
                                        $modelTax = new $this->modelTax();
                                        $taxdata = $modelTax->find($inputs['tax_id'][$i]);
                                        foreach($taxdata->taxgroup as $taxgroup)
                                        {
                                            $taxamt = (($inputs['qty'][$i]*$inputs['amount'][$i])*($taxgroup->taxrate->rate/100));
                                            $prdtx['service_spares_product_id']=$modelprd->id;
                                            $prdtx['tax_id']=$inputs['tax_id'][$i];
                                            $prdtx['tax_group_id']=$taxgroup->id;
                                            $prdtx['tax_rate_id']=$taxgroup->taxrate->id;
                                            $prdtx['taxable_amount']=$inputs['total'][$i];
                                            $prdtx['tax_amt']=$taxamt;
                                            $prdtx['created_by_id'] = session()->get('user_id');
                                            $prdtx['status'] = 1;
                                            $modelsptax = new $this->modelSSPrdTax();
                                            $storedprdtax = $modelsptax->addRecord($prdtx);
                                        }
                                    }
                                }

                            }
                            if ($stored && is_array($stored)) {
                                $this->data['status'] = 0;
                                $this->data['message'] = "Not Success";
                                return response()->json($this->data);
                            } 

                        }
                    }
                        
                    
                    $this->data['status'] = 1;
                    $modelData->document_status = 1;
                    $modelData->save();
                    $this->data['message'] = $message;
                    $this->data['cusid'] = $modelRegister->id;
                    return response()->json($this->data);
                        
                        
                }
            }
        }
    }

    public function deleteDoc($id)
    {
        $model = new $this->modelAssetName();
        $record = $model->find($id);
        $docid = $record->complaint_register_id;
        $record->delete();
        return redirect()->route($this->baseName . '.show', $docid);
    }
    public function imageUploadFile($docid, $fileObj, $basePath, $baseURL) {
        $response = array();
        $response['uploaded'] = false;
        $vlf = $fileObj->isValid();
        if ($vlf) {
            $fileName = $fileObj->getClientOriginalName();
            $fileName3 = $fileName;
            $fileNames = explode(".", $fileName3);
            $fileNames2 = $fileNames;
            array_pop($fileNames2);
            $fileName2 = join('', $fileNames2);
            $extension = end($fileNames);

            $inputs = request()->all();

            $model = new $this->modelName();
            $assetBasePath = $basePath . 'register/' . $docid;
            $baseAssetURL = $baseURL . 'register/' . $docid;
            if (!is_dir($assetBasePath)) {
                $this->createPath($assetBasePath);
            }
            // check if file exists
            $fileNamePath = $assetBasePath . '/' . $fileName;
            $destinationPath = $assetBasePath;
            $n = 0;
            while (file_exists($fileNamePath)) {
                $n++;
                $fileName = $fileName2 . "_" . $n . "." . $extension;
                $fileNamePath = $assetBasePath . $fileName;
            }

            //$uploaded = move_uploaded_file($_FILES['file']['tmp_name'], $fileNamePath);
            $uploaded = $fileObj->move($destinationPath, $fileName);


            $response['uploaded'] = $uploaded;
            if ($uploaded) {
                $response['file_name'] = $fileName;
                $response['file_path'] = $baseAssetURL;
                $response['file_type'] = 0;
                if (isset($this->file_types[strtolower($extension)]))
                    $response['file_type'] = $this->file_types[strtolower($extension)];

                $response['file_ext'] = $extension;
            }
        }
        return $response;
    }

    public function postImageuploadAsset($docid) {
        $inputs = request()->all();
        
        $_doc_files = request()->file('doc_upload');
        
        $UPLOAD_PATH_URL = Config::get('constant.UPLOAD_PATH_URL');
        $UPLOAD_PATH = public_path($UPLOAD_PATH_URL);
        if(count($_doc_files) > 0)
        {
            foreach($_doc_files as $_doc_file)
            {
                if ($_doc_file)
                    return $this->imageUploadFile($docid, $_doc_file, $UPLOAD_PATH, $UPLOAD_PATH_URL);
                else
                    return null;
            }
        }
        
    }

    public function taxcalc()
    {
        $inputs=request()->all();
        $taxmodel = new $this->modelTax();
        $taxdata = $taxmodel->find($inputs['tax_id']);
        $taxgroups = $taxdata->taxgroup;
        $rate=0;
        foreach($taxgroups as $taxgroup)
        {
            $rate = $rate+$taxgroup->taxrate->rate;
        }
        $this->data['status'] = 1;
        $this->data['rate'] = $rate;
        return response()->json($this->data);
    }
    

}
