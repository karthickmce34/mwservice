<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use App\Libraries\Helpers\SmsHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\TokenStore\TokenCache;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;


use App\Models\EmailHeaderModel;
use App\Models\TicketModel;


class EmailController extends Controller
{
    public $modelName       = 'App\Models\EmailHeaderModel';
    public $modelRegName    = 'App\Models\ComplaintRegisterModel';
    public $modelSSRegName  = 'App\Models\ServiceSpareRegisterModel';
    public $modelPrdName    = 'App\Models\ProductModel';
    public $modelSSPrdName  = 'App\Models\ServiceSpareProductModel';
    public $modelTax        = 'App\Models\TaxModel';
    public $modelSSPrdTax   = 'App\Models\ServiceProductTaxModel';
    public $modelDocseq     = 'App\Models\DocseqModel';
    public $modelAttend     = 'App\Models\AttendanceModel';
    public $modelUser       = 'App\Models\UserModel';
    public $modelTicket     = 'App\Models\TicketModel';
    public $baseRedirect    = 'email.index';
    public $baseName        = 'email';
    public $basePath        = 'email/';
    public $detailName      = 'EmailController@getIndex';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function index()
    {
        
        $model = new $this->modelName();
	$usrtype=session()->get('user_type');
        
	if($usrtype == 1)	
	{
		$modelData = $model->where('isspares',$usrtype)->orderBy('recieved_datetime','desc')->get();
	}
	else
	{
		if($usrtype == 2)
		{
                        
			$modelData = $model->where('isspares',$usrtype)->orderBy('recieved_datetime','desc')->get();
		}
		else
		{
			$modelData = $model->orderBy('recieved_datetime','desc')->get();
		}
	}
        
        //$modelData = $model->get();
        
        $data['data'] = $modelData;
        $data['baseName'] = $this->baseName;
        $data['basePath'] = $this->basePath;
        return view($this->basePath . $this->baseName, $data);
    }
    
    public function getIndex()
    {
        
        return $this->index();
        
    }

    public function getShowEmail($id)
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
    
    public function postMessage()
    {
        $usrtype=session()->get('user_type');
        
	if($usrtype == 1)	
	{
		$clientSecret = config('constant.sparesclientSecret');
        	$clientId = config('constant.sparesclientId');
        	$tenantId = config('constant.sparestenantID');
		$username = config('constant.spareid');
		$password = config('constant.sparepassword');
	}
	else{
		if($usrtype == 2)
		{
			$clientSecret = config('constant.serviceclientSecret');
        		$clientId = config('constant.serviceclientId');
        		$tenantId = config('constant.servicetenantID');
			$username = config('constant.serviceid');
			$password = config('constant.servicepassword');
		}
		else
		{
			$clientSecret = '..MF-oj_9BG283kC9R.4w29PG5z~AIjBo5';
        		$clientId = '5d0702cb-e235-4155-91a2-55a83529f552';
        		$tenantId = '75b5d666-56f2-4955-bbff-75e521532402';
			$username = config('constant.adminid');
			$password = config('constant.adminpassword');
		}
	}
        $guzzle = new \GuzzleHttp\Client();
        $url = 'https://login.microsoftonline.com/'. $tenantId .'/oauth2/v2.0/token';
        $token = json_decode($guzzle->post($url, [
            'form_params' => [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'username' => $username,
                'password' => $password,
                'scope' => 'user.read openid mailboxsettings.read mail.read',
                'grant_type' => 'password',
            ],
        ])->getBody()->getContents());
		
        $accessToken = $token->access_token;
	 
	if($accessToken !="")
	{
		$graph = new Graph();
		$graph->setBaseUrl("https://graph.microsoft.com/")
                        ->setAccessToken($accessToken);

		$messages = $graph->createRequest("GET", "/me/mailFolders/inbox/messages?\$top=10")
						   ->setReturnType(Model\Message::class)
						   ->execute();
                
		foreach($messages as $message)
		{
                        $infconf = $message->getInferenceClassification()->value();
                        //echo $message->getSender()->getEmailAddress()->getName();
                        $modelName = new $this->modelName();
                        if($infconf == 'focused')
                        {
                            
                            if($usrtype == 0)
                            {
                                $unreadData = $modelName->where('isread',0)->orderBy('recieved_datetime','desc')->get();
                            }
                            else
                            {
                                $id=$message->getId();
                                $name=$message->getSender()->getEmailAddress()->getName();
                                $email=$message->getSender()->getEmailAddress()->getAddress();
                                $subject=$message->getSubject();
                                $conversationid=$message->getConversationId();
                                $content=$message->getBody()->getContent();
                                $isread=0;
                                $isread=$message->getIsRead();
                                $daterc = $message->getReceivedDateTime();
                                $recievedate = date('Y-m-d H:i:s',strtotime('+5 hour +30 minutes',strtotime($daterc->format('Y-m-d H:i:s'))));
                                if($isread == 1)
                                {
                                    $read=$isread;
                                }
                                else
                                {
                                    $read=0;
                                }
                                
                                $modelData = $modelName->where('emailid',$id)->first();

                                if($modelData)
                                {
                                    $modelData->isread=$read;
                                    $modelData->save();
                                }
                                else
                                {
                                    $usrtype = session()->get('user_type');
                                    $email_id=$modelName->id;
                                    $modelConvData = $modelName->where('conversation_id',$conversationid)
                                                                ->first();
                                    //print_r($usrtype);die;
                                    if($modelConvData)
                                    {
                                        $messageticket='';
                                    }
                                    else
                                    {
                                        if($usrtype == 1 || $usrtype == 2)
                                        {
                                            if($usrtype == 2)
                                                {
                                                    $isspares=0;
                                                }
                                                else
                                                {
                                                    $isspares=1;
                                                }
                                                $seqmodel = new $this->modelDocseq();
                                                $seqdata = $seqmodel->where('is_spares',$isspares)
                                                                    ->where('doctype',2)->first();
                                                $modelTicket = new $this->modelTicket();
                                                $inp['doc_no']=$seqdata->prefix.$seqdata->seqno;
                                                $inp['type']=session()->get('user_type');
                                                $inp['mode']=1;
                                                $inp['email_id']=null;
                                                $inp['email_address']=$email;
                                                $inp['customer_name']=$name;
                                                $inp['contact_person']=$name;
                                                $inp['mobileno']="";
                                                $inp['complaint_nature']=$subject;
                                                $inp['jobid']="";
                                                $inp['created_by_id'] = session()->get('user_id');
                                                $inp['status'] = 1;
                                                $storedticket = $modelTicket->addRecord($inp);
                                                
                                                if($storedticket && is_array($storedticket))
                                                {
                                                    $this->data['status'] = 0;
                                                    //return response()->json($this->data);
                                                }
                                                else
                                                {
                                                    $seqdata->seqno = $seqdata->seqno+1;
                                                    $seqdata->save();
                                                }
                                        }
                                    }
                                    
                                    $inpData['emailid']=$id;
                                    $inpData['emailaddress']=$email;
                                    $inpData['name']=$name;
                                    $inpData['subject']=$subject;
                                    //body saving in file to avoid DB spaces
                                    /*$UPLOAD_EMAILPATH_URL   = Config::get('constant.UPLOAD_PATH_EMAIL_URL'); 
                                    $UPLOAD_EMAILPATH  = public_path($UPLOAD_EMAILPATH_URL);
                                    $myFile = $UPLOAD_EMAILPATH."\\".$id.".txt";
                                    //print_r($myFile);die;
                                    $fh = fopen($myFile, 'w') or die("can't open file");
                                    fwrite($fh, $content);
                                    fclose($fh);
                                    $inpData['body']=$id.".txt";*/
                                    $myFile = $id.".txt";
                                    Storage::disk('email')->put($myFile, $content);
                                    
                                    
                                    $inpData['body']=$id.".txt";
                                    
                                    $inpData['conversation_id']=$conversationid;
                                    $inpData['isread']=$read;
                                    $inpData['isspares']=session()->get('user_type');
                                    $inpData['recieved_datetime']=$recievedate;
                                    $stored = $modelName->addRecord($inpData);
                                    $modelTicket->email_id= $modelName->id;
                                    $modelTicket->save();
                                }
                                
                                
                                $unreadData = $modelName->where('isread',0)->where('isspares',$usrtype)->orderBy('recieved_datetime','desc')->get();
                            }
 
                        }
		}
                $modelName = new $this->modelName();
		if($usrtype == 0)
                {
                   $unreadData = $modelName->where('isread',0)->orderBy('recieved_datetime','desc')->get();
                }
                else
                {
			$unreadData = $modelName->where('isread',0)->where('isspares',$usrtype)->orderBy('recieved_datetime','desc')->get();
		}
                $this->data['status'] = 1;
                $this->data['unread'] = $unreadData;
                return response()->json($this->data);
	}
	else
	{
		/*$oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
		  'clientId'                => config('azure.appId'),
		  'clientSecret'            => config('azure.appSecret'),
		  'redirectUri'             => config('azure.redirectUri'),
		  'urlAuthorize'            => config('azure.authority').config('azure.authorizeEndpoint'),
		  'urlAccessToken'          => config('azure.authority').config('azure.tokenEndpoint'),
		  'urlResourceOwnerDetails' => '',
		  'scopes'                  => config('azure.scopes'),
		  'grant_type' => 'client_credentials',
		]);
		$accessToken = $oauthClient->getAccessToken('password',[
			'username' => 'info@megawin.co.in',
			'password' => 'W3lc0m3@!nf0'
		]);*/
		$tokenCache = new TokenCache();
		$accessToken =$tokenCache->getAccessToken();
		dd($accessToken);
	}
  }

    public function postSendmail()
    {
        $clientSecret = '50mVB_wWRrLBKBBGA0R3_a~~5225yqzxn1';
        $clientId = 'c818a833-bb9c-4edf-9ca4-3cb5e00aee86';
        $tenantId = '75b5d666-56f2-4955-bbff-75e521532402';
        
        /*$oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
		  'clientId'                => 'c818a833-bb9c-4edf-9ca4-3cb5e00aee86',
		  'clientSecret'            => '50mVB_wWRrLBKBBGA0R3_a~~5225yqzxn1',
		  'redirectUri'             => 'http://localhost/php72/service/public',
		  'urlAuthorize'            => 'https://login.microsoftonline.com/organizations/oauth2/v2.0/authorize',
		  'urlAccessToken'          => 'https://login.microsoftonline.com/organizations/oauth2/v2.0/token',
		  'urlResourceOwnerDetails' => '',
		  'scopes'                  => 'mail.read',
		  'grant_type' => 'client_credentials',
		]);
		$accessToken = $oauthClient->getAccessToken('password',[
			'username' => 'admin@megawin.co.in',
			'password' => 'W3lc0m3@adm!n'
		]);*/
        $guzzle = new \GuzzleHttp\Client();
        $url = 'https://login.microsoftonline.com/'. $tenantId .'/oauth2/v2.0/token';
        $token = json_decode($guzzle->post($url, [
            'form_params' => [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'username' => 'admin@megawin.co.in',
                'password' => 'W3lc0m3@adm!n',
                'scope' => 'mail.read',
                'grant_type' => 'password',
            ],
        ])->getBody()->getContents());
		
        $accessToken = $token->access_token;
	print_r($accessToken);die;
	if($accessToken !="")
	{
		$graph = new Graph();
		$graph->setBaseUrl("https://graph.microsoft.com/")
                        ->setAccessToken($accessToken);

		$mailBody = array( "Message" => array(
                    "subject" => 'hai karthick',
                    "body" => array(
                        "contentType" => "text",
                        "content" => "test"
                    ),
                    
                    "ToRecipients" => array(
                        array(
                            "emailAddress" => array(
                                "address" => "karthickmce34@gmail.com"

                            )
                        )
                    ),
                ),
                "SaveToSentItems" => array("false")

            );

            $response = $graph->createRequest("POST", "/me/sendMail")
                ->attachBody($mailBody)
                ->execute();
        }
        
        
    }
    
    public function postEmailstatus(Request $request)
    {
        $inputs = $request->all();
        $model = new $this->modelName();
        $modelData = $model->find($inputs['id']);
        if($modelData)
        {
          $modelData->status =  $inputs['status'];
          $modelData->save();
          $this->data['status'] = 1;
        }
        else
        {
            $this->data['status'] = 0;
        }
        return response()->json($this->data);
    }
    
    public function postEmaildata()
    {
        $inputs = request()->all();
        $this->data['status'] = 0;
        $usrtype=session()->get('user_type');
        $model = new $this->modelRegName();
        $modelData = $model->where("emailid","like",$inputs['email_id'])->first();
        if($modelData)
        $this->data['status'] = 1;
        $this->data['modeldata'] = $modelData;
        return response()->json($this->data);
    }
    
    public function postSpareappdata(Request $request)
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
        $inputs['eheader_id']=$inputs['eh_id'];
        $model = new $this->modelRegName();
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
                
                $modelRegister = new $this->modelSSRegName();

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
                            $this->data['message'] = $message;
                            $this->data['cusid'] = $modelRegister->id;
                            $modelName = new $this->modelName();
                            $modelEData = $modelName->find($inputs['eh_id']);
                            $modelEData->status=1;
                            $modelEData->save();
                            $mobile = $inputs['mobileno'];
                            $usr = $inputs['mobileno'];
                            $message = "Dear Customer, Thanks for contacting Megawin. Your Service request is registered in our portal(Ref Id: " . $inputs['seqno'] . ")";
                            $apirequest = new SmsHelper();
                            //$smspush = $apirequest->smsToCustomer($mobile, $message);
                            return response()->json($this->data);
                        }
                    }
                }
        }
              
    }
 
    public function postAppdata(Request $request)
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
        $inputs['eheader_id']=$inputs['eh_id'];
        $model = new $this->modelRegName();
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
            
            
            $modelName = new $this->modelName();
            $modelEData = $modelName->find($inputs['eh_id']);
            $modelEData->status=1;
            $modelEData->save();
                            
            $mobile = $inputs['mobileno'];
            $usr = $inputs['mobileno'];
            $message = "Dear Customer, Thanks for contacting Megawin. Your Service request is registered in our portal(Ref Id: " . $inputs['seqno'] . ")";
            $apirequest = new SmsHelper();
            //$smspush = $apirequest->smsToCustomer($mobile, $message);
            return response()->json($this->data);
        }
              
    }
}
