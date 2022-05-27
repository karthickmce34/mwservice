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
use App\Models\TicketingModel;


class TicketController extends Controller
{
    public $modelName       = 'App\Models\TicketModel';
    public $modelRegName    = 'App\Models\ComplaintRegisterModel';
    public $modelSSRegName  = 'App\Models\ServiceSpareRegisterModel';
    public $modelPrdName    = 'App\Models\ProductModel';
    public $modelSSPrdName  = 'App\Models\ServiceSpareProductModel';
    public $modelTax        = 'App\Models\TaxModel';
    public $modelSSPrdTax   = 'App\Models\ServiceProductTaxModel';
    public $modelDocseq     = 'App\Models\DocseqModel';
    public $modelAttend     = 'App\Models\AttendanceModel';
    public $modelUser       = 'App\Models\UserModel';
    public $baseRedirect    = 'ticket.index';
    public $baseName        = 'ticket';
    public $basePath        = 'ticket/';
    public $detailName      = 'TicketController@getIndex';
    
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
		$modelData = $model->where('type',$usrtype)->get();
	}
	else
	{
		if($usrtype == 2)
		{
                    $modelData = $model->where('type',$usrtype)->get();
		}
		else
		{
                    if($usrtype == 4)
                    {
                        $modelData = $model->where('mode',0)->get();
                    }
                    else
                    {
                        $modelData = $model->all();
                    }
                        
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
        $inputs['ticket_id']=$inputs['ticket_id'];
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
            $modelEData = $modelName->find($inputs['ticket_id']);
            $modelEData->ticket_status=1;
            $modelEData->save();
                            
            $mobile = $inputs['mobileno'];
            $usr = $inputs['mobileno'];
            $message = "Dear Customer, Thanks for contacting Megawin. Your Service request is registered in our portal(Ref Id: " . $inputs['seqno'] . ")";
            $apirequest = new SmsHelper();
            //$smspush = $apirequest->smsToCustomer($mobile, $message);
            return response()->json($this->data);
        }
              
    }
    
    public function postTicketstatus(Request $request)
    {
        $inputs = $request->all();
        $model = new $this->modelName();
        $modelData = $model->find($inputs['id']);
        if($modelData)
        {
          $modelData->ticket_status = 3;
          $modelData->close_reason =  $inputs['status'];
          $modelData->save();
          $this->data['status'] = 1;
        }
        else
        {
            $this->data['status'] = 0;
        }
        return response()->json($this->data);
    }
    
}
