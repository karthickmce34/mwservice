<!DOCTYPE html>
    <!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - Megawin</title>
        
        
        <?php
            $base_material_path = "/material_admin_v-1.5-2/Template/jquery";
        ?>
        <!-- Vendor CSS -->
        <link href="{{asset($base_material_path)}}/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="{{asset($base_material_path)}}/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
            
        <!-- CSS -->
            <link rel="shortcut icon" href="{{asset("")}}favicon.ico" />
        <link href="{{asset($base_material_path)}}/css/app.min.1.css" rel="stylesheet">
        <link href="{{asset($base_material_path)}}/css/app.min.2.css" rel="stylesheet">
    </head>
    
    <body class="login-content">
        <!-- Login -->
        
        <div class="lc-block toggled" id="l-login">
            @if (session('status'))
                <div class="alert alert-success  alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    {{ session('error') }}
                </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ action('Auth\LoginController@postLogin') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="input-group m-b-20">
                    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control" placeholder="Username" name='user'>
                    </div>
                </div>

                <div class="input-group m-b-20">
                    <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
                    <div class="fg-line">
                        <input type="password" class="form-control" placeholder="Password" name='pass'>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name='isservice' value="1">
                        <i class="input-helper"></i>
                        Service Engineer
                    </label>
                </div>

                <button class="btn btn-login btn-success btn-float"><i class="zmdi zmdi-arrow-forward"></i></button>
            </form>
            
        </div>
        
        
        <!-- Javascript Libraries -->
        <script src="{{asset($base_material_path)}}/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="{{asset($base_material_path)}}/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        
        <script src="{{asset($base_material_path)}}/vendors/bower_components/Waves/dist/waves.min.js"></script>
        
        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->
        
        <script src="{{asset($base_material_path)}}/js/functions.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        
        <script>
            $(window).load(function()
            {
                if (navigator.geolocation) { 
                            
                    navigator.geolocation.getCurrentPosition(showLocation); 

                } else { 

                    alert('Geolocation is not supported by this browser.'); 

                }
                
                function showLocation(position) { 

                    var latitude = position.coords.latitude; 
                    var longitude = position.coords.longitude; 
                    
                    console.log(latitude);
                    console.log(longitude);
                    var _site_url = "{{url('/')}}/";
                    $.ajaxSetup({
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                     });
                     var dataconfig = {latitude:latitude,longitude:longitude}
                    var controller = 'login/';
                 $.ajax({
                     method: "GET",
                     url: _site_url + controller + "location",
                     data:dataconfig,
                     }).done(function (data, textStatus, jqXHR) {

                         console.log(" ajax success 2");
                     }).fail(function (jqXHR, textStatus, errorThrown) {
                         console.log(" ajax fail ");

                         //console.log(jqXHR, textStatus, errorThrown);
                     }).always(function (data_jqXHR, textStatus, jqXHR_errorThrown) {
                         console.log(" ajax always ");
                         //console.log(data_jqXHR, textStatus, jqXHR_errorThrown);
                     });
                }
                        
            })
        </script>
            
    </body>
</html>