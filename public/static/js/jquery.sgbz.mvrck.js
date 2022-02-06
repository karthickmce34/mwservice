;(function(window) {
    var
      baseURL = '',  
      // Is Modernizr defined on the global scope
      Modernizr = typeof Modernizr !== "undefined" ? Modernizr : false,
      // whether or not is a touch device
      isTouchDevice = Modernizr ? Modernizr.touch : !!('ontouchstart' in window || 'onmsgesturechange' in window),
      // Are we expecting a touch or a click?
      buttonPressedEvent = (isTouchDevice) ? 'touchstart' : 'click',
      Sgbz = function() {
          this.init();
      };
    var color_cls = [
        //'bgm-red',
        'bgm-pink',
        //'bgm-purple',
        //'bgm-deeppurple',
        //'bgm-indigo',
        //'bgm-blue',
        'bgm-lightblue',
        'bgm-cyan',
        'bgm-teal',
        //'bgm-green',
        'bgm-lightgreen',
        'bgm-lime',
        //'bgm-yellow',
        'bgm-amber',
        'bgm-orange',
        //'bgm-deeporange',
        'bgm-brown', 
        'bgm-gray',
        'bgm-bluegray', 
        //'bgm-black'
        //, 'bgm-white'                
    ];
    var color_course_cls = color_cls.slice(0, 10);
    var color_activity_cls = color_cls.slice(0, 10);
    var color_appointment_cls = color_cls.slice(0, 10);
    
    // Initialization method
    Sgbz.prototype.init = function() {
        this.color_cls = color_cls;
        this.color_course_cls = color_course_cls;
        this.color_activity_cls = color_activity_cls;
        this.color_appointment_cls = color_appointment_cls;
        this.baseURL = baseURL;
        this.isTouchDevice = isTouchDevice;
        this.buttonPressedEvent = buttonPressedEvent;
        
    };

    Sgbz.prototype.getViewportHeight = function() {

        var docElement = document.documentElement,
                client = docElement.clientHeight,
                inner = window.innerHeight;

        if (client < inner)
            return inner;
        else
            return client;
    };

    Sgbz.prototype.getViewportWidth = function() {

        var docElement = document.documentElement,
                client = docElement.clientWidth,
                inner = window.innerWidth;

        if (client < inner)
            return inner;
        else
            return client;
    };

    // Creates a Metis object.
    window.Sgbz = new Sgbz();
})(this);

;(function($, Sgbz) {
        
    //var $button = $('.inner a.btn');
    // formatTimeStamp($dateTimestamp,$dateFormat=null)
    // _dateformat
    //Object {DATE_FORMAT: "d/m/Y", TIME_FORMAT: "h:i A", DATE_SINCE: "M Y", DATE_START: "d/M", 
    //DATE_STARTIME: "d M h:i A"}
    Sgbz.formatTimeStamp = function(dateTimestamp, dateFormat) {
        console.log('-------Sgbz.formatTimeStamp---------------------------------');
        console.log(dateTimestamp,dateFormat);
        if(dateTimestamp=="0000-00-00" || dateTimestamp=="0000-00-00 00-00-00")
            return "";
        if(dateFormat == undefined || dateFormat == null)
            dateFormat  = _dateformat.DATE_FORMAT + ' ' + _dateformat.TIME_FORMAT;         
        //return moment(dateTimestamp).format(dateFormat);
        if(moment(dateTimestamp).isValid())
            return moment(dateTimestamp).format(dateFormat);
        return "";
    };
    // currentTimeStamp($dateFormat=null) 
    Sgbz.currentTimeStamp = function(dateFormat) {
        if(dateFormat == undefined || dateFormat == null)
            dateFormat  = _dateformat.DATE_FORMAT + ' ' + _dateformat.TIME_FORMAT;         
        return moment().format(dateFormat);
    };  
    // formatDate($dateTimestamp,$dateFormat=null) 
    Sgbz.formatDate = function(dateTimestamp, dateFormat) {
        console.log('-------Sgbz.formatDate---------------------------------');
        console.log(dateTimestamp,dateFormat);
        if(dateTimestamp=="0000-00-00")
            return "";
        if(dateFormat == undefined || dateFormat == null)
            dateFormat  = _dateformat.DATE_FORMAT;  
        if(moment(dateTimestamp).isValid())
            return moment(dateTimestamp).format(dateFormat);
        return "";  
    };   
    // currentDate($dateFormat=null)
    Sgbz.currentDate = function(dateFormat) {
        if(dateFormat == undefined || dateFormat == null)
            dateFormat  = _dateformat.DATE_FORMAT;        
        return moment().format(dateFormat);
    }; 
    // formatTime($dateTimestamp,$dateFormat=null)
    Sgbz.formatTime = function(dateTimestamp, dateFormat) {
        console.log('-------Sgbz.formatTime---------------------------------');
        console.log(dateTimestamp,dateFormat);
        if(dateFormat == undefined || dateFormat == null)
            dateFormat  = _dateformat.TIME_FORMAT;      
        if(dateTimestamp=="00-00-00" || dateTimestamp=="0000-00-00 00-00-00")
        {
            //return "";
        }
        else
        {
            var strtmp = dateTimestamp.split(" ");
            if(strtmp.length==2)
            {
                if(moment(dateTimestamp).isValid())
                    return moment(dateTimestamp).format(dateFormat);
            }
            else
            {
                // moment().format("01:30:00","HH:mm A");
                //if(moment(dateTimestamp).isValid())
                strtmp = dateTimestamp.split(":");
                if(strtmp.length==3)
                {
                    var datestr = moment().format("YYYY-MM-DD");
                    return moment(datestr + " " + dateTimestamp).format(dateFormat);
                }                
            }
        }
         
        //return moment(dateTimestamp).format(dateFormat);
        //if(moment(dateTimestamp).isValid())
        //    return moment(dateTimestamp).format(dateFormat);
        
        return "";
    };   
    // currentTime($dateFormat=null)
    Sgbz.currentTime = function(dateFormat) {
        if(dateFormat == undefined || dateFormat == null)
            dateFormat  = _dateformat.TIME_FORMAT;       
        return moment().format(dateFormat);
    };
    Sgbz.currentHHMMSS = function(timestr, dateFormat) {
        if(dateFormat == undefined || dateFormat == null)
            dateFormat  = _dateformat.TIME_FORMAT ;     
        var timestrs = timestr.split(':');
        return moment().startOf('day').add(timestrs[0],'h').add(timestrs[1],'m').add(timestrs[2],'s').format(dateFormat);
    };   
    Sgbz.convertTime = function(dateTimestamp) {
        if(dateTimestamp=="00-00-00" || dateTimestamp=="0000-00-00 00-00-00")
        {
            //return "";
        }
        else
        {
            var strtmp = dateTimestamp.split(" ");
            if(strtmp.length==2)
            {
                if(moment(dateTimestamp).isValid())
                {
                    //return moment(dateTimestamp).format(dateFormat);
                    //var datestr = moment().format("YYYY-MM-DD");
                    var hour = moment(dateTimestamp).hour();
                    var minute = moment(dateTimestamp).minute();
                    var second = moment(dateTimestamp).second();
                    //return moment(datestr + " " + dateTimestamp).format(dateFormat);
                    var tst = "";
                    if(hour > 0)
                        tst += hour + " hour ";
                    if(minute > 0)
                        tst += minute + " min ";
                    if(second > 0)
                        tst += second + " sec";
                    return $.trim(tst);
                }
            }
            else
            {
                // moment().format("01:30:00","HH:mm A");
                //if(moment(dateTimestamp).isValid())
                strtmp = dateTimestamp.split(":");
                if(strtmp.length==3)
                {
                    var datestr = moment().format("YYYY-MM-DD");
                    var hour = moment(datestr + " " + dateTimestamp).hour();
                    var minute = moment(datestr + " " + dateTimestamp).minute();
                    var second = moment(datestr + " " + dateTimestamp).second();
                    //return moment(datestr + " " + dateTimestamp).format(dateFormat);
                    var tst = "";
                    if(hour > 0)
                        tst += hour + " hour ";
                    if(minute > 0)
                        tst += minute + " min ";
                    if(second > 0)
                        tst += second + " sec";
                    return $.trim(tst);
                }                
            }
        }
         
        //return moment(dateTimestamp).format(dateFormat);
        //if(moment(dateTimestamp).isValid())
        //    return moment(dateTimestamp).format(dateFormat);
        
        return "";
    };
    
    Sgbz.handleClock = function()
    {
        var _timezone = 'IST';
	    var SetTimer = function ()
	    {
	    	_timestamp += 1000;
	        var date = new Date(_timestamp);
	        //var timeStr = date.toUTCString().replace('GMT', _timezone);
	        var timeStr = date.toDateString();
	        timeStr += ", " + date.toLocaleTimeString();
	        if (timeStr.length == 28) 
            {
				//timeStr = timeStr.substring(0, 5) + '0' + timeStr.substring(5);
	        }
	        $(".clock-timer").html(timeStr);
	    };
	    if ($(".clock-timer").length) 
        {
	    	setInterval(function(){SetTimer()}, 1000);
	    }
    };
    
    return Sgbz;
})(jQuery, Sgbz || {});

;(function($, Sgbz) {
        
    //var $button = $('.inner a.btn');
    //window.localStorage.clear();
    // localStorage.setItem('todos', todos);
    // localStorage.getItem('todos')
    // localStorage.removeItem("lastname");    
    
    Sgbz.storeSetItem = function(key,data) {
        if (typeof(Storage) !== "undefined") {
            // Code for localStorage/sessionStorage.
            localStorage.setItem(key, data);
            return true;
        } else {
            // Sorry! No Web Storage support..
            return false;
        }        
    };
    
    Sgbz.storeGetItem = function(key) {
        if (typeof(Storage) !== "undefined") {
            // Code for localStorage/sessionStorage.
            return localStorage.getItem(key);
        } else {
            // Sorry! No Web Storage support..
            return false;
        }
    };
    Sgbz.storeRemoveItem = function(key) {
        if (typeof(Storage) !== "undefined") {
            // Code for localStorage/sessionStorage.
            localStorage.removeItem(key);
            return true;
        } else {
            // Sorry! No Web Storage support..
            return false;
        }
    };
    Sgbz.storeClear = function() {
        if (typeof(Storage) !== "undefined") {
            // Code for localStorage/sessionStorage.
            localStorage.clear();
            return true;
        } else {
            // Sorry! No Web Storage support..
            return false;
        }
    };
    
    Sgbz.sgbzButton = function() {
        
    };
    return Sgbz;
})(jQuery, Sgbz || {});

;(function($, Sgbz) {    
    
    Sgbz.dashboard = function() {
        
    };
    
    Sgbz.formatDateValue = function(dateVal) {
        // GET CURRENT DATE
        var date = new Date(dateVal);

        // GET YYYY, MM AND DD FROM THE DATE OBJECT
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth()+1).toString();
        var dd  = date.getDate().toString();

        // CONVERT mm AND dd INTO chars
        var mmChars = mm.split('');
        var ddChars = dd.split('');

        // CONCAT THE STRINGS IN YYYY-MM-DD FORMAT
        var datestring = yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);        
        return datestring;        
    };
    
    return Sgbz;
})(jQuery, Sgbz || {});

/**********Site Root Start*******************************************************/
;(function($, Sgbz) {   
    Sgbz.modeAdd = 0;
    //Sgbz.modeAdd = 1; // for customer enquery
    //Sgbz.modeAdd = 2; // for new membership
    //Sgbz.modeAdd = 3; // 
    // Succes Mesages
    Sgbz.successAddMessages = {
        1:"New Customer Enquery added successfully!",
        2:"New Membership added successfully!",
        3:"New Membership added successfully!",
    };
    Sgbz.ajaxFormSubmitSuccess = function(responseText , statusText, xhr, formObject) 
    { 
        var _this = this;
        console.log(responseText);
        console.log(statusText);
        //alert('Thanks for your comment!'); 
        $('.error-list').html('');
        if(responseText.status=="1")
        {
            //alert('Data Added successfully!'); 
            if( _this.modeAdd > 0 && _this.successAddMessages.hasOwnProperty(_this.modeAdd))
            {
                _this.notify(_this.successAddMessages[_this.modeAdd], "success");
            }
            else
            {
                _this.notify("Data added successfully!", "success");
            }
            // close the the model box
            $('#blankModal').modal('hide');
        }
        else
        {
            // error-list
            if(typeof responseText.message == "string")
            {
                $('.error-list').append('<span class="label label-danger">'+responseText.message+'</span>');
                
                _this.notify(responseText.message, "error");
            }
            else
            {       
                var idx,idx2;                                                  
                for(idx in responseText.message)
                {
                    for(idx2 in responseText.message[idx])
                    {
                        $('.error-list').append('<span class="label label-danger">'+idx+' : '+idx2+' : '+responseText.message[idx][idx2]+'</span><br>');
                        _this.notify(idx+' :- '+idx2+' : '+responseText.message[idx][idx2], "error");
                    }    
                }                                
            }
        }        
    };    
    // prepare Options Object 
    Sgbz.getAjaxFormOptions = function() { 
        var _this = this;
        var ajaxFormOptions = { 
            //target:     '#divToUpdate', 
            //url:        'comment.php', 
            dataType : "json",
            beforeSubmit: function(arr, $form, options) { 
                // The array of form data takes the following form: 
                // [ { name: 'username', value: 'jresig' }, { name: 'password', value: 'secret' } ] 

                // return false to cancel submit
                //var flag = false;    // false   true          
                var flag = true;    // false   true          
                // check here validation status
                //alert('beforeSubmit');
                return flag;
                
            },
            success:    function(responseText , statusText, xhr, formObject) { 
                _this.ajaxFormSubmitSuccess(responseText , statusText, xhr, formObject);
            } 
        };         
        return ajaxFormOptions;
    }; 
        
    Sgbz.fillTableCourseActivityLines = function(containerID,data)
    {
        var _this = this;
        if(data.length > 0)
        {
            // "paging": false
            var ct = $('.membership-box #'+containerID).DataTable({"paging": false,"searching": false,"pageLength": 50,"destroy": true,});
            
            ct.clear().draw();            
            
            var idx,cellvalue1,cellvalue2,cellvalue3,cellvalue4;
            for(idx in data)
            {                    
                cellvalue1 = ("<input type='input' name='sortactivityname[]' id='sortactivityname' value='" + data[idx].activitymain.name + "' readonly ></input>"
                            +"<input type='hidden' name='sortactivityid[]' id='sortactivityid' value='" + data[idx].activitymain.id + "' readonly ></input>"
                            +"<input type='hidden' name='sortissequence[]' id='sortissequence' value='" + data[idx].issequence + "' readonly ></input>");
                cellvalue2=("<input type='input' name='sortduration[]' id='sortduration' value='" + data[idx].activitymain.activities[0].duration + "' readonly ></input>");

                cellvalue3=("<input type='hidden' name='sortdesignation_id[]' id='sortdesignation_id' value='" + data[idx].activitymain.activities[0].designation.id + "' readonly ></input>"
                            +"<input type='input' name='sortdesignation_name[]' id='sortdesignation_name' value='" + data[idx].activitymain.activities[0].designation.name + "' readonly ></input>");
                
                cellvalue4=("");
                
                ct.row.add( [
                    (parseInt(idx) + 1),
                    (cellvalue1),
                    (cellvalue2),
                    (cellvalue3),
                    (cellvalue4),
                ]).draw( false );
            }
        }            
    };   
    Sgbz.membershipModelBoxInit = function(response, modalTitle)
    {
        var _this = this;
        // rename input id and lable for checkbox and radio box

        //input id : cash credit cheque basic
        $('#blankModal .modal-content > .modal-body input[id="cash"]').attr('id','cash-pupup');
        $('#blankModal .modal-content > .modal-body label[for="cash"]').attr('for','cash-pupup');                            

        $('#blankModal .modal-content > .modal-body input[id="credit"]').attr('id','credit-pupup');
        $('#blankModal .modal-content > .modal-body label[for="credit"]').attr('for','credit-pupup');
        $('#blankModal .modal-content > .modal-body input[id="cheque"]').attr('id','cheque-pupup');
        $('#blankModal .modal-content > .modal-body label[for="cheque"]').attr('for','cheque-pupup');
        $('#blankModal .modal-content > .modal-body input[id="basic"]').attr('id','basic-pupup');
        $('#blankModal .modal-content > .modal-body label[for="basic"]').attr('for','basic-pupup'); 
        
    };
    Sgbz.membershipAddInit = function()
    {
        var _this = this;
        _this.modeAdd = 2;
        $( '.membership-box .cash_div' ).hide();
        $( '.membership-box .credit_div' ).hide();
        $( '.membership-box .cheque_div' ).hide();
        //*
        //$( '.membership-box input[name="regdate"]' ).datepicker('remove');
        $( '.membership-box input[name="regdate"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd"});
        $( '.membership-box input[name="enquiry_date"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd"});
        $( '.membership-box input[name="dateofbirth"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd",changeMonth: true,changeYear: true,yearRange: "-100:-5"});
        $( '.membership-box input[name="wedding_date"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd",changeMonth: true,changeYear: true,yearRange: "-100:+1"});
        $( '.membership-box input[name="startdate"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd"});
        $( '.membership-box input[name="enddate"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd"});
        $( '.membership-box input[name="invoicedate"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd"});
        $( '.membership-box input[name="consultantdate"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd"});

        //*/
        //$( 'input[name="hoildaytime"]' ).timepicker({ 'timeFormat': 'H:i:s' , 'scrollDefault': '' });


        // on change course course_id
        $(".membership-box #course_id").change(function() {
            console.log( " ajax done " );
            var course_basic=$(this).val();

            var dataConfig = {
              course_id :  course_basic
            };
            
            var ct = $('.membership-box #courseactivitylines-table').DataTable();
            ct.clear().draw();            
           // alert("hai");
            if(course_basic > 0)
            {
                // get course active lines
                
                // Activity lines Start
                var controller = 'membership/';
                $.ajax({
                        method: "GET",
                        url: _this.baseURL + controller + "courseactivitylines",
                        data: dataConfig,
                    }).done( function( data, textStatus, jqXHR ) {
                        console.log( " ajax done " );
                        console.log( data, textStatus, jqXHR );                    

                        if(data.status == 1)
                        {
                            _this.fillTableCourseActivityLines('courseactivitylines-table',data.data);
                        }    
                        else
                        {

                        }
                        /**/

                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });          
                    if($(".membership-box #course_id").val()!=""){
                            //alert();
                            $('.membership-box #enddate').val('');
                            var n1 = $(".membership-box #duration").val();
                            var get_startdate1=$(".membership-box #startdate").val();
                            var date1 = new Date(get_startdate1);
                            var newdate1 = new Date(date1.getTime() + n1*24*60*60*1000);
                            var enddate1 = newdate1.getFullYear() + "-" + (newdate1.getMonth()+1) + "-" + (newdate1.getDate()-1);
                            var newddd1=$.datepicker.formatDate('yy-mm-dd', new Date(enddate1));
                            $('.membership-box input[name="enddate"]').val(newddd1);
                            //alert("hai");
                        }else{
                            alert("Please select your course....");
                        }
                // End of Activity lines
            }
        });
        //Cash checkbox
        $(".membership-box #is_cash").change(function(e) {
            console.log($(this).is(':checked'));
            console.log($(e).is(':checked'));
            if($(this).is(':checked')) {
                $('.membership-box .cash_div').show();
            }
            else{
                $('.membership-box .cash_div').hide();
            }
        });
        //credit checkbox
        $(".membership-box #is_credit").change(function() {
            if($(this).is(':checked')) {
                $('.membership-box .credit_div').show();
            }
            else{
                $('.membership-box .credit_div').hide();
            }
        });
        //credit checkbox
        $(".membership-box #is_cheque").change(function() {
            if($(this).is(':checked')) {
                $('.membership-box .cheque_div').show();
            }
            else{
                $('.membership-box .cheque_div').hide();
            }
        });
        
        $(".membership-box #startdate").change(function() {
                        if($(".membership-box #course_id").val()!=""){
                            alert();
                            $('.membership-box #enddate').val('');
                            var n1 = $(".membership-box #duration").val();
                            var get_startdate1=$(".membership-box #startdate").val();
                            var date1 = new Date(get_startdate1);
                            var newdate1 = new Date(date1.getTime() + n1*24*60*60*1000);
                            var enddate1 = newdate1.getFullYear() + "-" + (newdate1.getMonth()+1) + "-" + (newdate1.getDate()-1);
                            var newddd1=$.datepicker.formatDate('yy-mm-dd', new Date(enddate1));
                            $('.membership-box input[name="enddate"]').val(newddd1);
                            //alert("hai");
                        }else{
                            alert("Please select your course....");
                        }
                    });
        
        // init validation
        $.validate();            
    };
    Sgbz.customerEnqueryModelBoxInit = function(response, modalTitle)
    {
        var _this = this;        
    }
    Sgbz.customerEnqueryAddInit = function()
    {
        var _this = this;
        _this.modeAdd = 1;
        $( 'input[name="enquirydate"]' ).datepicker({defaultDate:0,dateFormat:"yy-mm-dd"});
        $( 'input[name="dateofbirth"]' ).datepicker({defaultDate:0,dateFormat:"yy-mm-dd",changeMonth: true,changeYear: true,yearRange: "c-100:c-5"});;
        $( 'input[name="wedding_date"]' ).datepicker({defaultDate:0,dateFormat:"yy-mm-dd",changeMonth: true,changeYear: true,yearRange: "c-100:c+0"});;
        //$( 'input[name="dateofbirth"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd"});
        //$( 'input[name="wedding_date"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd"});
        
        //$( 'input[name="create_time"]' ).timepicker({ 'timeFormat': 'H:i:s' , 'scrollDefault': '' });

        // init validation
        $.validate();      
        
        
        //////////////////Calculating Age from Date of birth///////////////////////////////////
        $( "#dateofbirth" ).change(function() {
            var dob=$("#dateofbirth").val();
            var currentdate= new Date().getTime();
            var dateob= new Date(dob).getTime();
            var diff = currentdate-dateob;
            var age = Math.round(diff/(12*31*24*60*60*1000));
            $('#age').val((parseInt(age)));
        });
        //////////////////Calculating Age from Date of birth///////////////////////////////////
        $( "#marital_status" ).change(function() {
            var marital_status=$("#marital_status").val();
            if(marital_status=='U'){
                $("#wedding_date").attr("disabled", "disabled");
            }
            if(marital_status=='M'){
                $("#wedding_date").removeAttr("disabled");
            }
            //alert(marital_status);
        });
        
    };
    /**************corporate booking add ********************************/
    Sgbz.corporateBookingAddInit = function()
    // todo rename the function name
    {
        var _this = this;
        $( '.corporatebooking-box .cash_div' ).hide();
        $( '.corporatebooking-box .credit_div' ).hide();
        $( '.corporatebooking-box .cheque_div' ).hide();
        //*
        //$( '.membership-box input[name="regdate"]' ).datepicker('remove');
        //$( '.corporatebooking-box input[name="regdate"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd"});
        $( '.corporatebooking-box input[name="course_date"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd"});
        $( '.corporatebooking-box input[name="startdate"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd"});
        $( '.corporatebooking-box input[name="enddate"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd"});
        //$( '.corporatebooking-box input[name="invoicedate"]' ).datepicker({defaultDate:'',dateFormat:"yy-mm-dd"});
        //*/
        //$( 'input[name="hoildaytime"]' ).timepicker({ 'timeFormat': 'H:i:s' , 'scrollDefault': '' });


        // on change course course_id
        /*$(".corporatebooking-box #course_id").change(function() {
            console.log( " ajax done " );
            var course_basic=$(this).val();
            var dataConfig = {
              course_id :  course_basic
            };
            
            var ct = $('.corporatebooking-box #courseactivitylines-table').DataTable();
            ct.clear().draw();            
            
            if(course_basic > 0)
            {
                // get course active lines
                
                // Activity lines Start
                var controller = 'corporatebooking/';
                $.ajax({
                        method: "GET",
                        url: _this.baseURL + controller + "courseactivitylines",
                        data: dataConfig,
                    }).done( function( data, textStatus, jqXHR ) {
                        console.log( " ajax done " );
                        console.log( data, textStatus, jqXHR );                    

                        if(data.status == 1)
                        {
                            _this.fillTableCourseActivityLines('courseactivitylines-table',data.data);
                        }    
                        else
                        {

                        }

                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });          

                // End of Activity lines
            }
        });*/
        //Cash checkbox
        $(".corporatebooking-box #is_cash").change(function(e) {
            console.log($(this).is(':checked'));
            console.log($(e).is(':checked'));
            if($(this).is(':checked')) {
                $('.corporatebooking-box .cash_div').show();
            }
            else{
                $('.corporatebooking-box .cash_div').hide();
            }
        });
        //credit checkbox
        $(".corporatebooking-box #is_credit").change(function() {
            if($(this).is(':checked')) {
                $('.corporatebooking-box .credit_div').show();
            }
            else{
                $('.corporatebooking-box .credit_div').hide();
            }
        });
        //credit checkbox
        $(".corporatebooking-box #is_cheque").change(function() {
            if($(this).is(':checked')) {
                $('.corporatebooking-box .cheque_div').show();
            }
            else{
                $('.corporatebooking-box .cheque_div').hide();
            }
        });
        // init validation
        $.validate();            
    };
    /************************* corporate booking end *********************/
    
    Sgbz.commomModelBoxInit = function(response, modalTitle)
    {
        var _this = this;
        $('#blankModal .modal-content > .modal-body').html(response);
        // margin-right: -5px;      margin-left: -5px;
        $('#blankModal .modal-content > .modal-body > div.row div.body > div.row ').css({'margin-left':'0px','margin-right':'0px'});

        $('#blankModal .modal-content > .modal-header > .modal-title').html(modalTitle); 

        var headers = $('#blankModal .modal-content > .modal-body').find('.box > header');
        //$(headers).eq(0).hide();
        $('#blankModal .modal-footer').hide();

        var ajaxFormOptions = _this.getAjaxFormOptions();
        
        $('#blankModal form').ajaxForm(ajaxFormOptions);           
    };
    Sgbz.initBlankModal = function() {    
        var _this = this;
        // show customer enquery model

        $('#blankModal').on('shown.bs.modal', function (e) {
            // do something...
            console.log('blankModal - shown');
        });

        $('#blankModal').on('show.bs.modal', function (e) {
            // do something...
            console.log('blankModal - show');

            var relatedTrgt = e.relatedTarget;

            //console.log($(relatedTrgt).attr('href'));                   

            $('#blankModal .modal-content > .modal-body').html('Loading...');

            // show customer enquery form Start
            var controllerURL = $(relatedTrgt).data('href');
            var modalTitle = $(relatedTrgt).data('model-name');
            if(controllerURL != undefined && modalTitle != undefined)
            {
                $.ajax({
                    method: "GET",
                    url: controllerURL,

                }).done( function( response, textStatus, jqXHR ) {
                    console.log( " ajax done " );
                    console.log( response, textStatus, jqXHR ); 
                    
                    _this.commomModelBoxInit( response, modalTitle );
                    
                    switch(modalTitle) {
                        case 'New Customer':
                            // Add New Customer Enquiry
                                // init membership box 
                                _this.customerEnqueryModelBoxInit( response, modalTitle );
                                // init add customer enquery
                                _this.customerEnqueryAddInit();
                            break;
                        case 'New Membership':
                            // Add New membership
                                // init membership box 
                                _this.membershipModelBoxInit( response, modalTitle );
                                // init add membership
                                _this.membershipAddInit();                            
                            break;
                        default:
                            //default code block
                    }
                }).fail( function( jqXHR, textStatus, errorThrown ) {
                    console.log( " ajax fail " );
                    console.log( jqXHR, textStatus, errorThrown );
                }).always ( function( response_jqXHR, textStatus, jqXHR_errorThrown ) {
                    console.log( " ajax always " );
                    console.log( response_jqXHR, textStatus, jqXHR_errorThrown );
                });          
            }
            // show customer enquery form End                

        });

        // end of show customer enquery model

        // submit customer enquery model

        // end of submit customer enquery model            
        
    };

    Sgbz.appRoot = function(site_url) {        
        var _this = this;
        
        
        //************ bootstrap  ****************************/


            $.fn.bootstrapBtn = $.fn.button.noConflict();
            $.fn.bootstrapTooltip = $.fn.tooltip.noConflict();
            //$.paramquery.pqGrid.prototype.options.bootstrap.on = true;
            //$.paramquery.pqSelect.prototype.options.bootstrap.on = true;
            if ($.paramquery && $.paramquery.pqGrid) {
                var options = $.paramquery.pqGrid.prototype.options;
                var css = $.paramquery.pqGrid.prototype.options.collapsible.css;
                //css.zIndex = 20000;
                css.marginTop = "51px";
                //css.marginLeft = "250px";
                options.toggle = function (evt, ui) {
                    //debugger;
                    if (ui.state == "max") {
                        this.option("height", "100%-51");                
                    }
                }
            }


            $.fn.datepicker.noConflict = function(){
               $.fn.datepicker = old;
               return this;
            };


        /************ bootstrap *****************************/        
        
        _this.baseURL = site_url;
        // init blank model box
        _this.initBlankModal();
        
        // AJAX CSRF Token setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        
        
        // Set Top Header Timer
        _this.handleClock();
        
    };
    return Sgbz;
})(jQuery, Sgbz || {});

/**********Site Root End*******************************************************/

/**********Site Bank Start*******************************************************/
;(function($, Sgbz) {  
    Sgbz.filteringOptionsInit = function(gridConfig)
    {
        var _this = this;
        // Attach click even on Options
        $("#content .filtering-options input[type=checkbox]").on("click", function () {
            var $cb = $(this);
            $(DataController.config.container).jsGrid("option", $cb.attr("id"), $cb.is(":checked"));
        });        
    };
    Sgbz.filteringPerPageInit = function(gridConfig)
    {
        var _this = this;
        // on per page count change
        $('#content .filtering-options input[id="per_page"]').change(function() {                
            DataController.config.pageSize = $('#per_page').val();
            $(DataController.config.container).jsGrid("option", "pageSize", DataController.config.pageSize);
        });             
    };
    Sgbz.filteringInit = function(gridConfig)
    {
        var _this = this;
        _this.filteringOptionsInit();
        _this.filteringPerPageInit();
    };
    
    Sgbz.bankListInit = function(gridConfig)
    {
        var _this = this;
        
        // Create grid AJAX
        DataController.initGrid(gridConfig);

        // filtering init
        _this.filteringInit();   
        
    };    
    return Sgbz;
})(jQuery, Sgbz || {});
/**********Site Bank End*******************************************************/
/**********Site Branch Start*******************************************************/
;(function($, Sgbz) {  
    Sgbz.branchListInit = function(gridConfig)
    {
        var _this = this;
        
        // Create grid AJAX
        DataController.initGrid(gridConfig);

        // filtering init
        _this.filteringInit();   
        
    };    
    return Sgbz;
})(jQuery, Sgbz || {});
/**********Site Branch End*******************************************************/
/**********Site Customer Enquery Start*******************************************************/
;(function($, Sgbz) {  
    Sgbz.customerEnqueryListInit = function(gridConfig)
    {
        var _this = this;
        
        // Create grid AJAX
        DataController.initGrid(gridConfig);

        // filtering init
        _this.filteringInit();   
        
    };    
    return Sgbz;
})(jQuery, Sgbz || {});
/**********Site Customer Enquery End*******************************************************/
/**********Generic AJAX Start*******************************************************/
;(function($, Sgbz) { 
    Sgbz.callbackSuccess = null;
    Sgbz.callbackError = null;
    Sgbz.success = function( data, textStatus, jqXHR ){
        var _this = this;
        console.log('----Sgbz.success-----');
        //console.log(_this);
        console.log(textStatus);
        console.log(data);
        if(Sgbz.callbackSuccess != undefined && Sgbz.callbackSuccess != null)
        {
            Sgbz.callbackSuccess( data, textStatus, jqXHR );
        }
        
    };
    Sgbz.error = function( jqXHR, textStatus, errorThrown ){
        var _this = this;
        console.log('----Sgbz.error-----');
        //console.log(_this);
        console.log(textStatus);
        console.log(errorThrown);
        if(Sgbz.callbackError != undefined && Sgbz.callbackError != null)
        {
            Sgbz.callbackError( jqXHR, textStatus, errorThrown );
        }
    };
    Sgbz.ajax_init = function(config)
    {
        var _this = this;
        if(config.success != undefined)
            _this.callbackSuccess   = config.success;
        else
            _this.callbackSuccess = null;
        if(config.error != undefined)
            _this.callbackError     = config.error;
        else
            _this.callbackError = null;
        //_this.callbackComplete  = config.complete;
        
    };   
    
    Sgbz.ajax = function(config)
    {
        var _this = this;
        
        _this.ajax_init(config);
        
        config.success = _this.success;
            
        config.error = _this.error;
        
        var _config = {
            method: "POST",
            //type: "POST",
            url: _site_url,
            //data: data,
            //success: _this.success,
            //error: _this.error,
            //complete: _this.complete,
            dataType: 'text'            
        };
        
        $.extend(_config, config);        
                
        $.ajax(config);
        
    };    
    return Sgbz;
})(jQuery, Sgbz || {});
/**********Generic AJAX End*******************************************************/
/**********Generic NOTIFY Start*******************************************************/
;(function($, Sgbz) { 
  
    Sgbz.notify = function(options,settings)
    {
        var _this = this;
        
        var args = arguments;
        console.log(args);
        var args_n = args.length;
        
        if(args_n > 2)
        {
            $.notify(options,settings);
        }
        else if(args_n == 2)
        {
            if(typeof options == "string" && typeof settings == "string")
            {
                $.notify(options,{type: settings});
            }
            else if(typeof options == "object" && typeof settings == "string")
            {
                $.notify(options,{type: settings});
            }
            else //if(typeof options == "object" && typeof settings == "object")
            {
                $.notify(options,settings);
            }            
        }
        else if(args_n == 1)
        {
            /*
            if(typeof options == "string")
            {
                $.notify(options);
            }
            else if(typeof options == "object")
            {
                $.notify(options);
            }
            */
            $.notify(options);
        }
        else
        {
            //$.notify(options);
        }
        
        //var _config = {
                      
        //};
        
        //$.extend(_config, config);        
        /*    
        $.notify({
            // options
            message: 'Hello World' 
        },{
            // settings
            type: 'danger'
        });
        */
        //$.notify(config);
        
        
        
        /*
            How to use it
        
            Sgbz.notify("mahesh")
            Sgbz.notify("mahesh","danger")
            Sgbz.notify("mahesh","warning")
            Sgbz.notify("mahesh","info")
            Sgbz.notify("mahesh","success")
            Sgbz.notify({
                // options
                message: 'Hello World' 
            },{
                // settings
                type: 'danger'
            });
         */
        
    };    
    return Sgbz;
})(jQuery, Sgbz || {});
/**********Generic NOTIFY End*******************************************************/


/**********Attendance Widget Start *******************************************************/
;(function($, Sgbz) { 
    
    // attendance-search
    //Sgbz.attendance_search_elem = "attendance-search";
    Sgbz.attendance_search_elem = $('#attendance .attendance-search input[name="attendance-search"]');
    Sgbz.attendance_list = $('#attendance .attendance-list');
    
    Sgbz.attendanceInit = function()
    {
        console.log("---attendanceInit-----------------------------1--");
        var _this = this;
        
        //$elem = '#attendance';
        //$elem2 = '#attendance-trigger';        
        $(_this.attendance_search_elem).change(function() {                
            console.log("---attendanceInit-----------------change------------1--");
            _this.attendanceSearch();
        });
        
        // sync todays attendance
        //moment().format("YYYY-MM-DD");
        
        _this.attendanceSync(moment().format("YYYY-MM-DD"));
        
        
        console.log("---attendanceInit-----------------------------2--");
    }; 
    
    Sgbz.attendanceSearch = function()
    {
        var _this = this;
        console.log("---attendanceSearch-----------------------------1--");
        
        var txt = $(_this.attendance_search_elem).val();
        
        
            var url = _site_url + "attendance/log";
            var data = {'branch_id':'abc','barcode_txt':txt};
            var dataType = "json";
            var success = function( data, textStatus, jqXHR ){
                //console.log('----success-----');
                //console.log(textStatus);
                //console.log(data);
                //callbackAddActivities(data);
                _this.attendanceSearchCallback(data);
            };
            var error = function( jqXHR, textStatus, errorThrown ){
                //console.log('----error-----');
                //console.log(textStatus);
                //console.log(errorThrown);
            };               

            var config = {
                //method: "GET",
                method: "POST",
                url: url,
                data: data,
                success: success,
                error: error,
                dataType: dataType
            };
            //Sgbz.ajax(config);        
            this.ajax(config);        
        
        
    }; 
    
    Sgbz.attendanceSearchCallback = function(data)
    {
        var _this = this;
        console.log("---attendanceSearchCallback-----------------------------1--");
        console.log(data);
        if(data.attendanceLogFlag == 1) // attendance logged
        {
            _this.attendanceAddNew(data);
        }
        else // not logged
        {
            
        }
    }; 
    
    Sgbz.attendanceAddNew = function(attndata)
    {
        var _this = this;
        console.log("---attendanceAddNew-----------------------------1--");
        
        var data = {
            'attndata':attndata,
            'cs':0,             // client:0 server:1
        };
        
        data.status = 0;
        data.src = _site_url + "material_admin_v-1.5-2/Template/jquery/img/profile-pics/images.png";
        // src
        // name
        // date and time
        data.datetime = moment().format("hh:mm A");
        if(attndata.attendanceType == 1) // member
        {
            if(attndata.userMemberData.image != "" && attndata.userMemberData.image!= null && attndata.userMemberData.image!= "NULL")
            {
                // static/uploads/members
                data.src = _site_url + "static/uploads/members/" + attndata.userMemberData.image;
            }
            else if(attndata.userMemberData.sex != "" && attndata.userMemberData.sex!= null && attndata.userMemberData.sex!= "NULL")
            {
                if(attndata.userMemberData.sex == "M")
                {
                    data.src = _site_url + "material_admin_v-1.5-2/Template/jquery/img/profile-pics/4.jpg";
                }
                else
                {
                    data.src = _site_url + "material_admin_v-1.5-2/Template/jquery/img/profile-pics/7.jpg";
                }
            }
            
            //data.name = firstname lastname membership_code associate_id
            
            var name = attndata.userMemberData.firstname;
            name += " " + attndata.userMemberData.lastname;
            name += " " + attndata.userMemberData.membership_code;
            name += " " + attndata.userMemberData.associate_id;
            
            //attndata.userMemberData.fullname
            
            data.name = name;
            
            if(attndata.attendanceExpired == 1)
            {
                data.status = 1;
            }
            
        }
        else // user
        {
            // fullname email
            data.name = attndata.userMemberData.fullname + " " + attndata.userMemberData.email;
            data.status = 1;
        }
        
        _this.attendanceAttatch(data);
    };
    
    Sgbz.attendanceAttatch = function(attndata)
    {
        var _this = this;
        console.log("---attendanceAddNew-----------------------------1--");
        
        console.log(attndata);
        
        // $("ul").prepend("<li>ONE</li>");
        
        
        var attnList = $(Sgbz.attendance_list).find('a');
        
        var attn = attnList.eq(0).clone();
        
        // var _lb = $('#attendance .attendance-list').find('a');
        //$('#attendance .attendance-list').prepend(_lb.eq(0).clone());
        
        //var img = $(attn).find("img.lv-img-sm");        
        //img.src = attndata.src;
        
        $(attn).find("img.lv-img-sm").attr('src',attndata.src);
        
        // lv-title
        
        $(attn).find("div.lv-title").html(attndata.name);
        $(attn).find("small.lv-small").html(attndata.datetime);
        if($(attn).find("i.icnst"))
        {
            var icnst = $(attn).find("i.icnst");
            
            $(icnst).removeClass();
            $(icnst).addClass("icnst");
            
            if(attndata.status == 1)
                $(icnst).addClass("chat-status-online"); 
            else                
                $(icnst).addClass("chat-status-busy");
            
        }      
        
        // lv-itm-dummy
        $(attn).removeClass("lv-itm-dummy");
                
        $(Sgbz.attendance_list).prepend(attn);
        
        
        $(Sgbz.attendance_list).find('a.lv-itm-dummy').remove();
        
    };
    
    Sgbz.attendanceSync = function(dateStr)
    {
        var _this = this;
        console.log("---attendanceSync-----------------------------1--");
        
        //dateStr = "2016-11-30";
        
            var url = _site_url + "attendance/logs";
            var data = {'branch_id':'abc','fetch_date':dateStr};
            var dataType = "json";
            var success = function( data, textStatus, jqXHR ){
                //console.log('----success-----');
                //console.log(textStatus);
                //console.log(data);
                //callbackAddActivities(data);
                _this.attendanceSyncCallback(data);
            };
            var error = function( jqXHR, textStatus, errorThrown ){
                //console.log('----error-----');
                //console.log(textStatus);
                //console.log(errorThrown);
            };               

            var config = {
                //method: "GET",
                //method: "POST",
                url: url,
                data: data,
                success: success,
                error: error,
                dataType: dataType
            };
            this.ajax(config);    
            //Sgbz.ajax(config);    
            //var _sgbz = new Sgbz();
            //_sgbz.ajax(config);
            
        console.log("---attendanceSync-----------------------------2--");    
    };
    
    Sgbz.attendanceSyncCallback = function(data)
    {
        var _this = this;
        console.log("---attendanceSyncCallback-----------------------------1--");
        
        console.log(data);
        
        if(data != undefined && data.length > 0)
        {
            var ln = data.length;
            var i=0;
            var a;
            for(;i<ln;i++)
            {
                a = data[i];
                
                _this.attendanceAddOld(a);
                
            }
        }
        console.log("---attendanceSyncCallback-----------------------------2--");
    };
    
    Sgbz.attendanceAddOld = function(attndata)
    {
        var _this = this;
        console.log("---attendanceAddOld-----------------------------1--");
        
        console.log(attndata);
        
        var data = {
            'attndata':attndata,
            'cs':1,             // client:0 server:1
        };
        
        data.status = 0;
        data.src = _site_url + "material_admin_v-1.5-2/Template/jquery/img/profile-pics/images.png";
        // src
        // name
        // date and time
        data.datetime = moment(attndata.date_time,"YYYY-MM-DD HH:mm:ss").format("MMM DD YYYY hh:mm A");
        if(attndata.type == 1) // member
        {
            if(attndata.userMemberData.image != "" && attndata.userMemberData.image!= null && attndata.userMemberData.image!= "NULL")
            {
                // static/uploads/members
                data.src = _site_url + "static/uploads/members/" + attndata.userMemberData.image;
            }
            else if(attndata.userMemberData.sex != "" && attndata.userMemberData.sex!= null && attndata.userMemberData.sex!= "NULL")
            {
                if(attndata.userMemberData.sex == "M")
                {
                    data.src = _site_url + "material_admin_v-1.5-2/Template/jquery/img/profile-pics/4.jpg";
                }
                else
                {
                    data.src = _site_url + "material_admin_v-1.5-2/Template/jquery/img/profile-pics/7.jpg";
                }
            }
            
            //data.name = firstname lastname membership_code associate_id
            
            var name = attndata.userMemberData.firstname;
            name += " " + attndata.userMemberData.lastname;
            name += " " + attndata.userMemberData.membership_code;
            name += " " + attndata.userMemberData.associate_id;
            
            //attndata.userMemberData.fullname
            
            data.name = name;
            
            if(attndata.attendanceExpired == 1)
            {
                data.status = 1;
            }
            
        }
        else // user
        {
            // fullname email
            console.log(attndata);
            console.log(attndata.userMemberData);
            data.name = attndata.userMemberData.fullname + " " + attndata.userMemberData.email;
            data.status = 1;
        }
        
        _this.attendanceAttatch(data);
        
        console.log("---attendanceAddOld-----------------------------2--");
    };
    
    return Sgbz;
})(jQuery, Sgbz || {});
/**********Attendance Widget End*******************************************************/

/**********Trainer Widget Start *******************************************************/
;(function($, Sgbz) {  
    //Sgbz.attendance_search_elem = $('#attendance .attendance-search input[name="attendance-search"]');
    //Sgbz.attendance_list = $('#attendance .attendance-list');
    Sgbz.tnrmbrBox = $('.tnr-widget-mbr');
    Sgbz.tnrmbrBoxSearchInput = $('.tnr-widget-mbr input.typeahead-mbr-tnr');
    Sgbz.tnrmbrBoxMbrSlt = $('.tnr-widget-mbr span.trn-mbr');
    // bc_m_s_form
    //Sgbz.tnrmbrBoxMbrFrm = $('.tnr-widget-mbr input[name="bc_m_s_form"]');
    // $('.tnr-widget-mbr input[name="bc_m_s_form"]:checked').val()
    
    Sgbz.tnrmbrBoxOpenButton = $('.tnr-widget-mbr button.trn-mbr-open-frm');
    
    Sgbz.tnrmbrBoxTaba = $('.tnr-widget-mbr .tab-nav a[data-toggle="tab"]');
    
    Sgbz.tnrmbrModel = $('#tnr-mber-Modal');
    
    Sgbz.tnrmbrBoxUpdateTabbox = $('.tnr-widget-mbr .tnrmbr-update');
    
    Sgbz.tnrmbrModelUpdate = $('#tnr-mber-Modal-act-update');
    
    Sgbz._tnr_mbr = null;
    Sgbz._tnr_mbr_id = null;
    Sgbz._tnr_frm_id = null;
    
    Sgbz._tnr_tab_id = null;
    Sgbz._tnr_actmId = null;
    Sgbz._tnr_actloaded = false;
    Sgbz._tnr_aptmId = null;
    Sgbz._tnr_aptloaded = false;
    
    
    // bc_m_s_form
    /*
            membershiphealth/addmemhealth/52
            Body Composition
            membershipmeasurement/addmemmeasur/52
            Measurement Card
            membershipsegmental/addmemsegment/52
            Segmental Body Composition
    */
    Sgbz.successAddMessagesTnrmbr = {
        1:"Body Composition added successfully!",
        2:"Measurement Card added successfully!",
        3:"Segmental Body Composition added successfully!",
    };
    
    Sgbz.ajaxFormSubmitSuccessTnrmbr = function(responseText , statusText, xhr, formObject) 
    { 
        console.log("---ajaxFormSubmitSuccessTnrmbr-----------------------------1--");
        var _this = this;
        console.log(responseText);
        console.log(statusText);
        //alert('Thanks for your comment!'); 
        //$('.error-list').html('');
        if(responseText.status=="1")
        {
            //alert('Data Added successfully!'); 
            if( _this._tnr_frm_id > 0 && _this.successAddMessagesTnrmbr.hasOwnProperty(_this._tnr_frm_id))
            {
                _this.notify(_this.successAddMessagesTnrmbr[_this._tnr_frm_id], "success");
            }
            else
            {
                _this.notify("Data added successfully!", "success");
            }
            // close the the model box
            $(this.tnrmbrModel).modal('hide');
        }
        else
        {
            // error-list
            if(typeof responseText.message == "string")
            {
                //$('.error-list').append('<span class="label label-danger">'+responseText.message+'</span>');
                
                _this.notify(responseText.message, "warning");
            }
            else
            {       
                var idx,idx2;                                                  
                for(idx in responseText.message)
                {
                    for(idx2 in responseText.message[idx])
                    {
                        //$('.error-list').append('<span class="label label-danger">'+idx+' : '+idx2+' : '+responseText.message[idx][idx2]+'</span><br>');
                        _this.notify(idx+' :- '+idx2+' : '+responseText.message[idx][idx2], "warning");
                    }    
                }                                
            }
        }  
        console.log("---ajaxFormSubmitSuccessTnrmbr-----------------------------2--");
    };    
    
    // prepare Options Object 
    Sgbz.getAjaxFormOptionsTnrmbr = function() 
    { 
        console.log("---getAjaxFormOptionsTnrmbr-----------------------------1--");
        
        var _this = this;
        var ajaxFormOptions = { 
            //target:     '#divToUpdate', 
            //url:        'comment.php', 
            dataType : "json",
            beforeSubmit: function(arr, $form, options) { 
                // The array of form data takes the following form: 
                // [ { name: 'username', value: 'jresig' }, { name: 'password', value: 'secret' } ] 

                // return false to cancel submit
                //var flag = false;    // false   true          
                var flag = true;    // false   true          
                // check here validation status
                //alert('beforeSubmit');
                return flag;
                
            },
            success:    function(responseText , statusText, xhr, formObject) { 
                _this.ajaxFormSubmitSuccessTnrmbr(responseText , statusText, xhr, formObject);
            } 
        };         
        console.log("---getAjaxFormOptionsTnrmbr-----------------------------2--");
        return ajaxFormOptions;
    }; 
    
    Sgbz.successAddMessagesTnrmbrActivityUpdate = {
        1:"Activity updated successfully!",
    };
    
    Sgbz.ajaxFormSubmitSuccessTnrmbrActivityUpdate = function(responseText , statusText, xhr, formObject) 
    { 
        console.log("---ajaxFormSubmitSuccessTnrmbrActivityUpdate-----------------------------1--");
        var _this = this;
        console.log(responseText);
        console.log(statusText);
        //alert('Thanks for your comment!'); 
        //$('.error-list').html('');
        if(responseText.status=="1")
        {
            //alert('Data Added successfully!'); 
            _this.notify(_this.successAddMessagesTnrmbrActivityUpdate[1], "success");
            // close the the model box
            $(this.tnrmbrModelUpdate).modal('hide');
        }
        else
        {
            // error-list
            if(typeof responseText.message == "string")
            {
                //$('.error-list').append('<span class="label label-danger">'+responseText.message+'</span>');
                
                _this.notify(responseText.message, "warning");
            }
            else
            {       
                var idx,idx2;                                                  
                for(idx in responseText.message)
                {
                    for(idx2 in responseText.message[idx])
                    {
                        //$('.error-list').append('<span class="label label-danger">'+idx+' : '+idx2+' : '+responseText.message[idx][idx2]+'</span><br>');
                        _this.notify(idx+' :- '+idx2+' : '+responseText.message[idx][idx2], "warning");
                    }    
                }                                
            }
        }  
        console.log("---ajaxFormSubmitSuccessTnrmbrActivityUpdate-----------------------------2--");
    };    
    
    // prepare Options Object 
    Sgbz.getAjaxFormOptionsTnrmbrActivityUpdate = function() 
    { 
        console.log("---getAjaxFormOptionsTnrmbrActivityUpdate-----------------------------1--");
        
        var _this = this;
        var ajaxFormOptions = { 
            //target:     '#divToUpdate', 
            //url:        'comment.php', 
            dataType : "json",
            beforeSubmit: function(arr, $form, options) { 
                // The array of form data takes the following form: 
                // [ { name: 'username', value: 'jresig' }, { name: 'password', value: 'secret' } ] 

                // return false to cancel submit
                //var flag = false;    // false   true          
                var flag = true;    // false   true          
                // check here validation status
                //alert('beforeSubmit');
                return flag;
                
            },
            success:    function(responseText , statusText, xhr, formObject) { 
                _this.ajaxFormSubmitSuccessTnrmbrActivityUpdate(responseText , statusText, xhr, formObject);
            } 
        };         
        console.log("---getAjaxFormOptionsTnrmbrActivityUpdate-----------------------------2--");
        return ajaxFormOptions;
    }; 
        
    
    Sgbz.commomModelBoxTnrmbrInitSBC = function()
    {
        console.log("---commomModelBoxTnrmbrInitSBC-----------------------------1--");
        var _this = this;
        
        
        console.log("---commomModelBoxTnrmbrInitSBC-----------------------------2--");
    };
    
    Sgbz.commomModelBoxTnrmbrInitMC = function()
    {
        console.log("---commomModelBoxTnrmbrInitMC-----------------------------1--");
        var _this = this;
        
        
        console.log("---commomModelBoxTnrmbrInitMC-----------------------------2--");
    };
    
    Sgbz.commomModelBoxTnrmbrInitBC = function()
    {
        console.log("---commomModelBoxTnrmbrInitBC-----------------------------1--");
        var _this = this;
        
        
        console.log("---commomModelBoxTnrmbrInitBC-----------------------------2--");
    };
            

    Sgbz.commomModelBoxTnrmbrInit = function(response, modalTitle)
    {
        console.log("---commomModelBoxTnrmbrInit-----------------------------1--");
        var _this = this;
        $(this.tnrmbrModel).find('.modal-content > .modal-body').html(response);
        // margin-right: -5px;      margin-left: -5px;
        $(this.tnrmbrModel).find('.modal-content > .modal-body > div.row div.body > div.row ').css({'margin-left':'0px','margin-right':'0px'});

        $(this.tnrmbrModel).find('.modal-content > .modal-header > .modal-title').html(modalTitle); 

        var headers = $(this.tnrmbrModel).find('.modal-content > .modal-body').find('.box > header');
        //$(headers).eq(0).hide();
        $(this.tnrmbrModel).find('.modal-footer').hide();
        
        
        // card-header
        $(this.tnrmbrModel).find('.modal-content > .modal-body').find('.card-header').hide();
        // h2.f-400
        $(this.tnrmbrModel).find('.modal-content > .modal-body').find('h2.f-400').hide();
        

        var ajaxFormOptions = _this.getAjaxFormOptionsTnrmbr();
        
        $(this.tnrmbrModel).find('form').ajaxForm(ajaxFormOptions);
        
        
        switch(_this._tnr_frm_id) {
                case '1':
                    this.commomModelBoxTnrmbrInitBC();
                    break;
                case '2':
                    this.commomModelBoxTnrmbrInitMC();
                    break;
                case '3':
                    this.commomModelBoxTnrmbrInitSBC();
                    break;
                default:
                    //default code block
            }
        
        console.log("---commomModelBoxTnrmbrInit-----------------------------2--");
    };
    
    Sgbz.initBlankModalTnrmbr = function() 
    {    
        console.log("---initBlankModalTnrmbr-----------------------------1--");
        var _this = this;
        // show customer enquery model

        $(this.tnrmbrModel).on('shown.bs.modal', function (e) {
            // do something...
            console.log('initBlankModalTnrmbr-tnr-mber-Modal - shown');
        });

        $(this.tnrmbrModel).on('show.bs.modal', function (e) {
            // do something...
            console.log('initBlankModalTnrmbr-tnr-mber-Modal - show');

            var relatedTrgt = e.relatedTarget;

            //console.log($(relatedTrgt).attr('href'));                   

            $(_this.tnrmbrModel).find('.modal-content > .modal-body').html('Loading...');
            /*
            membershiphealth/addmemhealth/52
            Body Composition
            membershipmeasurement/addmemmeasur/52
            Measurement Card
            membershipsegmental/addmemsegment/52
            Segmental Body Composition
            */
            // show customer enquery form Start
            //var controllerURL = $(relatedTrgt).data('href');
            //var modalTitle = $(relatedTrgt).data('model-name');
            var modalTitle,controllerURL;
            switch(_this._tnr_frm_id) {
                case '1':
                    modalTitle = "Body Composition";
                    controllerURL = _site_url + "membershiphealth/addmemhealth/"+_this._tnr_mbr_id;
                    break;
                case '2':
                    modalTitle = "Measurement Card";
                    controllerURL = _site_url + "membershipmeasurement/addmemmeasur/"+_this._tnr_mbr_id;
                    break;
                case '3':
                    modalTitle = "Segmental Body Composition";
                    controllerURL = _site_url + "membershipsegmental/addmemsegment/"+_this._tnr_mbr_id;
                    break;
                default:
                    //default code block
            }
            if(controllerURL != undefined && modalTitle != undefined)
            {
                $.ajax({
                    method: "GET",
                    url: controllerURL,

                }).done( function( response, textStatus, jqXHR ) {
                    console.log( " initBlankModalTnrmbr-ajax done " );
                    console.log( response, textStatus, jqXHR ); 
                    
                    _this.commomModelBoxTnrmbrInit( response, modalTitle );
                    
                    switch(_this._tnr_frm_id) {
                        case '1':
                            // Add New Customer Enquiry
                                // init membership box 
                                //_this.customerEnqueryModelBoxInit( response, modalTitle );
                                // init add customer enquery
                               // _this.customerEnqueryAddInit();
                            break;
                        case '2':
                            // Add New membership
                                // init membership box 
                                //_this.membershipModelBoxInit( response, modalTitle );
                                // init add membership
                                //_this.membershipAddInit();                            
                            break;
                        case '3':
                            
                            break;
                        default:
                            //default code block
                    }
                }).fail( function( jqXHR, textStatus, errorThrown ) {
                    console.log( " initBlankModalTnrmbr-ajax fail " );
                    console.log( jqXHR, textStatus, errorThrown );
                }).always ( function( response_jqXHR, textStatus, jqXHR_errorThrown ) {
                    console.log( " initBlankModalTnrmbr-ajax always " );
                    console.log( response_jqXHR, textStatus, jqXHR_errorThrown );
                });          
            }
            // show customer enquery form End                

        });

        // end of show customer enquery model

        // submit customer enquery model

        // end of submit customer enquery model 
        
        console.log("---initBlankModalTnrmbr-----------------------------2--");
        
    };

    Sgbz.tnrmbrMbrFrmOpenLoad = function()
    {
        console.log("---tnrmbrMbrFrmOpenLoad-----------------------------1--");
        var _this = this;
        
        console.log(this._tnr_mbr_id);
        console.log(this._tnr_frm_id);
        
        
        $(this.tnrmbrModel).modal();
        
        
        console.log("---tnrmbrMbrFrmOpenLoad-----------------------------2--");
    };
    
    Sgbz.tnrmbrMbrFrmOpenClick = function()
    {
        console.log("---tnrmbrMbrFrmOpenClick-----------------------------1--");
        var _this = this;
        
        // check member selected
        
        if(this._tnr_mbr == null)
        {
            this.notify("Please select member first",'warning');
            return;
        }
        
        // check form selected
        // $("input[name='radioGroup']:checked").val()
        
        //var tnrmbrBoxMbrFrm = $("input[name='radioGroup']:checked");
        var tnrmbrBoxMbrFrm = $(this.tnrmbrBox).find("input[name='bc_m_s_form']:checked");
        if(tnrmbrBoxMbrFrm.length == 0)
        {
            this.notify("Please select form",'warning');
            return;
        }
        
        // open/display the form
        
        this._tnr_frm_id = $(tnrmbrBoxMbrFrm).val();
        this._tnr_mbr_id = this._tnr_mbr.value;
        
        
        this.tnrmbrMbrFrmOpenLoad();
        
        console.log("---tnrmbrMbrFrmOpenClick-----------------------------2--");
    };    
    
    Sgbz.tnrmbrMbrFrmOpenInit = function()
    {
        console.log("---tnrmbrMbrFrmOpenInit-----------------------------1--");
        var _this = this;
        
        //this.tnrmbrMbrSrchInit();
        //this.tnrmbrMbrFrmOpenInit();
        
        $( this.tnrmbrBoxOpenButton ).on( "click", function() {
            console.log("---tnrmbrMbrFrmOpenInit--------tnrmbrBoxOpenButton---------------------1-1-");
            //console.log( '.create-activity-timeslot-form .bottom-row-buttons button.add-more-plus' );
            //console.log( $( this ).text() );
            //showCreateActSettings();
            _this.tnrmbrMbrFrmOpenClick();
        });
        
        console.log("---tnrmbrMbrFrmOpenInit-----------------------------2--");
    };
    
    Sgbz.getmemberSearch = function()
    {
        console.log("---getmemberSearch-----------------------------1--");
        var _this = this;
        
            var urlSearch = _site_url + 'membership/search';
            //console.log(urlSearch);
            
            //var userSearch = _site_url + 'userdetail/search';
            
            var _prefetchAct = urlSearch + '?_t='+moment().format("YYYY-MM-DD");
            
            //var _prefetchUserAct = userSearch + '?_t='+moment().format("YYYY-MM-DD");
            
            var memberSearch = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('label'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                identify: function(obj) {
                    //console.log('-----------Bloodhound-------------');
                    //console.log(obj);
                    return obj.value; 
                },
                //prefetch: _prefetchAct,
                remote: {
                    url: _prefetchAct + '&term=%QUERY',
                    wildcard: '%QUERY',
                    /*
                    prepare : function(query, settings)
                    {
                        //console.log(query);
                        //console.log(settings);
                        return settings;
                    }
                    */
                }
            });
        console.log("---getmemberSearch-----------------------------2--");    
        return memberSearch;
    };
    
    Sgbz.tnrmbrMbrSrchInit = function()
    {
        console.log("---tnrmbrMbrSrchInit-----------------------------1--");
        var _this = this;
        
        var memberSearch = this.getmemberSearch();

            $(this.tnrmbrBoxSearchInput).typeahead(null, {
                name: 'tnr-mbr-search',
                display: 'label',
                limit: 50,
                source: memberSearch
            });        
            
            
        $(this.tnrmbrBoxSearchInput).bind('typeahead:select', function(ev, suggestion) {
            console.log("---tnrmbrMbrSrchInit-----------------------------1-1-");
            console.log('----------_tnr_mbr-suggestion--------select-----');
            //console.log(suggestion);
            console.log('Selection: ' + suggestion);
            _this._tnr_mbr = suggestion;
            //clearBookAptActv();
            //loadMemberBookActivities();
            
            var mtxt = suggestion.label;
            // membership/show/29
            mtxt += '<br><a href="'+_site_url+'membership/show/'+suggestion.value+'" target="_blank"> <i class="zmdi zmdi-collection-text zmdi-hc-fw"></i> Member Detail</a>';
            
            $(_this.tnrmbrBoxMbrSlt).html(mtxt);
            
            console.log(_this._tnr_mbr);
            
            // load course activities or appoints
            _this.tnrmbrMbrTabInitClick();

        });            
            
        $(this.tnrmbrBoxSearchInput).bind('typeahead:open', function(ev, suggestion) {
            //console.log('Selection: ' + suggestion);
            console.log('----------_tnr_mbr-suggestion-------open------');
            _this._tnr_mbr = null;
            $(_this.tnrmbrBoxMbrSlt).html('Select Member');
            $(_this.tnrmbrBoxSearchInput).typeahead('val', null);
        });
        $(this.tnrmbrBoxSearchInput).bind('typeahead:close', function(ev, suggestion) {
            //console.log('Selection: ' + suggestion);
            console.log('----------_tnr_mbr-suggestion-------close------');
        });
        $(this.tnrmbrBoxSearchInput).bind('typeahead:active', function(ev, suggestion) {
            //console.log('Selection: ' + suggestion);
            console.log('----------_tnr_mbr-suggestion-------active------');
        });
        $(this.tnrmbrBoxSearchInput).bind('typeahead:change', function(ev, suggestion) {
            //console.log('Selection: ' + suggestion);
            console.log('----------_tnr_mbr-suggestion-------change------');
            //clearBookAptActv();
        });            
            
        console.log("---tnrmbrMbrSrchInit-----------------------------2--");
    };
    
    Sgbz.initBlankModalTnrmbrActivity = function() 
    {    
        console.log("---initBlankModalTnrmbrActivity-----------------------------1--");
        var _this = this;
        // show customer enquery model

        $(this.tnrmbrModelUpdate).on('shown.bs.modal', function (e) {
            // do something...
            console.log('initBlankModalTnrmbr-tnr-mber-Modal - shown');
        });

        $(this.tnrmbrModelUpdate).on('show.bs.modal', function (e) {
            // do something...
            console.log('initBlankModalTnrmbrActivity-tnr-mber-Modal - show');

            var relatedTrgt = e.relatedTarget;

            //console.log($(relatedTrgt).attr('href'));

            //$(_this.tnrmbrModelUpdate).find('.modal-content > .modal-body').html('Loading...');
                          
            _this.tnrmbrLoadModalActivity(relatedTrgt);             
        }); 

        // end of show customer enquery model

        // submit customer enquery model

        // end of submit customer enquery model 
        
        console.log("---initBlankModalTnrmbrActivity-----------------------------2--");
        
    };
    
    Sgbz.tnrmbrLoadModalActivity = function(relatedTrgt)
    {
        console.log("---tnrmbrLoadModalActivity-----------------------------1--");
        var _this = this;
            /*
             * data-id="id" 
                data-tp="tp" 
                data-activity_id="activity_id" 
                data-membership_id="membership_id" 
                data-membership_basic_addon_id="membership_basic_addon_id"
             */                
            console.log($(relatedTrgt).attr('data-id'));                   
            console.log($(relatedTrgt).attr('data-tp'));                   
            console.log($(relatedTrgt).attr('data-activity_id'));                   
            console.log($(relatedTrgt).attr('data-membership_id'));                   
            console.log($(relatedTrgt).attr('data-membership_basic_addon_id'));      
        var id =  $(relatedTrgt).attr('data-id');   
        var tp =  $(relatedTrgt).attr('data-tp');   
        var activity_id =  $(relatedTrgt).attr('data-activity_id');   
        var membership_id =  $(relatedTrgt).attr('data-membership_id');   
        var membership_basic_addon_id =  $(relatedTrgt).attr('data-membership_basic_addon_id');   
        
        var sactpackage = "Basic";
        //var sactpackage = "Addon";
        if(tp==0)
            sactpackage = "Addon";
        // put panel-collapse
        // row activity
        
        $(this.tnrmbrModelUpdate).find('form')[0].reset();
        
        var panel_panel_collapse = $(relatedTrgt).closest('.panel.panel-collapse');
        
        //$('.tnr-widget-mbr .tnrmbr-update').find(".panel.panel-collapse").eq(0).find(".panel-heading .panel-title a").html()
        var atab = $(panel_panel_collapse).find(".panel-heading .panel-title a").html();
        // cltitle
        $(this.tnrmbrModelUpdate).find('.modal-content > .modal-body').find('h3.cltitle').html(atab);
        
        var row_activity = $(relatedTrgt).closest('.row.activity').clone();
        
        $(this.tnrmbrModelUpdate).find('.modal-content > .modal-body').find('.activity-dtl').html('');
        $(this.tnrmbrModelUpdate).find('.modal-content > .modal-body').find('.activity-dtl').html(row_activity);
        //$(this.tnrmbrModelUpdate).find('.modal-content > .modal-body').find('.activity-dtl').find('.seqno').parent().hide();
        $(this.tnrmbrModelUpdate).find('.modal-content > .modal-body').find('.activity-dtl').find('button.updateactivity').parent().hide();
        
        
        //$(this.tnrmbrModelUpdate).find('.modal-content > .modal-body').find('h2.f-400').hide();
        /*
        <input type="hidden" name="sbasicactivityid" id="sbasicactivityid" value=""/>
                            <input type="hidden" name="sbasactmembershipid" id="sbasactmembershipid" value=""/>
                            <input type="hidden" name="sactpackage" id="sactpackage" value=""/>
        if(skipingpackage=='Basic'){
                        $( '#skipconsultantform' ).attr( 'action',_site_url + 'membershipbasicactivity/completecancelskipact' )
                    }else if(skipingpackage=='Addon'){
                        $( '#skipconsultantform' ).attr( 'action',_site_url + 'membershipaddonactivity/completecancelskipact' )
                    }
        */
        
        if(tp==1)
            $(this.tnrmbrModelUpdate).find('.modal-content > .modal-body').find('#skipconsultantform').attr( 'action',this.baseURL + 'membershipbasicactivity/completecancelskipact' );
        else
            $(this.tnrmbrModelUpdate).find('.modal-content > .modal-body').find('#skipconsultantform').attr( 'action',this.baseURL + 'membershipaddonactivity/completecancelskipact' );
        
        $(this.tnrmbrModelUpdate).find('.modal-content > .modal-body').find('#sbasicactivityid').val(id);
        $(this.tnrmbrModelUpdate).find('.modal-content > .modal-body').find('#sbasactmembershipid').val(membership_id);
        $(this.tnrmbrModelUpdate).find('.modal-content > .modal-body').find('#sactpackage').val(sactpackage);
        
        

        var ajaxFormOptionsActivityUpdate = _this.getAjaxFormOptionsTnrmbrActivityUpdate();
        
        $(this.tnrmbrModelUpdate).find('form').ajaxForm(ajaxFormOptionsActivityUpdate);
        
        
        
        console.log("---tnrmbrLoadModalActivity-----------------------------2--");
    };
      
    Sgbz.tnrmbrDisplayCourseActivity = function(activitybox, activity, tp, i)
    {
        console.log("---tnrmbrDisplayCourseActivity-----------------------------1--");
        var _this = this;
        
        var activitymain = activity.activitymain;
        var designation = activity.designation;
        var user = activity.user;
        var duration = activity.duration;
        var skipstatus = activity.skipstatus;
        var starttime = activity.starttime;
        
        $(activitybox).find("span.seqno").text((i+1)+".)");
        $(activitybox).find("span.act-ttl").text(activitymain.name);
        $(activitybox).find("span.drn").text(this.convertTime(duration));
        
        // start-datetime
        // designation
        // consultant
        // skipstatus
        // 
        //$(activitybox).find("span.start-datetime").text(starttime);
        $(activitybox).find("span.start-datetime").text(moment(startdate).format("MMM DD hh A"));
        
        if(designation != undefined && designation != null)
        {
            $(activitybox).find("span.designation").text(designation.name);
        }
        if(user != undefined && user != null)
        {
            $(activitybox).find("span.consultant").text(user.fullname);
        }
        else
        {
            $(activitybox).find("span.consultant").text('No Consultant');
        }
        
        $(activitybox).find("span.skipstatus").text(skipstatus);
        
        // updateactivity
        // button
        var updateactivity_button = $(activitybox).find("button.updateactivity");
        // membership_basic_id : 27 membership_id : 28
        $(updateactivity_button).attr('data-id',activity.id);
        $(updateactivity_button).attr('data-tp',tp);
        $(updateactivity_button).attr('data-activity_id',activity.activity_id);
        $(updateactivity_button).attr('data-membership_id',activity.membership_id);
        if(tp==1)
            $(updateactivity_button).attr('data-membership_basic_addon_id',activity.membership_basic_id);
        else
            $(updateactivity_button).attr('data-membership_basic_addon_id',activity.membership_addon_id);
        console.log("---tnrmbrDisplayCourseActivity-----------------------------2--");
    };
    
    Sgbz.tnrmbrDisplayCourseActivities = function(coursebox, course, activities, tp)
    {
        console.log("---tnrmbrDisplayCourseActivities-----------------------------1--");
        var _this = this;
        
        var tnrmbr_act_list_panel_body = $(coursebox).find('.tnrmbr-act-list .panel-body');
        //$(tnrmbr_act_list_panel_body).find('.activity').eq(1).remove();
        $(tnrmbr_act_list_panel_body).find('.activity').not(':first').remove();
                
        
        if(activities != undefined && activities != null && activities.length>0)
        {
            
            var i = 0;
            var n = activities.length;
            var activitybox;
            for(;i<n;i++)
            {
                activitybox = $(tnrmbr_act_list_panel_body).find('.activity').eq(0).clone();
                $(tnrmbr_act_list_panel_body).append(activitybox);
                
                this.tnrmbrDisplayCourseActivity(activitybox, activities[i],tp,i);
            }
            
            $(tnrmbr_act_list_panel_body).find('.activity').eq(0).remove();
        }        
        console.log("---tnrmbrDisplayCourseActivities-----------------------------2--");
    };
    
    Sgbz.tnrmbrDisplayCourse = function(course, tp)
    {
        console.log("---tnrmbrDisplayCourse-----------------------------1--");
        var _this = this;
        
        var membership_course = course.membership_course;
        
        if(membership_course != undefined && membership_course != null)
        {
            
        }
        var coursebox = $(this.tnrmbrBoxUpdateTabbox).find('.panel.panel-collapse').eq(0).clone();
        $(this.tnrmbrBoxUpdateTabbox).append(coursebox);
        
        var phid = "course-hd-"  + course.id + "-" + course.course_id + "-" + tp;
        var hrefid = "course-"  + course.id + "-" + course.course_id + "-" + tp;
        
        var panel_heading = $(coursebox).find('.panel-heading');
        $(panel_heading).attr('id',phid);
        var panel_title = $(panel_heading).find('.panel-title a');
        
        
        $(panel_title).attr('href',"#"+hrefid);
        // aria-controls="collapseOne"
        $(panel_title).attr('aria-controls',hrefid);
        $(panel_title).find('span.ttl').text(membership_course.coursename);
        $(panel_title).find('span.dts').text(moment(course.startdate).format("MMM DD")  + " / " + moment(course.enddate).format("MMM DD") + "(" + course.duration + " Days)" );
              
        
        // tnrmbr-act-list
        var tnrmbr_act_list = $(coursebox).find('.tnrmbr-act-list');
        $(tnrmbr_act_list).attr('id',hrefid);
        // aria-labelledby="headingOne"
        $(tnrmbr_act_list).attr('aria-labelledby',phid);
        
        
        // remove all activities except one
        if(course.membership_activities != undefined && course.membership_activities != null && course.membership_activities.length>0)
        {    
            
            this.tnrmbrDisplayCourseActivities(coursebox, course, course.membership_activities,tp);
            
        }
                
        console.log("---tnrmbrDisplayCourse-----------------------------2--");
    };
    
    Sgbz.tnrmbrDisplayCoursesClean = function()
    {
        console.log("---tnrmbrDisplayCoursesClean-----------------------------1--");
        var _this = this;
        
        $(this.tnrmbrBoxUpdateTabbox).find('.panel.panel-collapse').not(':first').remove();
        
        console.log("---tnrmbrDisplayCoursesClean-----------------------------2--");
    };
    
    Sgbz.tnrmbrDisplayCoursesCleanLast = function()
    {
        console.log("---tnrmbrDisplayCoursesCleanLast-----------------------------1--");
        var _this = this;
        
        $(this.tnrmbrBoxUpdateTabbox).find('.panel.panel-collapse').eq(0).remove();
        
        console.log("---tnrmbrDisplayCoursesCleanLast-----------------------------2--");
    };
    
    Sgbz.tnrmbrDisplayCourses = function(courses, tp)
    {
        console.log("---tnrmbrDisplayCourses-----------------------------1--");
        var _this = this;
        
        if(courses != undefined && courses != null && courses.length>0)
        {
            
            // remove all courses except one
            // .tnr-widget-mbr .tnrmbr-update
            //$(this.tnrmbrBoxUpdateTabbox).find('.panel.panel-collapse').eq(1).remove();
            //$(this.tnrmbrBoxUpdateTabbox).find('.panel.panel-collapse').eq(2).remove();
            //$(this.tnrmbrBoxUpdateTabbox).find('.panel.panel-collapse').not(':first').remove();
            // $(html).not(':first').remove();
            
            
            var i = 0;
            var n = courses.length;
            for(;i<n;i++)
            {
                this.tnrmbrDisplayCourse(courses[i],tp);
                //this.tnrmbrDisplayCourse(courses[i].membership_course,tp);
                //if(courses[i].membership_activities != undefined && courses[i].membership_activities != null && courses[i].membership_activities.length>0)
                //    this.tnrmbrDisplayCourseActivities(courses[i].membership_activities,tp);
            }
            
            //$(this.tnrmbrBoxUpdateTabbox).find('.panel.panel-collapse').eq(0).remove();
        }
                
        console.log("---tnrmbrDisplayCourses-----------------------------2--");
    };
    
    Sgbz.tnrmbrLoadCourseActivities = function()
    {
        console.log("---tnrmbrLoadCourseActivities-----------------------------1--");
        var _this = this;
        
        if(this._tnr_mbr == null)
        {
            this.notify("Please select member first",'warning');
            return;
        }
        
        // _this._tnr_mbr.value;
        
                var controller = 'membership/';
                $.ajax({
                        method: "GET",
                        url: _this.baseURL + controller + "membercourseacctivitylist/"+_this._tnr_mbr.value,
                        //data: dataConfig,
                    }).done( function( data, textStatus, jqXHR ) {
                        console.log( " ajax done " );
                        console.log( data, textStatus, jqXHR );                    

                        if(data.status == 1)
                        {
                            //_this.fillTableCourseActivityLines('courseactivitylines-table',data.data);
                            
                            _this.tnrmbrDisplayCoursesClean();
                            
                            // membership_basic
                            if(data.membership_basic != undefined && data.membership_basic != null && data.membership_basic.length>0)
                                _this.tnrmbrDisplayCourses(data.membership_basic,1);
                            // membership_addon
                            if(data.membership_addon != undefined && data.membership_addon != null && data.membership_addon.length>0)
                                _this.tnrmbrDisplayCourses(data.membership_addon,0);
                            
                            _this.tnrmbrDisplayCoursesCleanLast();
                        }    
                        else
                        {

                        }

                    }).fail( function( jqXHR, textStatus, errorThrown ) {
                        console.log( " ajax fail " );
                        console.log( jqXHR, textStatus, errorThrown );
                    }).always ( function( data_jqXHR, textStatus, jqXHR_errorThrown ) {
                        console.log( " ajax always " );
                        console.log( data_jqXHR, textStatus, jqXHR_errorThrown );
                    });        
        
        console.log("---tnrmbrLoadCourseActivities-----------------------------2--");
    };
    
    Sgbz.tnrmbrLoadAppointments = function()
    {
        console.log("---tnrmbrLoadAppointments-----------------------------1--");
        var _this = this;
        
        if(this._tnr_mbr == null)
        {
            this.notify("Please select member first",'warning');
            return;
        }
        
        
        
        console.log("---tnrmbrLoadAppointments-----------------------------2--");
    };
    
    Sgbz.tnrmbrMbrTabInitClick = function()
    {
        console.log("---tnrmbrMbrTabInitClick-----------------------------1--");
        var _this = this;
        console.log(_this._tnr_tab_id);    
        switch(_this._tnr_tab_id) {
                case '#tnrmbr-tab1':
                    //this.commomModelBoxTnrmbrInitBC();
                    break;
                case '#tnrmbr-tab2':
                    this.tnrmbrLoadCourseActivities();
                    // load course activities
                    break;
                case '#tnrmbr-tab3':
                    this.tnrmbrLoadAppointments();
                    // load course appointments
                    break;
                default:
                    //default code block
            }
            
        console.log("---tnrmbrMbrTabInitClick-----------------------------2--");
    };
    
    Sgbz.tnrmbrMbrTabInit = function()
    {
        console.log("---tnrmbrMbrTabInit-----------------------------1--");
        var _this = this;
            
        $(this.tnrmbrBoxTaba).on('shown.bs.tab', function (e) {
            console.log("---tnrmbrMbrTabInit-----------------------------1-shown.bs.tab-");
            _this._tnr_tab_id = $(e.target).attr("href") // activated tab
            console.log(_this._tnr_tab_id);
            _this.tnrmbrMbrTabInitClick();
        });
            
        console.log("---tnrmbrMbrTabInit-----------------------------2--");
    };
    
    Sgbz.tnrmbrInit = function()
    {
        console.log("---tnrmbrInit-----------------------------1--");
        var _this = this;
        
        this.tnrmbrMbrSrchInit();
        this.tnrmbrMbrFrmOpenInit();
        
        _this.initBlankModalTnrmbr();
        _this.initBlankModalTnrmbrActivity();
        
        this.tnrmbrMbrTabInit();
        
        console.log("---tnrmbrInit-----------------------------2--");
    };    
    return Sgbz;
})(jQuery, Sgbz || {});
/**********Trainer Widget End *******************************************************/