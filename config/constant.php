<?php

return [
	// file upload public path
    'UPLOAD_PATH_URL'                               => "static/uploads/",
    'UPLOAD_PATH_USERS_URL'                         => "static/uploads/users/",
    'UPLOAD_PATH_WORKOUTS_URL'                      => "static/uploads/workouts/",  
    'UPLOAD_PATH_SUMMERNOTE_QUESTIONAIRES_URL'      => "static/uploads/summernotes/questionaires/", 
    'UPLOAD_PATH_SUMMERNOTE_TEMPLATES_URL'          => "static/uploads/summernotes/templates/",  
    'UPLOAD_PATH_SUMMERNOTE_MESSAGETPL_URL'         => "static/uploads/summernotes/message/",    
    'UPLOAD_PATH_REPORT_URL'                        => "reports/template",
    'UPLOAD_PATH_RESULT_URL'                        => "reports/result",
    'UPLOAD_PATH_EMAIL_URL'                        	=> "static/emails/body",
	'EMAIL_ATTACHMENT_URL'                        	=> "static/emails/attachment",
    
    'adminid'=>"info@megawin.co.in",
    'adminpassword'=>"W3lc0m3@!nf0",
    'spareid'=>"spares@megawin.co.in",
    'sparepassword'=>"W3lc0m3@spar3s",
    'serviceid'=>"service@megawin.co.in",
    'servicepassword'=>"W3lc0m3@s3rvic3",
    'sparesclientSecret'=>"l3NPG_MqjYg42~S8QPpB-eDL~VpC9eilk.",
    'sparesclientId'=>"1ea53b98-3f48-464c-af4d-4703d7239c49",
    'sparestenantID'=>"75b5d666-56f2-4955-bbff-75e521532402",
    'serviceclientSecret'=>"9-oAIw.XS2F9_0.96PyKqBn_Wa54oNdJO5",
    'serviceclientId'=>"d76c1f65-65cc-4e9a-a3d3-e795beb61d89",
    'servicetenantID'=>"75b5d666-56f2-4955-bbff-75e521532402",
    

    'DATE_FORMAT' => "d/m/Y",
    'TIME_FORMAT' => "h:i A",    
    'DATE_SINCE' => "M Y",    
    'DATE_START' => "d/M",  
    'DATE_STARTIME' => "d M h:i A",
    'DATE_TIME_FORMAT' => "d/m/Y h:i A",
    
    'MODEL_FIELDS' => [
        
        'App\User'                              => ["users.email","users.fullname"],
        
    ],
    
    
    
    'DEVICE_TYPE_ID'=>[
        'browser'=>0,
        'android'=>1,
        'ios'=>2,
        'windows'=>3,
        'blackberry'=>4,
        'mac'=>5,
        'tizen'=>6,
        'unknown'=>99
    ],
    
    'API_REQUEST_DATA'=>[
        
        'sms-url'=>"http://smshorizon.co.in/api/sendsms.php",
        'sms-apiKey'=>"m7DxLCcqdbBX47bXQkOk",
        'sms-user'=>"Megawin",
        'sms-senderid'=>"MEGAWN",  
        'sms-cType'=>"txt",
        'sms-tid'=>"1207162788323120000",
        
    ],
    
    'OFFERVALIDITY'=>[
        '0'=>'30 Days',
        '1'=>'60 Days',
        '2'=>'90 Days',
        '3'=>'120 Days',
        '4'=>'150 Days',
    ],
    
    'FREIGHT'=>[
        '0'=>'Freight Prepaid as per offer',
        '1'=>'To Pay basis',
    ],
    
    'DELIVERYPERIOD'=>[
        '1'=>'1 WEEK',
        '2'=>'2 WEEK',
        '3'=>'3 WEEK',
        '4'=>'4 WEEK',
        '5'=>'5 WEEK',
        '6'=>'6 WEEK',
        '7'=>'7 WEEK',
        '8'=>'8 WEEK',
    ],
    
    'PAYMENTTERM'=>[
        '0'=>'100% advance payment (with GST) against proforma invoice before dispatch',
        '1'=>'50% Advance with PO and Balance (with GST) against  proforma before dispatch',
        '2'=>'100% advance payment (with GST) along with PO',
        '3'=>'Others',
    ],
    
    'OPENBRAVOIP'     => "http://192.168.0.211:8080/Megawin/",
    
    
];