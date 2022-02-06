
var MyDateField = function (config) {
    console.log('MyDateField');
    this.dateFormat = "yy-mm-dd";
    console.log(config);
    jsGrid.Field.call(this, config);
};

MyDateField.prototype = new jsGrid.Field({
    autosearch: true,
    sorter: function (date1, date2) {
        return new Date(date1) - new Date(date2);
    },
    itemTemplate: function (value) {
        console.log('itemTemplate');
        console.log(value);
        return new Date(value).toDateString();
    },
    insertTemplate: function (value) {
        console.log('insertTemplate');
        return this._insertPicker = $("<input>").datepicker({defaultDate: new Date(), dateFormat:"yy-mm-dd"});
    },
    editTemplate: function (value) {
        console.log('editTemplate');
        return this._editPicker = $("<input>").datepicker().datepicker("setDate", new Date(value));
    },
    filterTemplate: function () {
        console.log('filterTemplate');
        return this._filterPicker = $("<input>").datepicker({defaultDate: new Date(), dateFormat:"yy-mm-dd"});
    },
    insertValue: function () {
        console.log('insertValue');        
        return this._insertPicker.datepicker("getDate").toISOString();
    },
    editValue: function () {
        console.log('editValue');
        return this._editPicker.datepicker("getDate").toISOString();
    },
    formatDateValue : function(dateVal)
    {
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
    },
    filterValue: function() {
        console.log('filterValue');        
        console.log(this._filterPicker);
        var dateVal = this._filterPicker.datepicker("getDate");
        console.log(dateVal);
        // return dateVal.toISOString();
        if(dateVal != null)
            return Sgbz.formatDateValue(dateVal);
        else
            return '';
        //return this.filterControl.val();
    }
});

jsGrid.fields.myDateField = MyDateField;

var DataController = {
    bulkDelete : 0, // 0 : No, 1, Yes
    deleteFrom: 0, // 0 : single, 1 : bulk
    //itemIndex: 0,
    selectedItems: [],
    editController:null,
    db: {
        type: [
            {'id': '', 'name': 'All'},
            {'id': 'C', 'name': 'Customer'},
            {'id': 'M', 'name': 'Maverick'},
        ],
        basicstatus: [
            {'id': '', 'name': 'All'},
            {'id': 'I', 'name': 'InActive'},
            {'id': 'A', 'name': 'Active'},
            {'id': 'C', 'name': 'Close'},
            {'id': 'CL', 'name': 'Cancel'},
        ],
        status: [
            {'id': '', 'name': 'All'},
            {'id': '0', 'name': 'InActive'},
            {'id': '1', 'name': 'Active'},
        ],
        status_int: [
            {'id': '', 'name': 'All'},
            {'id': 0, 'name': 'InActive'},
            {'id': 1, 'name': 'Active'},

            //{'id': '2', 'name': 'Soft Delete'},
            //{'id': '3', 'name': 'Soft Hard'},
        ], 
        // array('P' => 'Planned', 'H' => 'Held', 'NH' => 'NotHeld', 'C' => 'Close');
        actions: [
            {'id': '', 'name': 'All'},
            {'id': 'P', 'name': 'Planned'},
            {'id': 'H', 'name': 'Held'},
            {'id': 'NH', 'name': 'NotHeld'},
            {'id': 'C', 'name': 'Close'},
        ],    
        // array('C' => 'Call', 'M' => 'Mail', 'ME' => 'Meeting');     
        followups: [
            {'id': '', 'name': 'All'},
            {'id': 'C', 'name': 'Call'},
            {'id': 'M', 'name': 'Mail'},
            {'id': 'ME', 'name': 'Meeting'},
        ], 
        // '2' => 'Held', '3' => 'NotHeld', '4' => 'Cancelled', '5' => 'Closed'
        apt_status_int: [
            {'id': '', 'name': 'All'},
            {'id': 0, 'name': 'InActive'},
            {'id': 1, 'name': 'Active'},
            {'id': 2, 'name': 'Held'},
            {'id': 3, 'name': 'NotHeld'},
            {'id': 4, 'name': 'Cancelled'},
            {'id': 5, 'name': 'Closed'},
        ], 
    },
    config: {
        container: '#jsGrid',
        loadURL: null,
        insertURL: null,
        updateURL: null,
        deleteURL: null,
        height: '300px',
        width: '100%',
        filtering: true,
        inserting: true,
        editing: true,
        addMode:2, // 0:inline,1:pupup,2,new tab default : 2
                        // inserting must be false for new tab adding 
        editMode:2, // 0:inline,1:pupup,2,new tab default : 2
                        // editing must be false for new tab editing
        detailMode:1, // 0 : popup, 1, new tab, 2: mouseover pop like tooltip default : 1
        sorting: true,
        paging: true,
        autoload: true,
        autosearch: true,
        pageLoading: true,
        pageSize: 10,
        pageButtonCount: 5,
        confirmDeleting: false,
        deleteConfirm: "Do you really want to delete?",
        deleteConfirmAll: "Do you really want to 'Delete' all selected items?",
        onItemDeleting: function (args) {
            // cancel deletion of the item with 'protected' field
            //if(args.item.protected) {
            //args.cancel = true;
            //}
            //if (DataController.deleteFrom == 0 && !confirm(DataController.config.deleteConfirmAll))
            //    args.cancel = true;
            if(DataController.deleteFrom == 0)
            {
                if(!confirm(DataController.config.deleteConfirm))
                    args.cancel = true;
            }
            else
            {
                //if(!confirm(DataController.config.deleteConfirmAll))
                //    args.cancel = true;
            }
        },
        /*
        onItemUpdating: function (args) {
            console.log('--onItemUpdating--');
            
            // cancel update of the item with empty 'name' field
            //if(args.item.name === "") {
            //    args.cancel = true;
            //    alert("Specify the name of the item!");
            //}
        },
        editRowRenderer: function(item, itemIndex){
            console.log('--editRowRenderer--');
            console.log(item, itemIndex);
            //$(DataController.config.container).jsGrid("cancelEdit");
            //$(DataController.config.container).jsGrid("insertItem", item).done(function() {
            //    console.log("insertion completed");
            //});
            //return;
        },
        
        rowClick: function(args){
            console.log('--rowClick--');
            console.log(args);
        },
        */
        onRefreshed: function(grdObj){
            console.log('--onRefreshed--');
            var grdData = $(DataController.config.container).jsGrid("option", "data");
            
                // edting in new tab
                if(!DataController.config.editing && DataController.config.editMode==2)
                {
                    $(DataController.config.container).find("input[type=button][title=Edit].jsgrid-edit-button").each(function(idx){
                        console.log("#jsGrid2.jsgrid input[type=button][title=Edit].jsgrid-edit-button");
                        var $eb1 = $(this);
                        console.log($eb1);
                        $(this).on("click", function () {
                            var $eb = $(this);                        
                            var rowItem = $($eb).closest('tr');
                            console.log(rowItem);
                            var gridRows = $(DataController.config.container + ' .jsgrid-grid-body .jsgrid-table tr');
                            console.log(gridRows);
                            var editRowIdx = $(gridRows).index( rowItem );
                            console.log(editRowIdx);
                            var grdData = $(DataController.config.container).jsGrid("option", "data");
                            console.log(grdData);
                            var rowGridData = grdData[editRowIdx];
                            console.log(rowGridData);
                            //$(DataController.config.container).jsGrid("option", $cb.attr("id"), $cb.is(":checked"));

                            // editURL
                            DataController.openEditWindow(rowGridData);

                        });
                    });
                }
                // for detail
                // jsgrid-button glyphicon glyphicon-open
                // View Detail
                // detail in new tab
                if(DataController.config.detailMode==1)
                {
                    $(DataController.config.container).find("input[type=button].glyphicon-open.viewdetail").each(function(idx){

                        var $eb1 = $(this);
                        console.log($eb1);
                        $(this).on("click", function () {
                            var $eb = $(this);                        
                            var rowItem = $($eb).closest('tr');
                            console.log(rowItem);
                            var gridRows = $(DataController.config.container + ' .jsgrid-grid-body .jsgrid-table tr');
                            console.log(gridRows);
                            var editRowIdx = $(gridRows).index( rowItem );
                            console.log(editRowIdx);
                            var grdData = $(DataController.config.container).jsGrid("option", "data");
                            console.log(grdData);
                            var rowGridData = grdData[editRowIdx];
                            console.log(rowGridData);
                            //$(DataController.config.container).jsGrid("option", $cb.attr("id"), $cb.is(":checked"));

                            // editURL
                            DataController.openDetailWindow(rowGridData);

                        });
                    });      
                }
        },
        fields: [
            //{ name: "Name", type: "text", width: 150 },
            //{ title: "Name", name: "name", type: "text", width: 50 ,valueField: "name", textField: "Name"},
            //{ title: "Address", name: "address", type: "text", width: 200 ,valueField: "address", textField: "Address" },
            //{ name: "Country", type: "select", items: db.countries, valueField: "Id", textField: "Name" },
            //{ name: "Married", type: "checkbox", title: "Is Married", sorting: false },
            {type: "control",
                //*
                headerTemplate: function() {                    
                    if(DataController.config.addMode == 2)
                    {
                        return $("<button>").attr("type", "button").text("Add").attr('title','Add New')
                                .on("click", function () {
                                    //showDetailsDialog("Add", {});
                                    DataController.openAddWindow();
                                });
                    }
                },
                //*/
            }
        ]
    },
    checkInArray: function (item, arrayItems)
    {
        console.log(arrayItems);
        console.log(item);
        var flg = false, currItem, idx;
        for (idx in arrayItems)
        {
            currItem = arrayItems[idx];
            if (currItem.id == item.id)
            {
                flg = true;
                break;
            }
        }
        console.log(flg);
        return flg;
    },
    selectItem: function (item) {
        //if(!$.inArray(item,this.selectedItems))
        if (!this.checkInArray(item, this.selectedItems))
            this.selectedItems.push(item);
    },
    unselectItem: function (item) {
        console.log(this.selectedItems);
        this.selectedItems = $.grep(this.selectedItems, function (i) {
            return i !== item;
        });
        console.log(this.selectedItems);
    },
    deleteSelectedItems: function () {
        if (!this.selectedItems.length || !confirm(this.config.deleteConfirmAll))
            return;

        var $grid = $(this.config.container);
        this.deleteFrom = 1;
        console.log(this.selectedItems);
        $.each(this.selectedItems, function (_, item) {
            $grid.jsGrid("deleteItem", item);
        });
        this.deleteFrom = 0;
        this.selectedItems = [];
        $(this.config.container).jsGrid("render").done(function () {
            console.log("rendering completed and data loaded");
        });
    },
    initGrid: function (config)
    {
        if(config.addMode == 2 || this.config.addMode == 2)
        {
            config.inserting = false;
        }
        if(config.editMode == 2 || this.config.editMode == 2)
        {
            config.editing = false;
        }
        $.extend(this.config, config);

        this.config.controller = {
            loadData: function (filters) {
                //DataController.itemIndex = 1;
                console.log(filters);
                var d = $.Deferred();
                $.ajax({
                    type: "GET",
                    url: config.loadURL,
                    data: filters,
                    dataType: "json"
                }).done(function (response) {
                    console.log(response);
                    d.resolve(response);
                });
                return d.promise();
            },
            /*
             loadData: function(filter) {
             return $.ajax({
             type: "GET",
             url: "/items",
             data: filter,
             dataType: "json"
             });
             },
             */

            insertItem: function (item) {
                console.log(item);
                return $.ajax({
                    type: "POST",
                    url: config.insertURL,
                    data: item,
                    dataType: "json"
                }).done(function (response) {
                    console.log(response);
                    //$(DataController.config.container).jsGrid("refresh");
                    if(response.status == "1")
                    {
                        $(DataController.config.container).jsGrid("render").done(function() {
                            console.log("rendering completed and data loaded after update record");
                        });
                    }
                    else
                    {
                        
                    }
                });
            },
            updateItem: function (item) {
                console.log(item);
                /*
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                */
                return $.ajax({
                    type: "PUT",
                    url: config.updateURL + '/' + item.id,
                    data: item,
                    dataType: "json"
                }).done(function (response) {
                    console.log(response);
                    //$(DataController.config.container).jsGrid("refresh");
                    if(response.status == "1")
                    {
                        $(DataController.config.container).jsGrid("render").done(function() {
                            console.log("rendering completed and data loaded after update record");
                        });
                    }
                    else
                    {
                        
                    }
                });
            },
            deleteItem: function (item) {
                //var d = $.Deferred();
                //return d.promise();                
                //return true;
                // $("#grid").jsGrid("refresh");
                return $.ajax({
                    type: "DELETE",
                    url: config.deleteURL,
                    data: item,
                    dataType: "json"
                }).done(function (response) {
                    console.log(response);
                    $(DataController.config.container).jsGrid("refresh");
                });
           },
        };
        
        
        if(config.bulkDelete == 1)
        {
            this.bulkDelete = 1;
        }
        //console.log(this.config);
        var fieldList;
        if(this.bulkDelete == 1)
        {
            fieldList = [
                {
                    headerTemplate: function () {
                        return $("<button>").attr("type", "button").text("Delete").attr('title','Bulk Delete Selected')
                                .on("click", function () {
                                    DataController.deleteSelectedItems();
                                    console.log('deleteSelectedItems');
                                });
                    },
                    itemTemplate: function (_v, item) {
                        //console.log(_v, item);
                        var pageIndex = $(DataController.config.container).jsGrid("option", "pageIndex");
                        var pageSize = $(DataController.config.container).jsGrid("option", "pageSize");
                        var startPage = ( pageIndex - 1 ) * pageSize;
                        var itemIndex = $.inArray(item, $(DataController.config.container).jsGrid("option", "data"));
                        //I see. In the itemTemplate you have access to item (but not index). To get index you could call 
                        //$.inArray(item, $grid.jsGrid("option", "data")) 
                        var idBox = $('<span style="float:left;">' + (startPage + itemIndex + 1) + '.) </span>');
                        var checkbox = $('<input style="float:right;margin: 3px 20px;">').attr("type", "checkbox").attr("name", "checkbox-" + item.id).attr("value", item.id)
                                .on("change", function () {
                                    if ($("#content .filtering-options input[type=checkbox][id=editing]").is(":checked"))
                                    {
                                        alert('First uncheck "Editing" option on top.');
                                        $(this).prop('checked', false);
                                    }
                                    else
                                        $(this).is(":checked") ? DataController.selectItem(item) : DataController.unselectItem(item);
                                });                                 
                        //DataController.itemIndex++;
                        return $(idBox).append(checkbox);
                        //return (startPage + itemIndex + 1) + '.) ' + checkbox;
                        //return $(idBox).html() + $(checkbox);       
                        //return $(checkbox).appendTo($(idBox));  

                    },
                    align: "center",
                    //width: 60,
                    //filtering: false,
                    //inserting: false,
                    //editing: false,
                    //sorting: false,
                },
            ];            
        }
        else
        {
            fieldList = [
                {
                    headerTemplate: function () {
                        return $("<span>").text("Sr. No.").attr('title','Sr. No.');
                    },
                    itemTemplate: function (_v, item) {
                        //console.log(_v, item);
                        var pageIndex = $(DataController.config.container).jsGrid("option", "pageIndex");
                        var pageSize = $(DataController.config.container).jsGrid("option", "pageSize");
                        var startPage = ( pageIndex - 1 ) * pageSize;
                        var itemIndex = $.inArray(item, $(DataController.config.container).jsGrid("option", "data"));
                        //I see. In the itemTemplate you have access to item (but not index). To get index you could call 
                        //$.inArray(item, $grid.jsGrid("option", "data")) 
                        var idBox = $('<span style="">' + (startPage + itemIndex + 1) + '.) </span>');
                        var checkbox = $('<input style="float:right;margin: 3px 20px;">').attr("type", "hidden").attr("name", "checkbox-" + item.id).attr("value", item.id)
                                .on("change", function () {
                                    if ($("#content .filtering-options input[type=checkbox][id=editing]").is(":checked"))
                                    {
                                        alert('First uncheck "Editing" option on top.');
                                        $(this).prop('checked', false);
                                    }
                                    else
                                        $(this).is(":checked") ? DataController.selectItem(item) : DataController.unselectItem(item);
                                });
                        //DataController.itemIndex++;
                        
                        return $(idBox).append(checkbox);
                        //return (startPage + itemIndex + 1) + '.) ' + checkbox;
                        //return $(idBox).html() + $(checkbox);       
                        //return $(checkbox).appendTo($(idBox));  

                    },
                    align: "center",
                    //width: 60,
                    //filtering: false,
                    //inserting: false,
                    //editing: false,
                    //sorting: false,
                },
            ];             
        }

        

        $.merge(fieldList, config.fieldList);
        $.merge(fieldList, this.config.fields);
        
        
        
        // load data from AJAX
        /*****************************************/
        /*
        var idxF,fieldF;
        for(idxF in fieldList)
        {
            fieldF = fieldList[idxF];
            //console.log(fieldF);
            if(fieldF.type == 'select' && fieldF.remote == true && fieldF.url != '')
            {
                console.log(fieldF.type , fieldF.remote , fieldF.url);
                
            }
            
        }
        */
        /*****************************************/
        
        this.config.fields = fieldList;

        //console.log(this.config.fields);

        $(this.config.container).jsGrid(this.config);


    },

    openEditWindow: function(rowSelectedData){
        var rowSelecedId = rowSelectedData.id;
        this.openWindow(DataController.config.editURL + rowSelecedId);
    },
    
    openDetailWindow: function(rowSelectedData){
        var rowSelecedId = rowSelectedData.id;
        this.openWindow(DataController.config.detailURL + rowSelecedId);
    },
    
    openAddWindow: function(){
        this.openWindow(DataController.config.addURL);
    },
    
    openWindow: function(url){
        var win = window.open(url, '_self');
        win.focus();
    },    
    
};


