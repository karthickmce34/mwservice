<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

use App\TokenStore\TokenCache;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use Illuminate\Http\Request as Request2;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    public $modelName       = 'App\Models\UserModel';
    public $modelengineer   = 'App\Models\ServiceEngineerModel';
    public $modelattendance = 'App\Models\AttendanceModel';

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function getLogin()
    {
        return view('auth.login');
    }
    
    public function postLogin()
    {
        $inputs = Request::all();
        $user=$inputs['user'];
        $pass=base64_encode($inputs['pass']);
        $token=$inputs['_token'];
        if(isset($inputs['isservice']))
        {
            $pass=$inputs['pass'];
            $model = new $this->modelengineer();
            $modelData = $model->where('name',$user)
                                ->where('mobileno',$pass)->first();
            if($modelData)
            {
                Session::put('name', $modelData->name);
                Session::put('user_id', $modelData->id);
                Session::put('token', $token );
                Session::put('user_type', 5 );
                //echo $String;
                return redirect()->to('home')->with('Success','Welcome!');
                //print_r($inputs);die;
            }
            else
            {
                //print_r($logindata);
                return redirect()->guest(url('login'))->with('error','Incorrect Username and Password!');
            }
        }
        else
        {
            $model = new $this->modelName();
            $modelData = $model->where('username',$user)
                                ->where('password',$pass)->first();

            if($modelData)
            {
                Session::put('name', $modelData->name);
                Session::put('user_id', $modelData->id);
                Session::put('token', $token );
                Session::put('user_type', $modelData->user_type );
                
                $modelattnd = new $this->modelattendance();
                
                $attndata = $modelattnd->where('user_id',$modelData->id)
                                        ->whereDate('loged_in','=',date('Y-m-d'))
                                        ->get();
                if(count($attndata)>0)
                {
                    
                }
                else
                {
                    $inp['user_id']=$modelData->id;
                    $inp['loged_in']=now();
                    $inp['user_type']=$modelData->user_type;
                    $inp['created_at']=now();
                    $inp['login_type']=0;
                    $inp['logged_by_id']= $modelData->id;
                    $stored = $modelattnd->addRecord($inp);
        
                    if($stored && is_array($stored))
                    {
                        return redirect()->back()->withErrors($stored)->withInput();
                    }
                }
                    
                //echo $String;
                return redirect()->to('home')->with('Success','Welcome!');
                // Initialize the OAuth client
                /*$oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
                  'clientId'                => config('azure.appId'),
                  'clientSecret'            => config('azure.appSecret'),
                  'redirectUri'             => config('azure.redirectUri'),
                  'urlAuthorize'            => config('azure.authority').config('azure.authorizeEndpoint'),
                  'urlAccessToken'          => config('azure.authority').config('azure.tokenEndpoint'),
                  'urlResourceOwnerDetails' => '',
                  'scopes'                  => config('azure.scopes')
                ]);

                $authUrl = $oauthClient->getAuthorizationUrl();

                // Save client state so we can validate in callback
                session(['oauthState' => $oauthClient->getState()]);

                // Redirect to AAD signin page
                return redirect()->away($authUrl);*/
                //print_r($oauthClient);die;
            }
            else
            {
                //print_r($logindata);
                return redirect()->guest(url('login'))->with('error','Incorrect Username and Password!');
            } 
        }
            
    }
    
    public function callback(Request2 $request)
    {
    // Validate state
    $expectedState = session('oauthState');
    $request->session()->forget('oauthState');
    $providedState = $request->query('state');

    if (!isset($expectedState)) {
      // If there is no expected state in the session,
      // do nothing and redirect to the home page.
      return redirect('/');
    }

    if (!isset($providedState) || $expectedState != $providedState) {
      return redirect('/')
        ->with('error', 'Invalid auth state')
        ->with('errorDetail', 'The provided auth state did not match the expected value');
    }

    // Authorization code should be in the "code" query param
    $authCode = $request->query('code');
    if (isset($authCode)) {
      // Initialize the OAuth client
      $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
        'clientId'                => config('azure.appId'),
        'clientSecret'            => config('azure.appSecret'),
        'redirectUri'             => config('azure.redirectUri'),
        'urlAuthorize'            => config('azure.authority').config('azure.authorizeEndpoint'),
        'urlAccessToken'          => config('azure.authority').config('azure.tokenEndpoint'),
        'urlResourceOwnerDetails' => '',
        'scopes'                  => config('azure.scopes')
      ]);

      try {
		  // Make the token request
		  $accessToken = $oauthClient->getAccessToken('authorization_code', [
			'code' => $authCode
		  ]);

		  $graph = new Graph();
		  $graph->setAccessToken($accessToken->getToken());

		  $user = $graph->createRequest('GET', '/me?$select=displayName,mail,mailboxSettings,userPrincipalName')
			->setReturnType(Model\User::class)
			->execute();

		  $tokenCache = new TokenCache();
		  $tokenCache->storeTokens($accessToken, $user);
		  
		  /*$graph->createRequest("POST", "/me/drive/root/children/")
					->upload('C:/Users/Babu/Downloads/Proformainvoice (4).pdf');*/
		 //me/messages			
		 
		  return redirect('home');
		}
      catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        return redirect('/')
          ->with('error', 'Error requesting access token')
          ->with('errorDetail', $e->getMessage());
      }
    }

    return redirect('/')
      ->with('error', $request->query('error'))
      ->with('errorDetail', $request->query('error_description'));
  }

    
    public function logout() {
        session()->flush();
        Auth::logout();
        return response()->json();
        //return Redirect('login');
    }
    
    public function getLocation(Request2 $request)
    {
        $inputs = $request->all();
        if(!empty($inputs['latitude']) && !empty($inputs['longitude'])){ 

            //Send request and receive json data by latitude and longitude 
            
            $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($inputs['latitude']).','.trim($inputs['longitude']).'&sensor=false'; 

            $json = @file_get_contents($url); 

            $data = json_decode($json); 

            $status = $data->status; 

            if($status=="OK"){ 

                //Get address from json data 

                $location = $data->results[0]->formatted_address; 

            }else{ 

                $location =  ''; 

            } 

            //Print address 

            print_r($data); 
        }
    }
}
