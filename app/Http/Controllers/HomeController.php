<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Libraries\Helpers\SmsHelper;


class HomeController extends Controller
{
    public $modelName       = 'App\Models\ComplaintRegisterModel';
    public $modelRegName    = 'App\Models\ServiceSpareRegisterModel';
    public $modelOfferName  = 'App\Models\OfferDetailsModel';
    public $modelPrdName    = 'App\Models\ProductModel';
    public $modelSSPrdName  = 'App\Models\ServiceSpareProductModel';
    public $modelTax        = 'App\Models\TaxModel';
    public $modelSSPrdTax   = 'App\Models\ServiceProductTaxModel';
    public $modelDocseq     = 'App\Models\DocseqModel';
    public $modelAttend     = 'App\Models\AttendanceModel';
    public $modelUser       = 'App\Models\UserModel';
    public $modelRegion     = 'App\Models\RegionModel';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*Auth::logout();
        session()->flush();*/
        $this->middleware('auth');
        
        /*if(!Auth::check()) {
            return redirect()->guest(route('login'));
        }*/
        
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $t=time();
        
        $method = 'GET';
        $url = "https://telephonycloud.co.in/api/v1/dashboard?svc-id=1086";
        $username = '9789464775';
        $password = 'admin';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        
        $datas = json_decode($output, TRUE);
        if($datas)
        {
            foreach($datas['agents'] as $data)
            {
                $record['id'] = $data['id'];
                $record['number'] = $data['number'];
                $record['name'] = $data['name'];
                $record['user_id'] = $data['user_id'];
                $trxn_id = $data['call_txn_id'];
                $recentcalls= "https://telephonycloud.co.in/api/v1/agent-recent-calls?svc-id=1086&recent_txn_id=".$trxn_id;

                $ch2 = curl_init();
                curl_setopt($ch2, CURLOPT_URL, $recentcalls);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch2, CURLOPT_USERPWD, "$username:$password");
                curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                $output2 = curl_exec($ch2);
                $info2 = curl_getinfo($ch2);
                curl_close($ch2);

                $datas2 = json_decode($output2, TRUE);

                foreach($datas2 as $data2)
                {
                    $record['duration'] = $data2['duration'];
                    $record['receivedBy'] = $data2['receivedBy'];
                    $record['disposition'] = $data2['disposition'];
                    $record['recording'] = $data2['recording'];
                    $record['time'] = $data2['time'];
                    $record['customerNumber'] = $data2['customerNumber'];
                    $record['callType'] = $data2['ivrData'];
                    $record['xnid'] = $data2['xnid'];               

                    //echo "<pre>";
                    //print_r($record);
                }



            }
        }
        //die;
        $model = new $this->modelName();
        $sprphone = 0;
        $serphone = 0;
        $spremail = 0;
        $seremail = 0;
        
        $pending = 0;
        $completed = 0;
        $service = 0;
        $spare = 0;
        $serviceandspares = 0;
        $enq = 0;
        $ofrsent = 0;
        $pisent = 0;
        $dispatch = 0;
        $frmdate = date('Y-m-d', strtotime('today - 30 days'));
        
        $pastmodeldatas = DB::table('complaint_register')->where('complaint_date', '>=', $frmdate)->get();
        $sprmodeldatas = DB::table('complaint_register')->where('complaint_type',1)->get();
        $sermodeldatas = DB::table('complaint_register')->where('complaint_type',0)->get();
        $spenqdatas = DB::table('service_spares_register')->get();
        $visitdatas = DB::table('visit_plan')->join('visitplan_engineer','visit_plan.id','=','visitplan_engineer.visitplan_id')
                                            ->join('service_engineer','visitplan_engineer.engineer_id','=','service_engineer.id')
                                            ->where('visit_plan.visit_status',2)
                                            ->select('service_engineer.name')->get();
        
        $pendenqs = DB::table('service_spares_register')
                        ->join('complaint_register','complaint_register.id','=','service_spares_register.complaint_register_id')
                        ->where('service_spares_register.complaint_type',1)
                        ->whereIn('service_spares_register.order_status',[0])
                        ->select('complaint_register.seqno','complaint_register.complaint_date','complaint_register.customer_name','complaint_register.mobileno')
                        ->orderBy('complaint_register.complaint_date','desc')->get();
        
        $newenqs = DB::table('service_spares_register')
                        ->join('complaint_register','complaint_register.id','=','service_spares_register.complaint_register_id')
                        ->where('service_spares_register.complaint_type',1)
                        ->where('service_spares_register.order_status',0)
                        ->where('complaint_register.complaint_date',date('Y-m-d'))
                        ->select('complaint_register.seqno','complaint_register.complaint_date','complaint_register.customer_name','complaint_register.mobileno')
                        ->orderBy('complaint_register.complaint_date','desc')->get();
        
        

        
        /*foreach($modeldatas as $modeldata)
         {
             if($modeldata->mode_of_complaint == 0)
             {
                 $phone = $phone+1;
             }
             else
             {
                 $email = $email+1;
             }
             if($modeldata->document_status == 2)
             {
                 $completed = $completed+1;
             }
             else if($modeldata->document_status == 1 || $modeldata->document_status == 0)
             {
                 $pending = $pending+1;
             }
             
                 
         }*/
         foreach($sprmodeldatas as $sprmodeldata)
         {
             if($sprmodeldata->mode_of_complaint == 0)
             {
                 $sprphone = $sprphone+1;
             }
             else
             {
                 $spremail = $spremail+1;
             }
         }
         
         foreach($sermodeldatas as $sermodeldata)
         {
             if($sermodeldata->mode_of_complaint == 0)
             {
                 $serphone = $serphone+1;
             }
             else
             {
                 $seremail = $seremail+1;
             }
             if($sermodeldata->document_status == 2)
             {
                 $completed = $completed+1;
             }
             else if($sermodeldata->document_status == 1 || $sermodeldata->document_status == 0)
             {
                 $pending = $pending+1;
             }
         }
         
        foreach($pastmodeldatas as $pastmodeldata)
        {

            if($pastmodeldata->complaint_type == 0)
            {
                $service = $service+1;
            }
            else if ($pastmodeldata->complaint_type == 1)
            {
                $spare = $spare+1;
            }
            else
            {
                $serviceandspares = $serviceandspares+1;
            }

        }
        
        foreach($spenqdatas as $spenqdata)
         {
            if($spenqdata->order_status == 0)
            {
                $enq = $enq+1;
            }
            if($spenqdata->order_status == 1)
            {
                $ofrsent = $ofrsent+1;
            }
            if($spenqdata->order_status == 3)
            {
                $pisent = $pisent+1;
            }
            if($spenqdata->order_status == 5)
            {
                $dispatch = $dispatch+1;
            }
             
                 
         }
         
        
         
        $data['sprphone']=$sprphone;
        $data['serphone']=$serphone;
        $data['spremail']=$spremail;
        $data['seremail']=$seremail;
        $data['completed']=$completed;
        $data['pending']=$pending;
        $data['enq']=$enq;
        $data['ofrsent']=$ofrsent;
        $data['pisent']=$pisent;
        $data['dispatch']=$dispatch;
        $data['service']=$service;
        $data['spare']=$spare;
        $data['penenqs']=$pendenqs;
        $data['newenqs']=$newenqs;
        $data['serviceandspares']=$serviceandspares;
        
        return view('home',$data);
    }
    
    public function getIndex()
    {
        return $this->index();
    }
    
    public function getAppdata(Request $request)
    {
         $status = 1;
        $message = "success";
        $inputs = $request->all();
        
        if($this->created_by)
        {
            $inputs['created_by_id'] = session()->get('user_id');
        }
        $inputs['complaint_type']=0;
        $inputs['payment_status'] =$inputs['warranty'];
        $model = new $this->modelName();
        $inputs['status'] = 1;
        $stored = $model->addRecord($inputs);
        
        
        if($stored && is_array($stored))
        {
            $this->data['status'] = 0;
            return response()->json($this->data);
        }
        else
        {
            $isspares=0;
            $year=date('Y');
            $month=date('m');
            $seqmodel = new $this->modelDocseq();
            $seqdata = $seqmodel->where('is_spares',$isspares)
                            ->where('doctype',0)
                            ->where('year',$year)
                            ->where('month',$month)->first();
            $seqdata->seqno=$seqdata->seqno+1;
            $seqdata->save();
            
            $this->data['status'] = 1;
            $this->data['message'] = $message;
            $mobile = $inputs['mobileno'];
            $usr = $inputs['mobileno'];
            $message = "Dear Customer, Thanks for contacting Megawin. Your Service request is registered in our portal(Ref Id: " . $inputs['seqno'] . ")";
            //$apirequest = new SmsHelper();
            return response()->json($this->data);
        }
              
    }
    
    public function getSpareappdata(Request $request)
    {
         $status = 1;
        $message = "success";
        $inputs = $request->all();
        
        if($this->created_by)
        {
            $inputs['created_by_id'] = session()->get('user_id');
        }
        $inputs['salesorder_no'] =$inputs['spareorder_no'];
        $inputs['payment_status'] =1;
        $inputs['document_status'] =1;
        $inputs['complaint_type']=1;
        $model = new $this->modelName();
        $inputs['status'] = 1;
        $stored = $model->addRecord($inputs);
        
        
        if($stored && is_array($stored))
        {
            $this->data['status'] = 0;
            return response()->json($this->data);
        }
        else
        {
                $isspares=1;
                $year=date('Y');
                $month=date('m');
                $seqmodel = new $this->modelDocseq();
                $seqdata = $seqmodel->where('is_spares',$isspares)
                                ->where('doctype',0)
                                ->where('year',$year)
                                ->where('month',$month)->first();
                $seqdata->seqno=$seqdata->seqno+1;
                $seqdata->save();
                
                $modelRegister = new $this->modelRegName();

                $regData = array();
                $regData['complaint_register_id'] = $model->id;
                $regData['complaint_type'] = 1;
                $regData['created_by_id'] = session()->get('user_id');
                $regData['scope_of_work'] = "";
                $regData['scope_of_work_o'] = "";
                $regData['failure_cause'] = "";
                $regData['status'] = 1;
                $stored2 = $modelRegister->addRecord($regData);

                if ($stored2 && is_array($stored2)) {
                    $this->data['status'] = 0;
                    $this->data['message'] = "Not Success";
                    return response()->json($this->data);
                } else {
                    $cnt = count($inputs['product']);
                    if($cnt > 0)
                    { 
                        //-------------------------------------------
                        $offer['service_spares_register_id'] = $modelRegister->id;
                        $offer['offer_date'] = date('Y-m-d');
                        $offer['revision_no'] = 'R0';
                        $offer['offervalidity'] = 0;
                        $offer['freight'] = 0;
                        $offer['deliveryperiod'] = 0;
                        $offer['paymentterms'] = 0;
                        $offer['dayscredit'] = 0;
                        $offer['created_by_id'] = session()->get('user_id');
                        $offer['status'] = 1;
                        $modelOffer = new $this->modelOfferName();
                        
                        $storedoffer = $modelOffer->addRecord($offer);
                        
                        if ($storedoffer && is_array($storedoffer)) {
                            $this->data['status'] = 0;
                            $this->data['message'] = "Not Success";
                            return response()->json($this->data);
                        } else {
                            $totalprice = 0;
                            for($i=1;$i<=$cnt;$i++)
                            {
                                $prd['product_id']=$inputs['product_id'][$i];
                                $prd['prd_description']=$inputs['product'][$i];
                                $prd['description']=$inputs['description'][$i];
                                $prd['quantity']=$inputs['qty'][$i];
                                $prd['isreturn']=0;
                                $prd['unit_price']=$inputs['unit_price'][$i];
                                $prd['net_amt']=$inputs['qty'][$i]*$inputs['unit_price'][$i];
                                $prd['discount']=$inputs['discount'][$i];
                                $prd['total_price']=$inputs['total'][$i];
                                $prd['tax_id']=$inputs['tax_id'][$i];
                                $prd['tax_amt']=$inputs['tax_amt'][$i];
                                $prd['created_by_id'] = session()->get('user_id');
                                $prd['service_spares_register_id'] = $modelRegister->id;
                                $prd['offer_details_id'] = $modelOffer->id;
                                $prd['invoicable'] = 0;
                                $prd['isserviceproduct'] = 0;
                                $prd['status'] = 1;
                                $modelprd = new $this->modelSSPrdName();
                                $storedprd = $modelprd->addRecord($prd);
                                if ($storedprd && is_array($storedprd)) {
                                    $this->data['status'] = 0;
                                    $this->data['message'] = "Not Successfully Added";
                                    return response()->json($this->data);
                                } 
                                else
                                {
                                    $totalprice = $totalprice+$inputs['total'][$i];
                                    $modelTax = new $this->modelTax();
                                    $taxdata = $modelTax->find($inputs['tax_id'][$i]);
                                    foreach($taxdata->taxgroup as $taxgroup)
                                    {
                                        $taxamt = (($inputs['qty'][$i]*$inputs['unit_price'][$i])*($taxgroup->taxrate->rate/100));
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
                            if ($stored && is_array($stored)) {
                                $this->data['status'] = 0;
                                $this->data['message'] = "Not Success";
                                return response()->json($this->data);
                            } 
                            else
                            {
                                $this->data['status'] = 1;

                                $modelRegister->total_gross_amt = $totalprice;
                                $modelRegister->save();

                                $this->data['message'] = $message;
                                $this->data['cusid'] = $modelRegister->id;
                                $mobile = $inputs['mobileno'];
                                $usr = $inputs['mobileno'];
                                $message = "Dear Customer, Thanks for contacting Megawin. Your Service request is registered in our portal(Ref Id: ". $inputs['seqno'] .")";
                                $apirequest = new SmsHelper();
                                //$smspush = $apirequest->smsToCustomer($mobile, $message);

                                return response()->json($this->data);
                            }
                        }
                        //-------------------------------------------
                            
                    }
                }
        }
              
    }
    
    public function getCusdata(Request $request)
    {
        $status = 1;
        $message = "success";
        $inputs = $request->all();
        
        $wrd = $inputs['wrd'];
        
        $user_type = session()->get('user_type');
        
        $model = new $this->modelName();
        $modelreg = new $this->modelRegName();
        
        if($user_type == 0 || $user_type == 2)
        {
            $qry = $model->Where('customer_name','like','%' . $wrd . '%')
                    ->leftjoin('service_spares_register', 'service_spares_register.complaint_register_id', '=', 'complaint_register.id')
                    ->orWhere('complaint_register.id','=',$wrd)
                    ->orWhere('complaint_register.seqno','like','%' . $wrd . '%')
                    ->where('complaint_register.complaint_type',0)
                    ->select('complaint_register.id','complaint_register.customer_name','complaint_register.seqno','complaint_register.document_status','complaint_register.complaint_date','complaint_register.complaint_nature')
                    ->get();
        }
        else
        {
            $qry = $model->Where('customer_name','like','%' . $wrd . '%')
                    ->join('service_spares_register', 'service_spares_register.complaint_register_id', '=', 'complaint_register.id')
                    ->orWhere('service_spares_register.id','=',$wrd)
                    ->orWhere('complaint_register.seqno','like','%' . $wrd . '%')
                    ->where('complaint_register.complaint_type',0)
                    ->select('service_spares_register.id','complaint_register.customer_name','complaint_register.seqno','complaint_register.document_status','complaint_register.complaint_date','complaint_register.complaint_nature')
                    ->get();
        }
        return response()->json($qry);
              
    }
    
    public function CallAPI($method, $url, $data) {
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        print_r("hai");
        print_r($curl);die;
        $result = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $data = ["result" => $result, "httpCode" => $httpCode];
        switch ($httpCode) {
            case 200:
                $error_status = "200: Success";
                return ($data);
                break;
            case 404:
                $error_status = "404: API Not found";
                $data1 = ["result" => $error_status, "httpCode" => $httpCode];
                return ($data1);
                break;
            case 500:
                $error_status = "500: servers replied with an error.";
                $data1 = ["result" => $error_status, "httpCode" => $httpCode];
                return ($data1);
                break;
            case 502:
                $error_status = "502: servers may be down or being upgraded. Hopefully they'll be OK soon!";
                $data1 = ["result" => $error_status, "httpCode" => $httpCode];
                return ($data1);
                break;
            case 503:
                $error_status = "503: service unavailable. Hopefully they'll be OK soon!";
                $data1 = ["result" => $error_status, "httpCode" => $httpCode];
                return ($data1);
                break;
            default:
                $error_status = "Undocumented error: " . $httpCode . " : " . curl_error($curl);
                $data1 = ["result" => $error_status, "httpCode" => $httpCode];
                return ($data1);
                break;
        } 
    }
    
    public function getCusdetail(Request $request)
    {
        $inputs = $request->all();
        
        $method = 'GET';
        $url = "192.168.0.73:81/trialbalance/public/test/cusdetails?documentno=".$inputs['wrd'];
        $phpinpdata = false;
        $phpdata = $this->CallAPI($method,$url,$phpinpdata = false);
        $phpdecode=  json_decode($phpdata['result']);
        
        return response()->json($phpdecode);
    }
    
    public function getPrddetail(Request $request)
    {
        $t=time();
        
        $method = 'GET';
        $url = "192.168.0.73:81/trialbalance/public/test/prddetails?_t=".$t;
        $phpinpdata = false;
        $phpdata = $this->CallAPI($method,$url,$phpinpdata = false);
        $phpdecode=  json_decode($phpdata['result']);
        $inpdata = array();
        foreach($phpdecode as $prddetail)
        {
            $model1 = new $this->modelPrdName();
            
            $pdata = $model1->where('product_id',$prddetail->product_id)->first();
            if($pdata)
            {
                //print_r("already exist");
            }
            else
            {
                $inpdata['product_id']=$prddetail->product_id;
                $inpdata['code']=$prddetail->code;
                $inpdata['name']=$prddetail->prdname;
                $inpdata['name2']=$prddetail->prdname2;
                $inpdata['uom_id']=$prddetail->uom_id;
                $inpdata['uom']=$prddetail->uom;
                $inpdata['price']=$prddetail->price;
                $inpdata['prdcat']=$prddetail->prdcat;
                $inpdata['created_by_id']=session()->get('user_id');
                $inpdata['status'] = 1;

                $stored1 = $model1->addRecord($inpdata);
            }
        }
        
        return response()->json($phpdecode);
    }
    
    public function getProductdetail(Request $request)
    {
        
        $modelprd = new $this->modelPrdName();
        $mdprd = $modelprd->all();
        $tr = "";
        foreach($mdprd as $mdpr)
        {
            $tr=$tr."<tr><td>".$mdpr['id']."</td><td><input class='frm_prdradio' type='radio' name='productid' value='".$mdpr['id']."'></td><td class='frm_pname'>".$mdpr['name']."</td><td class='code'>".$mdpr['code']."</td><td class='frm_uom'>".$mdpr['uom']."</td><td class='frm_amount'>".$mdpr['price']."</td></tr>";

        }
        return response()->json($tr);
    }
    
    public function getTaxcalc(Request $request)
    {
        $inputs=$request->all();
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
    
    public function getDocseq(Request $request)
    {
        $inputs=$request->all();
        $seqmodel = new $this->modelDocseq();
        $isspares=$inputs['isspares'];
        $year=date('Y');
        $month=date('m');
        
        $seqdata = $seqmodel->where('is_spares',$isspares)
                            ->where('doctype',0)
                            ->where('year',$year)
                            ->where('month',$month)->first();
        if($seqdata)
        {
            $modelRegion = new $this->modelRegion();
            $regiondata = $modelRegion->get();
            $this->data['status'] = 1;
            $this->data['seqdata'] = $seqdata;
            $this->data['regiondata'] = $regiondata;
        }
        else 
        {
            $this->data['status'] = 0;
        }
        
        return response()->json($this->data);
    }
    
    public function getAttendDetails(Request $request)
    {
        $inputs=$request->all();
        $attendModel = new $this->modelAttend();
        $usertype = array();
        if($inputs['usertype']==0)
        {
            $usertype = array(0,1,2);
            
        }else
        {
            $usertype[] = $inputs['usertype'];
        }
        //print_r($usertype);die;
        $modelData = $attendModel->whereIn('user_type',$usertype)
                                 ->whereDate('loged_in','=',date('Y-m-d'))
                                 ->get();
        $modUser = new $this->modelUser();
        
        $userData = $modUser->whereIn('user_type',$usertype)
                            ->where('status',1)->get();
        
        $this->data['userdata'] = $userData;
        $this->data['attenddata'] = $modelData;
        $this->data['status'] = 1;
        
        return response()->json($this->data);
            
    }
    
    public function getAttendadd(Request $request)
    {
        
        $inputs=$request->all();
        $attendModel = new $this->modelAttend();
        
        $modUser = new $this->modelUser();
        $modelData = $modUser->find($inputs['id']);
        
        $inp['user_id']=$modelData->id;
        $inp['loged_in']=now();
        $inp['user_type']=$modelData->user_type;
        $inp['created_at']=now();
        $inp['login_type']=1;
        $inp['logged_by_id']= session()->get('user_id');
        $stored = $attendModel->addRecord($inp);

        if($stored && is_array($stored))
        {
            return redirect()->back()->withErrors($stored)->withInput();
        }
        
        
        
        $this->data['status'] = 1;
        
        return response()->json($this->data);
    }
}
