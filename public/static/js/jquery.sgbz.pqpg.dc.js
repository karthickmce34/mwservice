;(function($, Sgbz) {
    var
        gridObj = null,
        db = {
            status: [

                {'id': '', 'name': 'All'},
                {'id': '0', 'name': 'InActive'},
                {'id': '1', 'name': 'Active'},

                //{'id': '2', 'name': 'Soft Delete'},
                //{'id': '3', 'name': 'Soft Hard'},
            ],
            status_int: [

                {'id': '', 'name': 'All'},
                {'id': 0, 'name': 'InActive'},
                {'id': 1, 'name': 'Active'},

                //{'id': '2', 'name': 'Soft Delete'},
                //{'id': '3', 'name': 'Soft Hard'},
            ],  
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
        pgConfig = {
            container: '#jsGrid',
            loadURL: null,
            insertURL: null,
            updateURL: null,
            deleteURL: null,
            height: 500,
            //width: '800px',
            filtering: true,
            inserting: true,
            editing: true,
            deleting: true,
            addMode:2, // 0:inline,1:pupup,2,new tab default : 2
            editMode:2, // 0:inline,1:pupup,2,new tab default : 2
            detailMode:1, // 0 : popup, 1, new tab, 2: mouseover pop like tooltip default : 1
            deleteMode:1, // 0 : popup, 1, new tab, default : 0
           
            location: 'remote',
            sorting: 'remote',

            // PQ grid config start here
            //wrap: true,
            //hwrap: true,
            virtualX: true,
            virtualY: true,
            hwrap: false,
            resizable: true,
            //bootstrap: { on: true },
            //columnBorders: false,
            stripeRows: true,
            numberCell: { show: true, title: "#", align: 'center', halign: 'center',minHeight: 50,},
            track: true, //to turn on the track changes.
            flexHeight: true,
            /*
            toolbar: {
                items: [
                    { type: 'button', icon: 'ui-icon-plus', label: 'Add New', listener:
                        { "click": function (evt, ui) {
                                var grid = $(this).closest('.pq-grid').pqGrid('getInstance').grid;
                                addRow(grid);
                            }
                        }
                    }
                ]
            },
            */
            //scrollModel: { theme: true, autoFit: true },     
            scrollModel: {
                //lastColumn: ''
            },
            freezeCols:1,
            selectionModel: { type: 'cell', mode: 'single' },
            filterModel: { mode: 'OR', type: "remote", header: true},
            editor: { type: 'textbox', select: true, style: 'outline:none;' },
            validation: {
                icon: 'ui-icon-info'
            },
            title: "<b>Model</b>",
           
            /*
            colModel: [
                    { title: "Product ID", dataType: "integer", dataIndx: "ProductID", editable: false, width: 80 },
                    { title: "Product Name", width: 165, dataType: "string", dataIndx: "ProductName",
                        validations: [
                            { type: 'minLen', value: 1, msg: "Required" },
                            { type: 'maxLen', value: 40, msg: "length should be <= 40" }
                        ]
                    },
                    { title: "Quantity Per Unit", width: 140, dataType: "string", align: "right", dataIndx: "QuantityPerUnit",
                        validations: [
                            { type: 'minLen', value: 1, msg: "Required." },
                            { type: 'maxLen', value: 20, msg: "length should be <= 20" }
                        ]
                    },
                    { title: "Unit Price", width: 100, dataType: "float", align: "right", dataIndx: "UnitPrice",
                        validations: [{ type: 'gt', value: 0.5, msg: "should be > 0.5"}],
                        render: function (ui) {
                            return (ui.cellData != null) ? "$" + parseFloat(ui.cellData).toFixed(2) : "";
                        }
                    },
                    { title: "Units In Stock", width: 100, dataType: "integer", align: "right", dataIndx: "UnitsInStock",
                        validations: [{ type: 'gte', value: 1, msg: "should be >= 1"}]
                    },
                    { title: "Units On Order", dataType: "integer", hidden: true, dataIndx: "UnitsOnOrder",
                        validations: [{ type: 'gte', value: 0, msg: "should be >= 0"}]
                    },
                    { title: "Discontinued", width: 100, dataType: "bool", align: "center", dataIndx: "Discontinued",
                        editor: false,
                        type: 'checkbox',
                        validations: [{ type: 'nonEmpty', msg: 'True or False'}]
                    },
                    { title: "", editable: false, minWidth: 165, sortable: false,
                        render: function (ui) {
                            return "<button type='button' class='edit_btn'>Edit</button>\
                                <button type='button' class='delete_btn'>Delete</button>";
                        },
                        postRender: function (ui) {
                            var rowIndx = ui.rowIndx,
                                grid = this,
                                $cell = grid.getCell(ui);

                            //delete button
                            $cell.find(".delete_btn").button({ icons: { primary: 'ui-icon-close'} })
                            .bind("click", function (evt) {
                                deleteRow(rowIndx, grid);
                            });

                            //edit button
                            $cell.find(".edit_btn").button({ icons: { primary: 'ui-icon-pencil'} })
                            .bind("click", function (evt) {
                                if (isEditing(grid)) {
                                    return false;
                                }
                                editRow(rowIndx, grid, true);
                            });

                            //if it has edit class, then edit the row.
                            if (grid.hasClass({ rowData: ui.rowData, cls: 'pq-row-edit' })) {
                                editRow(rowIndx, grid);
                            }
                        }
                    }
            ],
            */
            postRenderInterval: -1, //synchronous post rendering.
            /*
            dataModel: {
                dataType: "JSON",
                location: "remote",
                recIndx: "ProductID",
                url: "/pro/products/getP",
                //url: "/pro/products.php",//for PHP
                getData: function (response) {
                    return { data: response.data, curPage: response.curPage, totalRecords: response.totalRecords };
                }
            },
            */
            pageModel: { type: "remote", rPP: 20 },
            /*
            //make rows editable based upon the class.
            editable: function (ui) {
                return this.hasClass({ rowIndx: ui.rowIndx, cls: 'pq-row-edit' });
            },
            create: function (evt, ui) {
                this.widget().pqTooltip();
            }
            */
            editable: false,
            //scrollModel: { horizontal: false },
            showTitle: false,
            columnBorders: true         
        };       
              
        Pqpg = function() {
            this.init();
        };

    // Initialization method
    Pqpg.prototype.init = function() {
        console.log('Pqpg.init');
        this.config = pgConfig;
        this.db = db;
        this.gridObj = gridObj;
    };
   
    Pqpg.prototype.pqpgButton = function() {
        console.log('Pqpg.pqpgButton');
    };   
    Sgbz.Pqpg = new Pqpg();
    return Sgbz;
})(jQuery, Sgbz || {});


;(function($, Sgbz) {
           
    Sgbz.Pqpg.testButton = function() {
        console.log('Sgbz.Pqpg.testButton');
        var _this = this;
        console.log(_this.config);
    };
    return Sgbz;
})(jQuery, Sgbz || {});


/**********SGBZ Grid Start*******************************************************/
;(function($, Sgbz) { 
    Sgbz.Pqpg.deleteItem = function(rowSelectedData,rowIndx){
        var _this = this;
        $(this.config.container).pqGrid( "getInstance" ).grid.addClass({ rowIndx: rowIndx, cls: 'pq-row-delete' });

        var ans = window.confirm("Are you sure to delete row No " + (rowIndx + 1) + "?");
        $(this.config.container).pqGrid( "getInstance" ).grid.removeClass({ rowIndx: rowIndx, cls: 'pq-row-delete' });
        if (ans) {
            // todo delte call : make ajax delete request to delete item
           
            $(this.config.container).pqGrid( "getInstance" ).grid.deleteRow({ rowIndx: rowIndx });
        }       
    };
    Sgbz.Pqpg.openEditWindow = function(rowSelectedData,rowIndx){
        var _this = this;
        var rowSelecedId = rowSelectedData.id;
        this.openWindow(_this.config.editURL + rowSelecedId);
    };
   
    Sgbz.Pqpg.openDetailWindow = function(rowSelectedData,rowIndx){
        var _this = this;
        var rowSelecedId = rowSelectedData.id;
        this.openWindow(_this.config.detailURL + rowSelecedId);
    };
   
    Sgbz.Pqpg.openAddWindow = function(){
        var _this = this;
        this.openWindow(_this.config.addURL);
    };
   
    Sgbz.Pqpg.openWindow = function(url){
        var win = window.open(url, '_self');
        win.focus();
    };    
    /*
    Sgbz.Pqpg.filterhandler = function(evt, ui) {
        var _this = this;
        var gridObj = Sgbz.Pqpg.gridObj; //$(Sgbz.Pqpg.config.container).pqGrid( "getInstance" );
        var $toolbar = gridObj.find('.pq-toolbar-search'),
            $value = $toolbar.find(".filterValue"),
            value = $value.val(),
            condition = $toolbar.find(".filterCondition").val(),
            dataIndx = $toolbar.find(".filterColumn").val(),
            filterObject;
        console.log(condition);   
        console.log(dataIndx);   
        console.log('Sgbz.Pqpg.filterhandler -- 1');   
        if (dataIndx == "") {//search through all fields when no field selected.
            filterObject = [];
            var CM = gridObj.pqGrid("getColModel");
            for (var i = 0, len = CM.length; i < len; i++) {
                var dataIndx = CM[i].dataIndx;
                filterObject.push({ dataIndx: dataIndx, condition: condition, value: value });
            }
        }
        else {//search through selected field.
            filterObject = [{ dataIndx: dataIndx, condition: condition, value: value}];
        }
        console.log(filterObject);
        console.log('Sgbz.Pqpg.filterhandler -- 2');
        gridObj.pqGrid("filter", {
            oper: 'replace',
            data: filterObject
        });
    };
    */
    Sgbz.Pqpg.pqDatePicker = function (ui) {
        var _this = this;
        var $this = $(this);
        $this
            .css({ zIndex: 3, position: "relative" })
            .datepicker({
                yearRange: '-20:+20',// "-20:+0", //20 years prior to present.
                changeYear: true,
                changeMonth: true,
                showButtonPanel: true,
                onClose: function (evt, ui) {
                    $(this).focus();
                },
                dateFormat: "yy-mm-dd"
            });
        //default From date
        $this.filter(".pq-from").datepicker("option", "defaultDate", new Date("yy-mm-dd"));
        //default To date
        $this.filter(".pq-to").datepicker("option", "defaultDate", new Date("yy-mm-dd"));
    };
    Sgbz.Pqpg.pqDatePickerC1P1M = function (ui) { // 1 + and 1 - years       
        var $this = $(this);
        $this
            .css({ zIndex: 3, position: "relative" })
            .datepicker({
                yearRange: "c-1:c+1",// "-20:+0", //20 years prior to present.
                changeYear: true,
                changeMonth: true,
                showButtonPanel: true,
                onClose: function (evt, ui) {
                    $(this).focus();
                },
                dateFormat: "yy-mm-dd"
            });
        //default From date
        $this.filter(".pq-from").datepicker("option", "defaultDate", new Date("yy-mm-dd"));
        //default To date
        $this.filter(".pq-to").datepicker("option", "defaultDate", new Date("yy-mm-dd"));       
    };   
    Sgbz.Pqpg.pqDatePickerDOB = function (ui) {       
        var $this = $(this);       
        $this
            .css({ zIndex: 3, position: "relative" })
            .datepicker({
                //yearRange: "c-10:c+0",// "-20:+0", //20 years prior to present.
                yearRange: "-120:+0",// "-20:+0", //20 years prior to present.
                changeYear: true,
                changeMonth: true,
                showButtonPanel: true,
                onClose: function (evt, ui) {
                    $(this).focus();
                },
                dateFormat: "yy-mm-dd"
            });
        //default From date
        $this.filter(".pq-from").datepicker("option", "defaultDate", new Date("yy-mm-dd"));
        //default To date
        $this.filter(".pq-to").datepicker("option", "defaultDate", new Date("yy-mm-dd"));       
    };
    Sgbz.Pqpg.initPQGrid = function(gridConfig)
    {
        var _this = this;
        console.log('Sgbz.Pqpg.initPQGrid -1');
       
        /*
            filtering: true,
            inserting: true,
            editing: true,
            deleting: true,
       
            addMode:2, // 0:inline,1:pupup,2,new tab default : 2
            editMode:2, // 0:inline,1:pupup,2,new tab default : 2
            detailMode:1, // 0 : popup, 1, new tab, 2: mouseover pop like tooltip default : 1
            deleteMode:1, // 0 : popup, 1, new tab, default : 0      
        */
       
        $.extend(this.config, gridConfig);
             
        console.log('Sgbz.Pqpg.initPQGrid -2');
        if(this.config.inserting)
        {           
            this.config.toolbar = {
               
                cls: "pq-toolbar-search",
                items: [
                    /*
                    { type: "<span style='margin:5px;'>Filter</span>" },
                    { type: 'textbox', attr: 'placeholder="Enter your keyword"', cls: "filterValue", listeners: [{ 'change': _this.filterhandler}] },
                    { type: 'select', style: "margin:0 0 0 5px;", cls: "filterColumn",
                        listeners: [{ 'change': _this.filterhandler}],
                        options: function (ui) {
                            var CM = ui.colModel;
                            var opts = [{ '': '[ All Fields ]'}];
                            for (var i = 0; i < CM.length; i++) {
                                var column = CM[i];
                                var obj = {};
                                obj[column.dataIndx] = column.title;
                                opts.push(obj);
                            }
                            return opts;
                        }
                    },
                    { type: 'select', style: "margin:0px 5px;", cls: "filterCondition",
                        listeners: [{ 'change': _this.filterhandler}],
                        options: [
                        { "begin": "Begins With" },
                        { "contain": "Contains" },
                        { "end": "Ends With" },
                        { "notcontain": "Does not contain" },
                        { "equal": "Equal To" },
                        { "notequal": "Not Equal To" },
                        { "empty": "Empty" },
                        { "notempty": "Not Empty" },
                        { "less": "Less Than" },
                        { "great": "Great Than" }   
                        ]
                    },
                    */
                    { type: 'button', icon: 'ui-button-icon-primary ui-icon-plus', label: 'Add New', listener:
                        { "click": function (evt, ui) {
                                //var grid = $(this).closest('.pq-grid').pqGrid('getInstance').grid;
                                //addRow(grid);
                               
                                if(_this.config.addMode==2)
                                {
                                    _this.openAddWindow();
                                }
                            }
                        }
                    }
                ]
            };
                       
        } // end of inserting
        console.log('Sgbz.Pqpg.initPQGrid -3');
        this.config.dataModel = {
            dataType: "JSON",
            location: this.config.location,
            sorting: this.config.sorting,
            recIndx: "id",
            sortIndx: this.config.sortIndx,
            sortDir: this.config.sortDir,
            url: this.config.loadURL,
            //url: "/pro/products/getP",
            //url: "/pro/products.php",//for PHP
            getData: function (response) {
                console.log(response);
                return { data: response.data, curPage: response.curPage, totalRecords: response.totalRecords };
            }
        };     
        console.log('Sgbz.Pqpg.initPQGrid - 4');
       
        var colModel = [];
        $.merge(colModel, gridConfig.colModel);
        console.log('Sgbz.Pqpg.initPQGrid - 5');
        var colModelTools = [

                    { title: "Actions", minWidth:300, width:300, editable: false, sortable: false, align:'center', halign:'center',
                        render: function (ui) {
                            return "<button type='button' class='edit_btn'>Edit</button>\
                                <button type='button' class='delete_btn'>Delete</button>\
                                <button type='button' class='detail_btn'>View</button>";
                        },
                        postRender: function (ui) {
                            console.log('colModelTools postRender---1-');
                            console.log(this);
                            var rowData = ui.rowData,
                                rowIndx = ui.rowIndx,
                                grid = this,
                                $cell = grid.getCell(ui);

                            //delete button
                            $cell.find(".delete_btn").button({ icons: { primary: 'ui-icon-close'} })
                            .bind("click", function (evt) {
                                console.log('colModelTools postRender---3-');
                                //deleteRow(rowIndx, grid);
                               
                                _this.deleteItem(rowData,rowIndx);
                            });

                            //edit button
                            $cell.find(".edit_btn").button({ icons: { primary: 'ui-icon-pencil'} })
                            .bind("click", function (evt) {
                                console.log('colModelTools postRender---4-');
                                //if (isEditing(grid)) {
                                //    return false;
                                _this.openEditWindow(rowData,rowIndx);
                                //editRow(rowIndx, grid, true);
                            });
                            //detail button
                            $cell.find(".detail_btn").button({ icons: { primary: 'ui-icon-info'} })
                            .bind("click", function (evt) {
                                console.log('colModelTools postRender---5-');
                                //if (isEditing(grid)) {
                                //    return false;
                                //}                               
                                _this.openDetailWindow(rowData,rowIndx);
                                //editRow(rowIndx, grid, true);
                            });

                            //if it has edit class, then edit the row.
                            if (grid.hasClass({ rowData: ui.rowData, cls: 'pq-row-edit' })) {
                                //editRow(rowIndx, grid);
                            }
                            console.log('colModelTools postRender---2-');
                        }
                    }
            ];       
        console.log('Sgbz.Pqpg.initPQGrid -6');
        console.log(colModel);
        if( colModel.length == 0 )
            $.merge(colModel, colModelTools);
        console.log(colModel);
        console.log('Sgbz.Pqpg.initPQGrid -7');
        this.config.colModel = colModel;
       
        //var gridObj = pq.grid("#grid_editing", gridConfigObj);
        //$("#grid_array").pqGrid(obj);
        this.gridObj = $(this.config.container).pqGrid(this.config);
        console.log('Sgbz.Pqpg.initPQGrid -7-1');
        //check the changes in grid before navigating to another page or refresh data.
        //*
        var gridObj = $(this.config.container).pqGrid( "getInstance" ).grid;
        console.log('Sgbz.Pqpg.initPQGrid -7-2');
        gridObj.pager().on("beforeChange beforeRefresh", function (evt, ui) {
            if (gridObj.isDirty()) {
                var ans = window.confirm("There are unsaved changes. Are you sure?");
                if (!ans) {
                    return false;
                }
            }
        });      
        //*/
        console.log('Sgbz.Pqpg.initPQGrid -8');
    };   
    return Sgbz;
})(jQuery, Sgbz || {});
/**********SGBZ Grid End*******************************************************/

/**********Site Holiday Start*******************************************************/
;(function($, Sgbz) { 
   
    Sgbz.Pqpg.getStatus = function(val)
    {
        console.log('Sgbz.Pqpg.getStatus');
        var _this = this;
        var val = val.toString();
        // _this.db.status[value]
        for(var idx in _this.db.status)
        {
            console.log(_this.db.status[idx]);
            if(_this.db.status[idx].id == val)
            {
                console.log(_this.db.status[idx].name);
                return _this.db.status[idx].name;
            }
        }
        return '';
    };
   
    Sgbz.Pqpg.getStatusApt = function(val)
    {
        console.log('Sgbz.Pqpg.getStatusApt');
        var _this = this;
        var val = val.toString();
        // _this.db.apt_status_int[value]
        for(var idx in _this.db.apt_status_int)
        {
            console.log(_this.db.apt_status_int[idx]);
            if(_this.db.apt_status_int[idx].id == val)
            {
                console.log(_this.db.apt_status_int[idx].name);
                return _this.db.apt_status_int[idx].name;
            }
        }
        return '';
    };   
   
    Sgbz.Pqpg.holidayListInit = function()
    {
        console.log('Sgbz.Pqpg.holidayListInit');
        var _this = this;
       
        var controller = 'holiday/';
        // defind grid
        var gridConfig = {
            container: '#jsGrid2',

            loadURL: Sgbz.baseURL + controller + "results",
            insertURL: Sgbz.baseURL + controller + "store",
            updateURL: Sgbz.baseURL + controller + "update",
            deleteURL: Sgbz.baseURL + controller + "destroy",

            addURL: Sgbz.baseURL + controller + "add/",
            editURL: Sgbz.baseURL + controller + "edit/",
            detailURL: Sgbz.baseURL + controller + "show/",
            title: "<b>Holiday</b>",

            sortIndx: "hoildaydate",
            sortDir: "up",

            colModel: [


                    { title: "Id", dataType: "integer", dataIndx: "id", editable: false, width: "8%", align:'center', halign:'center',
                         filter: { type: 'textbox', condition: "between", listeners: ['change'] }
                    },
                    { title: "Name", width: "15%", dataType: "string", dataIndx: "name",
                        validations: [
                            { type: 'minLen', value: 1, msg: "Required" },
                            { type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    { title: "Description", width: "15%", dataType: "string", dataIndx: "description",
                        validations: [

                            { type: 'maxLen', value: 200, msg: "length should be <= 200" }
                        ],
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    { title: "Created By", width: "10%", dataType: "string", dataIndx: "fullname",
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    { title: "Holiday Date", width: "19%", dataType: "date", dataIndx: "hoildaydate", align:'center', halign:'center',
                        filter: { type: 'textbox', condition: "between", init: _this.pqDatePickerDOB, listeners: ['change'] }
                    },
                    { title: "Status", width: "8%", dataType: "integer", dataIndx: "status", align:'center', halign:'center',
                       
                        options: _this.db.status,
                       
                        filter: { type: "select",
                            condition: "equal",
                            //prepend: { '': '--Select--' },
                            valueIndx: "id",
                            labelIndx: "name",
                            listeners: ['change'],
                            options: _this.db.status,

                        },
                        //*
                        render:function( ui ){
                            console.log('--------------------------------1-');
                            var rowData = ui.rowData,
                                dataIndx = ui.dataIndx;
                            var value = rowData[dataIndx];
                           
                            console.log(value);
                            var name = _this.getStatus(value);
                            console.log('--------------------------------2-');
                            console.log(name);
                            console.log(_this.db.status);
                            return name;
                        }
                        //*/
                    },

            ],

        };         
       
        // Initialize the grid
        _this.initPQGrid(gridConfig);
 
       
    };   
    return Sgbz;
})(jQuery, Sgbz || {});
/**********Site Holiday End*******************************************************/

/**********Site Membership Start*******************************************************/
;(function($, Sgbz) {
  
    Sgbz.Pqpg.initMembershipPQGrid = function (gridConfig) { 
        var _this = this;
        
        var colModelTools = [

                    { title: "Actions", minWidth:300, width:300, editable: false, sortable: false, align:'center', halign:'center',
                        render: function (ui) {
                            return "<button type='button' class='edit_btn'>Edit</button>\
                                <button type='button' class='delete_btn'>Delete</button>\
                                <button type='button' class='detail_btn'>View</button>";
                        },
                        postRender: function (ui) {
                            console.log('colModelTools postRender---1-');
                            console.log(this);
                            var rowData = ui.rowData,
                                rowIndx = ui.rowIndx,
                                grid = this,
                                $cell = grid.getCell(ui);

                            //delete button
                            $cell.find(".delete_btn").button({ icons: { primary: 'ui-icon-close'} })
                            .bind("click", function (evt) {
                                console.log('colModelTools postRender---3-');
                                //deleteRow(rowIndx, grid);
                               
                                _this.deleteItem(rowData,rowIndx);
                            });

                            //edit button
                            $cell.find(".edit_btn").button({ icons: { primary: 'ui-icon-pencil'} })
                            .bind("click", function (evt) {
                                console.log('colModelTools postRender---4-');
                                //if (isEditing(grid)) {
                                //    return false;
                                _this.openEditWindow(rowData,rowIndx);
                                //editRow(rowIndx, grid, true);
                            });
                            //detail button
                            $cell.find(".detail_btn").button({ icons: { primary: 'ui-icon-info'} })
                            .bind("click", function (evt) {
                                console.log('colModelTools postRender---5-');
                                //if (isEditing(grid)) {
                                //    return false;
                                //}                               
                                _this.openDetailWindow(rowData,rowIndx);
                                //editRow(rowIndx, grid, true);
                            });

                            //if it has edit class, then edit the row.
                            if (grid.hasClass({ rowData: ui.rowData, cls: 'pq-row-edit' })) {
                                //editRow(rowIndx, grid);
                            }
                            console.log('colModelTools postRender---2-');
                        }
                    }
            ];
            
        $.merge(gridConfig.colModel, colModelTools);
        
        _this.initPQGrid(gridConfig);
    };
    
    Sgbz.Pqpg.membershipListInit = function()
    {
        console.log('Sgbz.Pqpg.membershipListInit');
        var _this = this;
              
        var controller = 'membership/';
        // defind grid
        var gridConfig = {
            container: '#jsGrid2',

            loadURL: Sgbz.baseURL + controller + "results",
            insertURL: Sgbz.baseURL + controller + "store",
            updateURL: Sgbz.baseURL + controller + "update",
            deleteURL: Sgbz.baseURL + controller + "destroy",

            //addURL: Sgbz.baseURL + controller + "add",
            editURL: Sgbz.baseURL + controller + "edit/",
            detailURL: Sgbz.baseURL + controller + "show/",
            title: "<b>Membership</b>",

            sortIndx: "regdate",
            sortDir: "up",

            colModel: [


                    { title: "Membership Code", width: "200", dataType: "string", dataIndx: "membership_code",
                        validations: [
                            { type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },       
                    { title: "Registration Date", width: "250", dataType: "date", dataIndx: "regdate", align:'center', halign:'center',
                        filter: { type: 'textbox', condition: "between", init: _this.pqDatePickerDOB, listeners: ['change'] }
                    },                   
                    /*{ title: "Enquiry Date", width: "250", dataType: "date", dataIndx: "enquiry_date", align:'center', halign:'center',
                        filter: { type: 'textbox', condition: "between", init: _this.pqDatePickerDOB, listeners: ['change'] }
                    },                   
                   
                    { title: "Branch", width: "200", dataType: "string", dataIndx: "branchname",
                        validations: [
                            { type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },*/
                    { title: "Firstname", width: "200", dataType: "string", dataIndx: "firstname",
                        validations: [
                            { type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                   
                    { title: "Lastname", width: "200", dataType: "string", dataIndx: "lastname",
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                   
                    /*{ title: "DOB", width: "250", dataType: "date", dataIndx: "dateofbirth", align:'center', halign:'center',
                        filter: { type: 'textbox', condition: "between", init: _this.pqDatePickerDOB, listeners: ['change'] }
                    },*/
                   
                /*
                 id    membership_code    regdate    enquiry_id    enquiry_date    branch_id    employee_id    firstname    lastname   
                 sex    dateofbirth    age    street    area    city    pincode    state    country    phoneno    mobileno    emailid    password   
                 marital_status    wedding_date    occupation    refby    health_pbm    joint_pbm    healthfitness_goal    remarks    status   
                 corporate_id    school_id    group_id    school_email    academic_year    student_class    section    fitkids_type   
                 mothers_name    mothers_email    mothers_phone    father_name    father_email    father_phone   
                 teacher_name    teacher_email    teacher_phone    work_id    image    fitkidbooking_id    timing   
                 created_by_id    create_at    update_at    deleted_at

                 */                   
                  /*  { title: "City", width: "150", dataType: "string", dataIndx: "city",
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },  */                 
 
                    { title: "Mobile", width: "150", dataType: "string", dataIndx: "mobileno",
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    { title: "Email", width: "200", dataType: "string", dataIndx: "emailid",
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                   /* { title: "Created By", width: "200", dataType: "string", dataIndx: "fullname",
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                   */
                   
                   
                    /*
                   
                    { title: "Id", dataType: "integer", dataIndx: "id", editable: false, width: "8%", align:'center', halign:'center',
                         filter: { type: 'textbox', condition: "between", listeners: ['change'] }
                    },
                    { title: "Name", width: "15%", dataType: "string", dataIndx: "name",
                        validations: [
                            { type: 'minLen', value: 1, msg: "Required" },
                            { type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    { title: "Description", width: "15%", dataType: "string", dataIndx: "description",
                        validations: [

                            { type: 'maxLen', value: 200, msg: "length should be <= 200" }
                        ],
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    { title: "Created By", width: "10%", dataType: "string", dataIndx: "fullname",
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    { title: "Holiday Date", width: "19%", dataType: "date", dataIndx: "hoildaydate", align:'center', halign:'center',
                        filter: { type: 'textbox', condition: "between", init: _this.pqDatePicker, listeners: ['change'] }
                    },
                   
                    */
                    { title: "Status", width: "150", dataType: "integer", dataIndx: "status", align:'center', halign:'center',
                       
                        options: _this.db.status,
                       
                        filter: { type: "select",
                            condition: "equal",
                            //prepend: { '': '--Select--' },
                            valueIndx: "id",
                            labelIndx: "name",
                            listeners: ['change'],
                            options: _this.db.status,

                        },
                        //*
                        render:function( ui ){
                            console.log('--------------------------------1-');
                            var rowData = ui.rowData,
                                dataIndx = ui.dataIndx;
                            var value = rowData[dataIndx];
                           
                            console.log(value);
                            var name = _this.getStatus(value);
                            console.log('--------------------------------2-');
                            console.log(name);
                            console.log(_this.db.status);
                            return name;
                        }
                        //*/
                    },

            ],

        };         
       
        // Initialize the grid
        _this.initMembershipPQGrid(gridConfig);
 
       
    };   
    
    return Sgbz;
    
})(jQuery, Sgbz || {});
/**********Site Membership End*******************************************************/

/**********Site Customer Enquery Start*******************************************************/
;(function($, Sgbz) { 
    Sgbz.Pqpg.openGoToMembershipWindow = function(rowSelectedData,rowIndx){
        var _this = this;
        //var rowSelecedId = rowSelectedData.id;
        var rowSelecedMemberShipId = rowSelectedData.membership_id;
        this.openWindow(_this.config.goToMembershipURL + rowSelecedMemberShipId);
    };  
    Sgbz.Pqpg.openConvertToMembershipWindow = function(rowSelectedData,rowIndx){
        var _this = this;
        var rowSelecedId = rowSelectedData.id;
        this.openWindow(_this.config.convertToMembershipURL + rowSelecedId);
    };
   
    Sgbz.Pqpg.openMembershipWindow = function(rowSelectedData,rowIndx){
        var _this = this;
        //var rowSelecedId = rowSelectedData.id;
        var rowSelecedMemberShipId = rowSelectedData.membership_id;
        //this.openWindow(_this.config.goToMembershipURL + rowSelecedId);
        if(rowSelecedMemberShipId > 0)
        {
            _this.openGoToMembershipWindow(rowSelectedData,rowIndx);
        }
        else
        {
            _this.openConvertToMembershipWindow(rowSelectedData,rowIndx);
        }
    };  
   
    Sgbz.Pqpg.customerEnqueryListInit = function()
    {
        console.log('Sgbz.Pqpg.membershipListInit');
        var _this = this;
       

        var controllerMambership = 'membership/';
       
        var controller = 'customerenquiry/';
        // defind grid
        var gridConfig = {
            container: '#jsGrid2',

            loadURL: Sgbz.baseURL + controller + "results",
            insertURL: Sgbz.baseURL + controller + "store",
            updateURL: Sgbz.baseURL + controller + "update",
            deleteURL: Sgbz.baseURL + controller + "destroy",

            addURL: Sgbz.baseURL + controller + "add",
            editURL: Sgbz.baseURL + controller + "edit/",
            detailURL: Sgbz.baseURL + controller + "show/",
            goToMembershipURL: Sgbz.baseURL + controllerMambership + "show/",
            convertToMembershipURL: Sgbz.baseURL + controllerMambership + "addnew/",
           
           
            title: "<b>Customer Enquery</b>",

            sortIndx: "enquirydate",
            sortDir: "up",

            colModel: [
               
                    /*
                    {title: "Enquiry Date", name: "enquirydate", type: "myDateField",autosearch: true, align: "center"},
                    {title: "Branch Name", name: "branchname", type: "text", autosearch: true, align: "center"},
                    {title: "Firstname", name: "firstname", type: "text", autosearch: true, align: "center"},
                    {title: "Lastname", name: "lastname", type: "text", autosearch: true, align: "center"},
                    {title: "Email", name: "emailid", type: "text", autosearch: true, align: "center"},
                    {title: "Status", name: "status", type: "select", items: DataController.db.status, valueField: "id", textField: "name", autosearch: true, align: "center"},
                    */
               
               
                    { title: "Firstname", width: "200", dataType: "string", dataIndx: "firstname",
                        validations: [
                            { type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                   
                    { title: "Lastname", width: "200", dataType: "string", dataIndx: "lastname",
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },


                    { title: "Enquiry Date", width: "250", dataType: "date", dataIndx: "enquirydate", align:'center', halign:'center',
                        filter: { type: 'textbox', condition: "between", init: _this.pqDatePickerDOB, listeners: ['change'] }
                    }, 
                    { title: "Branch", width: "200", dataType: "string", dataIndx: "branchname",
                        validations: [
                           // { type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },

                   
                    { title: "Email", width: "200", dataType: "string", dataIndx: "emailid",
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },       
                   
                    { title: "DOB", width: "250", dataType: "date", dataIndx: "dateofbirth", align:'center', halign:'center',
                        filter: { type: 'textbox', condition: "between", init: _this.pqDatePickerDOB, listeners: ['change'] }
                    },                   
                   
            /*
            id    enquirydate    branch_id    employee_id    firstname    lastname    sex    dateofbirth    age    street    area    city   
            pincode    state    country    phoneno    mobileno    emailid    marital_status    wedding_date    occupation    refby    remarks   
            status    converteddate    created_by_id    create_at    update_at    deleted_at
            */                    
                                      

                   
                    { title: "Mobile", width: "150", dataType: "string", dataIndx: "mobileno",
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                   
                    
                    { title: "City", width: "150", dataType: "string", dataIndx: "city",
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },                   
 
 
 
                    { title: "Created By", width: "200", dataType: "string", dataIndx: "fullname",
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                   

                    { title: "Status", width: "150", dataType: "integer", dataIndx: "status", align:'center', halign:'center',
                       
                        options: _this.db.status,
                       
                        filter: { type: "select",
                            condition: "equal",
                            //prepend: { '': '--Select--' },
                            valueIndx: "id",
                            labelIndx: "name",
                            listeners: ['change'],
                            options: _this.db.status,

                        },
                        //*
                        render:function( ui ){
                            console.log('--------------------------------1-');
                            var rowData = ui.rowData,
                                dataIndx = ui.dataIndx;
                            var value = rowData[dataIndx];
                           
                            console.log(value);
                            var name = _this.getStatus(value);
                            console.log('--------------------------------2-');
                            console.log(name);
                            console.log(_this.db.status);
                            return name;
                        }
                        //*/
                    },
                   
                 
                    { title: "Convert / Membership", minWidth:"250", editable: false, sortable: false, dataIndx: "membership_id", align:'center', halign:'center',
                        render: function (ui) {
                            return "<button type='button' class='membership_btn'>Convert to Membership</button>";
                        },
                        postRender: function (ui) {
                            console.log('colModelTools postRender---1-');
                            console.log(this);
                            var rowData = ui.rowData,
                                rowIndx = ui.rowIndx,
                                grid = this,
                                $cell = grid.getCell(ui);
                            console.log(rowData);   
                            var rowVal = rowData.membership_id;
                           
                            var $membership_btn = $cell.find(".membership_btn");
                            if(rowVal > 0)
                            {
                                $membership_btn.text('Go to Membership');                               
                                $membership_btn.button({ icons: { primary: 'ui-icon-info'} }) 
                            }
                            else
                            {
                                $membership_btn.button({ icons: { primary: 'ui-icon-transferthick-e-w'} }) 
                            }
                            $membership_btn.button()
                            .bind("click", function (evt) {
                                console.log('colModelTools postRender---3-');
                                //deleteRow(rowIndx, grid);                               
                                _this.openMembershipWindow(rowData,rowIndx);
                            });
                           
                            console.log('colModelTools postRender---2-');
                        }
                    }                   

            ],

        };         
       
        // Initialize the grid
        _this.initPQGrid(gridConfig);
 
       
    };   
    return Sgbz;
})(jQuery, Sgbz || {});
/**********Site Customer Enquery End*******************************************************/


/**********Site Membership Start*******************************************************/
;(function($, Sgbz) { 
    Sgbz.Pqpg.mya = 0; // 0 == all, 1 == my
    
    Sgbz.Pqpg.flt = 0; // 0:All, 1:this week, 2: next week,3:this month, 4: next month,
    
    Sgbz.Pqpg.appointmentTopFilter = function (frm) { 
        console.log('Sgbz.Pqpg.aptTimeslotListInit-'+frm);
        var _this = this;
        // frm - 0, my
        // frm - 1, All
        // frm - 2, this week
        // frm - 3, next week
        // frm - 4, this month
        // frm - 5, next month
        
        if(frm == 0)
        {
            _this.mya = 1; // my
        }
        else if(frm == 1)
        {
            _this.mya = 0; // all
            _this.flt = 0; // all
        }        
        else if(frm == 2)
        {
            _this.flt = 1; // this week
        }
        else if(frm == 3)
        {
            _this.flt = 2; // next week
        }
        else if(frm == 4)
        {
            _this.flt = 3; // this month
        }
        else if(frm == 5)
        {
            _this.flt = 4; // next month
        }
        else
        {
            _this.mya = 0; // all
            _this.flt = 0; // all
        }
        var filterObject = [];
        /*
                var CM = $grid.pqGrid("getColModel");
                for (var i = 0, len = CM.length; i < len; i++) {
                    var dataIndx = CM[i].dataIndx;
                    filterObject.push({ dataIndx: dataIndx, condition: condition, value: value });
                }
        */     
        console.log(_this.mya,_this.flt);
        filterObject = [
            { dataIndx: 'id', condition: 'custom', value: "apt-"+_this.mya + '-' + _this.flt},
            //{ dataIndx: '-my-flt', condition: 'equal', value: _this.flt},
        ];
        
        // {"dataIndx":"cmc_date","value":"2016-09-18","value2":"2016-09-29","condition":"between","dataType":"date","cbFn":""}
        if(_this.flt > 0) 
        {
            var start_date = "";
            var end_date = "";
            if(_this.flt == 1) // this week
            {
                start_date = moment().startOf('isoweek').format("YYYY-MM-DD");
                end_date = moment().endOf('isoweek').format("YYYY-MM-DD");
            }
            else if(_this.flt == 2) // next week
            {
                start_date = moment().add(1, 'weeks').startOf('isoWeek').format("YYYY-MM-DD");
                end_date = moment().add(1, 'weeks').endOf('isoWeek').format("YYYY-MM-DD");
            }        
            else if(_this.flt == 3) // this month
            {
                start_date = moment().startOf('month').format("YYYY-MM-DD");
                end_date = moment().endOf('month').format("YYYY-MM-DD");
            }
            else if(_this.flt == 4) // next month
            {
                start_date = moment().add(1, 'month').startOf('month').format("YYYY-MM-DD");
                end_date = moment().add(1, 'month').endOf('month').format("YYYY-MM-DD");
            } 
            if(start_date != "" && end_date != "")
            {
                filterObject.push(
                    {
                        "dataIndx":"cmc_date"
                        ,"value":start_date
                        ,"value2":end_date
                        ,"condition":"between"
                        ,"dataType":"date"
                        ,"cbFn":""
                    }
                );
            }
        }
        else
        {
            filterObject.push(
                    {
                        "dataIndx":"cmc_date"
                        ,"value":""
                        ,"value2":""
                        ,"condition":"between"
                        ,"dataType":"date"
                        ,"cbFn":""
                    }
                );
        }
        
        console.log(filterObject);
        this.gridObj.pqGrid("filter", {
                oper: 'replace',
                data: filterObject
            }).pqGrid("refresh");
            
    };   
    
    
    Sgbz.Pqpg.aptUpadateMode = 0;
    //Sgbz.modeAdd = 1; // for customer enquery
    //Sgbz.modeAdd = 2; // for new membership
    //Sgbz.modeAdd = 3; // 
    // Succes Mesages
    Sgbz.Pqpg.aptUpadateModeMessages = {
        0:"Appointment made InActive!",
        1:"Appointment made Active!",
        2:"Appointment made Held successfully!",
        3:"Appointment made Not Held successfully!",
        4:"Appointment cancelled successfully!",
        5:"Appointment closed successfully!",
    };
    Sgbz.Pqpg.ajaxFormSubmitSuccess = function(responseText , statusText, xhr, formObject) 
    { 
        console.log('Sgbz.Pqpg.ajaxFormSubmitSuccess-');
        var _this = this;
        console.log(responseText);
        console.log(statusText);
        //alert('Thanks for your comment!'); 
        $('.error-list').html('');
        //var appointmentModel = $("#update-appointment");
        _this.aptUpadateMode = $("#update-appointment").find('input[type="radio"][name="close"]:checked').val();
        
        if(responseText.status=="1")
        {
            //alert('Data Added successfully!'); 
            if( _this.aptUpadateMode > 0 && _this.aptUpadateModeMessages.hasOwnProperty(_this.aptUpadateMode))
            {
                Sgbz.notify(_this.aptUpadateModeMessages[_this.aptUpadateMode], "success");
            }
            else
            {
                Sgbz.notify("Data update successfully!", "success");
            }
            // close the the model box
            $('.appointmentModel').modal('hide');
            //_this.gridObj.pqGrid("refresh");
            //Sgbz.Pqpg.gridObj.pqGrid("filter", {oper: 'add',data: {}}).pqGrid("refresh");
            _this.gridObj.pqGrid("filter", {oper: 'add',data: {}}).pqGrid("refresh");
        }
        else
        {
            // error-list
            if(typeof responseText.message == "string")
            {
                $('.error-list').append('<span class="label label-danger">'+responseText.message+'</span>');
                
                Sgbz.notify(responseText.message, "error");
            }
            else
            {       
                var idx,idx2;                                                  
                for(idx in responseText.message)
                {
                    for(idx2 in responseText.message[idx])
                    {
                        $('.error-list').append('<span class="label label-danger">'+idx+' : '+idx2+' : '+responseText.message[idx][idx2]+'</span><br>');
                        Sgbz.notify(idx+' :- '+idx2+' : '+responseText.message[idx][idx2], "error");
                    }    
                }                                
            }
        }        
    };    
    
    // prepare Options Object 
    Sgbz.Pqpg.getAjaxFormOptions = function() { 
        console.log('Sgbz.Pqpg.getAjaxFormOptions-');
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
            
    Sgbz.Pqpg.commomModelBoxInit = function()
    {
        console.log('Sgbz.Pqpg.commomModelBoxInit-');
        var _this = this;
        /*
        $('#update-appointment .modal-content > .modal-body').html(response);
        // margin-right: -5px;      margin-left: -5px;
        $('#update-appointment .modal-content > .modal-body > div.row div.body > div.row ').css({'margin-left':'0px','margin-right':'0px'});

        $('#update-appointment .modal-content > .modal-header > .modal-title').html(modalTitle); 

        var headers = $('#blankModal .modal-content > .modal-body').find('.box > header');
        $(headers).eq(0).hide();
        
        $('#update-appointment .modal-footer').hide();
        */
        var ajaxFormOptions = _this.getAjaxFormOptions();
        
        $('.appointmentModel form').ajaxForm(ajaxFormOptions);           
    };
    
    Sgbz.Pqpg.getAppointmentMembers = function(rowData)
    {
        console.log('Sgbz.Pqpg.appointmentUpdate-');
        var _this = this;
            
                var url = _site_url + "appointments/members";
                //var data = $( 'form[name="create-timeslot"]' ).serialize();
                //var data = $( '.create-activity-timeslot-form form[name="create-timeslot"]' ).serializeArray();
                var data = [];
                //console.log(data);
                data.push({'name':'activity_timeslots_id','value':rowData.id});
                //console.log(data);
                //console.log(selectedDatum);
                data = $.param(data);
                //console.log(data);
                var dataType = "json";
                var success = function( data, textStatus, jqXHR ){
                    console.log('----success-----');
                    console.log(textStatus);
                    console.log(data);
                    var appointmentModel = $("#member-appointment");
                    var membersBox = $(appointmentModel).find('.members');
                        
                    if(data.status == 1)
                    {
                        console.log("------------------------------------1---");
                        // members member-row
                        
                        
                        var memberRow = $(membersBox).find('.member-row').eq(0).clone();
                        
                        
                        var members = data.members;
                        
                        if(
                                members != undefined && members != null && 
                                ( 
                                    //typeof members == "Array" 
                                    // || typeof members == "Object"
                                    1
                                )
                            )
                        {
                            console.log(typeof members);
                            console.log("------------------------------------2---");
                            var mn = members.length;
                            var i=0,member,memberTmt, mrn;
                            var memberRowBox,name;
                            for(;i<mn;i++)
                            {
                                console.log("------------------------------------3---");
                                memberTmt = members[i];
                                member = memberTmt.member;
                                console.log(member);
                                
                                memberRow = $(membersBox).find('.member-row').eq(0).clone();
                                
                                $(membersBox).append(memberRow);
                                
                                mrn = $(membersBox).find('.member-row').length;
                                
                                console.log("------------------------------------1---:"+mrn);
                                
                                memberRowBox = $(membersBox).find('.member-row').eq(mrn-1);
                                
                                $(memberRowBox).find('.srn').html((i + 1) + ".)");
                                
                                name = member.membership_code + " - " + member.firstname + " " + member.lastname;
                                
                                $(memberRowBox).find('.name').html(name);
                                
                            }
                            
                            // remove first row
                            $(membersBox).find('.member-row').eq(0).remove();
                            
                        }
                        else
                        {
                            Sgbz.notify("No members booked this appointment","info");
                            //var appointmentModel = $("#member-appointment");
                            //var membersBox = $(appointmentModel).find('.members');

                            var memberRowBox = $(membersBox).find('.member-row').eq(0);
                            $(memberRowBox).find('.srn').html("");
                            $(memberRowBox).find('.name').html("No members booked this appointment");
                        }
                        
                    }
                    else
                    {
                        Sgbz.notify("No members booked this appointment","info");
                        //var appointmentModel = $("#member-appointment");
                        //var membersBox = $(appointmentModel).find('.members');
                        
                        var memberRowBox = $(membersBox).find('.member-row').eq(0);
                        $(memberRowBox).find('.srn').html("");
                        $(memberRowBox).find('.name').html("No members booked this appointment");
                                
                    }
                    
                };
                var error = function( jqXHR, textStatus, errorThrown ){
                    //console.log('----error-----');
                    //console.log(textStatus);
                    //console.log(errorThrown);
                    Sgbz.notify(textStatus,"warning");
                    Sgbz.notify(errorThrown,"warning");
                    /*
                    Sgbz.notify("No members booked this appointment","info");
                    var appointmentModel = $("#member-appointment");
                    var membersBox = $(appointmentModel).find('.members');

                    var memberRowBox = $(membersBox).find('.member-row').eq(0);
                    $(memberRowBox).find('.srn').html("");
                    $(memberRowBox).find('.name').html("No members booked this appointment");
                    */
                };               
               
                var config = {
                    method: "GET",
                    //type: "POST",
                    url: url,
                    data: data,
                    success: success,
                    error: error,
                    dataType: dataType
                };
                Sgbz.ajax(config);         
    };
    
    Sgbz.Pqpg.appointmentFill = function (rowData,rowIndx,um) { 
        console.log('Sgbz.Pqpg.appointmentUpdate-');
        var _this = this;
        
        // um : 0 update, 1 member
        
        console.log(rowData);
        console.log(rowIndx);
        
        var appointmentModel = null;
        if(um == 0)
            appointmentModel = $("#update-appointment");
        else
            appointmentModel = $("#member-appointment");
        
        
        var cmc_date = rowData.cmc_date;        
        cmc_date = Sgbz.formatDate(cmc_date,"DD/MMM/YYYY");                
        // date-apt
        $(appointmentModel).find(".date-apt").html(cmc_date);
                
        // consultant-apt
        var fullname = rowData.fullname;        
        $(appointmentModel).find(".consultant-apt").html(fullname);
        
        // act-apt
        var activitymain = rowData.activitymain;        
        $(appointmentModel).find(".act-apt").html(activitymain);
        
        // frmt
        var fromtime = rowData.fromtime;        
        fromtime = Sgbz.formatTime(fromtime,"HH:mm A"); 
        $(appointmentModel).find(".frmt-apt").html(fromtime);
        // tot
        var totime = rowData.totime;        
        totime = Sgbz.formatTime(totime,"HH:mm A"); 
        $(appointmentModel).find(".tot-apt").html(totime);
        // duration
        var duration = rowData.duration;        
        duration = Sgbz.convertTime(duration); 
        $(appointmentModel).find(".duration-apt").html(duration);
        
        $(appointmentModel).find(".activity_timeslots_id").val(rowData.id);
        // joined
        // max
        $(appointmentModel).find(".max-apt").html(rowData.maxperson);
        $(appointmentModel).find(".joined-apt").html(rowData.joinedperson);
        
        //$(appointmentModel).find(".reason-apt").val(rowData.reason);
        $(appointmentModel).find(".reason-txt").html('');
        var reason = rowData.reason;
        //reason.
        //reason = reason.str_replace("\r\n","<br>").
        while(reason.indexOf("\r\n") != -1)
        {
            reason = reason.replace("\r\n","<br>");
        }
        while(reason.indexOf("\n") != -1)
        {
            reason = reason.replace("\n","<br>");
        }
        
        $(appointmentModel).find(".reason-txt").show();
                
        $(appointmentModel).find(".reason-txt").html(reason);
        
        // status
        //var status_name = _this.getStatusApt(rowData.status);
        
        $(appointmentModel).find('input[type="radio"][name="close"][value="'+rowData.status+'"]').prop("checked",true);
        
        // get members list
        if(um == 1)
        {
            _this.getAppointmentMembers(rowData);
        }
        
    };
    
    Sgbz.Pqpg.appointmentUpdate = function (rowData,rowIndx) { 
        console.log('Sgbz.Pqpg.appointmentUpdate-');
        var _this = this;
        
        console.log(rowData);
        console.log(rowIndx);
        
        
        $('#update-appointment').modal('show');
        
        _this.commomModelBoxInit();
        
        _this.appointmentFill(rowData,rowIndx, 0);
        
        
        
    };
    
    Sgbz.Pqpg.appointmentMember = function (rowData,rowIndx) { 
        console.log('Sgbz.Pqpg.appointmentMember-');
        var _this = this;
        
        console.log(rowData);
        console.log(rowIndx);
        $('#member-appointment').modal('show');
        
        //_this.commomModelBoxInit();
        _this.appointmentFill(rowData,rowIndx , 1);
    };
    
    Sgbz.Pqpg.initAppointmentPQGrid = function (gridConfig) { 
        var _this = this;
        
        var colModelTools = [

                    { title: "Actions", minWidth:300, width:300, editable: false, sortable: false, align:'center', halign:'center',
                        render: function (ui) {
                            return "<button type='button' class='edit_btn'>Update</button>\
                                <button type='button' class='detail_btn'>Members</button>";
                        },
                        postRender: function (ui) {
                            console.log('colModelTools postRender---1-');
                            console.log(this);
                            var rowData = ui.rowData,
                                rowIndx = ui.rowIndx,
                                grid = this,
                                $cell = grid.getCell(ui);

                            //delete button
                            /*
                            $cell.find(".delete_btn").button({ icons: { primary: 'ui-icon-close'} })
                            .bind("click", function (evt) {
                                console.log('colModelTools postRender---3-');
                                //deleteRow(rowIndx, grid);
                               
                                _this.deleteItem(rowData,rowIndx);
                            });
                            */
                            //edit button
                            $cell.find(".edit_btn").button({ icons: { primary: 'ui-icon-pencil'} })
                            .bind("click", function (evt) {
                                console.log('colModelTools postRender---4-');
                                //if (isEditing(grid)) {
                                //    return false;
                                _this.appointmentUpdate(rowData,rowIndx);
                                //editRow(rowIndx, grid, true);
                            });
                            //detail button
                            $cell.find(".detail_btn").button({ icons: { primary: 'ui-icon-info'} })
                            .bind("click", function (evt) {
                                console.log('colModelTools postRender---5-');
                                //if (isEditing(grid)) {
                                //    return false;
                                //}     
                                
                                _this.appointmentMember(rowData,rowIndx);
                                //editRow(rowIndx, grid, true);
                            });

                            //if it has edit class, then edit the row.
                            if (grid.hasClass({ rowData: ui.rowData, cls: 'pq-row-edit' })) {
                                //editRow(rowIndx, grid);
                            }
                            console.log('colModelTools postRender---2-');
                        }
                    }
            ];
        
        
        $.merge(gridConfig.colModel, colModelTools);
        //$.merge(gridConfig.toolbar, customtoolbar);
        
        _this.initPQGrid(gridConfig);
    };    
   
    Sgbz.Pqpg.aptTimeslotListInit = function()
    {
        console.log('Sgbz.Pqpg.aptTimeslotListInit');
        var _this = this;
         // check-circle
        var customtoolbar = {
            cls: 'pq-toolbar-crud',
            items: [
                { type: 'button', label: 'My Appointments', icon: 'ui-icon-check', 
                    value: 1,
                    class: "abc",
                    title: 'My Appointments', 
                    listeners: [
                        //{ click: addhandler}
                        {
                            click :function(){
                                    //this.reset({filter: true});	
                                    _this.appointmentTopFilter(0);
                                }        
                                
                        }
                    ] 
                },      
                { type: 'button', label: 'All', icon: 'ui-icon-check', 
                    value: 1,                    
                    listeners: [
                    //{ click: addhandler}
                        {
                            click :function(){
                                    //this.reset({filter: true});							
                                    _this.appointmentTopFilter(1);
                                }        
                                
                        }
                    ] 
                },
                { type: 'button', label: 'This Week', icon: 'ui-icon-check', listeners: [
                        //{ click: edithandler}
                        {
                            click :function(){
                                    //this.reset({filter: true});							
                                    _this.appointmentTopFilter(2);
                                }        
                                
                        }
                    ] 
                },
                { type: 'button', label: 'Next Week', icon: 'ui-icon-check', listeners: [
                        //{ click: deletehandler}
                        {
                            click :function(){
                                    //this.reset({filter: true});	
                                    _this.appointmentTopFilter(3);
                                }        
                                
                        }
                    ]
                },
                { type: 'button', label: 'This Month', icon: 'ui-icon-check', listeners: [
                        //{ click: edithandler}
                        {
                            click :function(){
                                    //this.reset({filter: true});
                                    _this.appointmentTopFilter(4);
                                }        
                                
                        }
                    ] 
                },
                { type: 'button', label: 'Next Month', icon: 'ui-icon-check', listeners: [
                        //{ click: deletehandler}
                        {
                            click :function(){
                                    //this.reset({filter: true});	
                                    _this.appointmentTopFilter(5);
                                }        
                                
                        }
                    ]
                },
                
            ]
        };
       
        var controller = 'appointments/';
        // defind grid
        // toolbar: toolbar
        var gridConfig = {
            container: '#jsGrid2',

            loadURL: Sgbz.baseURL + controller + "results",
            //insertURL: Sgbz.baseURL + controller + "store",
            updateURL: Sgbz.baseURL + controller + "update",
            //deleteURL: Sgbz.baseURL + controller + "destroy",

            //addURL: Sgbz.baseURL + controller + "add",
            //editURL: Sgbz.baseURL + controller + "edit/",
            //detailURL: Sgbz.baseURL + controller + "show/",
            title: "<b>Appointments</b>",

            sortIndx: "cmc_date",
            sortDir: "up",
            toolbar: customtoolbar,
            inserting: false,
            editing: false,
            deleting: false,
            colModel: [
                    { title: "Id", dataType: "integer", dataIndx: "id", editable: false, width: "8%", align:'center', halign:'center',hidden:true,
                         filter: { type: 'textbox', condition: "between", listeners: ['change'] }
                    },
                    /*
                    { title: "Id", width: "200", dataType: "string", dataIndx: "id",
                        validations: [
                            { type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    }, 
                    */
                    { title: "Date", width: "250", dataType: "date", dataIndx: "cmc_date", align:'center', halign:'center',
                        filter: { type: 'textbox', condition: "between", init: _this.pqDatePickerDOB, listeners: ['change'] },
                        render:function( ui ){
                            console.log('--------------------------------1-');
                            var rowData = ui.rowData,
                                dataIndx = ui.dataIndx;
                            var value = rowData[dataIndx];
                           
                            console.log(value);
                            //var name = moment(value).format("HH:mm A");
                            var name = Sgbz.formatDate(value,"DD/MMM/YYYY");
                            return name;
                        }
                        
                    },     
                    /*
                    { title: "Enquiry Date", width: "250", dataType: "date", dataIndx: "enquiry_date", align:'center', halign:'center',
                        filter: { type: 'textbox', condition: "between", init: _this.pqDatePickerDOB, listeners: ['change'] }
                    },                   
                    */
                    { title: "By", width: "200", dataType: "string", dataIndx: "fullname",
                        validations: [
                            { type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    { title: "Activity", width: "200", dataType: "string", dataIndx: "activitymain",
                        validations: [
                            { type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    /*
                    { title: "Lastname", width: "200", dataType: "string", dataIndx: "lastname",
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                   
                    { title: "DOB", width: "250", dataType: "date", dataIndx: "dateofbirth", align:'center', halign:'center',
                        filter: { type: 'textbox', condition: "between", init: _this.pqDatePickerDOB, listeners: ['change'] }
                    },
                    */
                /*
                 	id	activity_id	consultant_id	branch_id	timeslot_id	timeslot_batch_id	
                    timeslot_batch_activity_id	timeslot_batch_activity_consultant_id	timeslot_batch_day_id	
                    cmc_date	fromtime	totime	duration	maxperson	joinedperson	
                    status	created_by_id	create_at	update_at	deleted_at

                 */  
                    { title: "From", width: "100", dataType: "string", dataIndx: "fromtime", editable: false, align:'center', halign:'center',
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        //filter: { type: 'textbox', condition: 'contain', listeners: ['change'] },
                        render:function( ui ){
                            console.log('--------------------------------1-');
                            var rowData = ui.rowData,
                                dataIndx = ui.dataIndx;
                            var value = rowData[dataIndx];
                           
                            console.log(value);
                            //var name = moment(value).format("HH:mm A");
                            var name = Sgbz.formatTime(value,"HH:mm A");
                            return name;
                        }
                    },
                    { title: "To", width: "100", dataType: "string", dataIndx: "totime", editable: false, align:'center', halign:'center',
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        //filter: { type: 'textbox', condition: 'contain', listeners: ['change'] },
                        render:function( ui ){
                            console.log('--------------------------------1-');
                            var rowData = ui.rowData,
                                dataIndx = ui.dataIndx;
                            var value = rowData[dataIndx];
                           
                            console.log(value);
                            //var name = moment(value).format("HH:mm A");
                            //var name = moment(value).format("HH:mm A");
                            var name = Sgbz.formatTime(value,"HH:mm A");
                            return name;
                        }
                    },
                    { title: "Duration", width: "100", dataType: "string", dataIndx: "duration", editable: false, align:'center', halign:'center',
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        //filter: { type: 'textbox', condition: 'contain', listeners: ['change'] },
                        render:function( ui ){
                            console.log('--------------------------------1-');
                            var rowData = ui.rowData,
                                dataIndx = ui.dataIndx;
                            var value = rowData[dataIndx];
                           
                            console.log(value);
                            //var name = moment(value).format("HH:mm A");
                            //var name = moment(value).format("HH:mm A");
                            var name = Sgbz.convertTime(value);
                            return name;
                        }
                    },
                    { title: "Max", dataType: "integer", dataIndx: "maxperson", width: "8%", align:'center', halign:'center',
                         filter: { type: 'textbox', condition: "between", listeners: ['change'] }
                    },
                    { title: "Joined", dataType: "integer", dataIndx: "joinedperson", width: "8%", align:'center', halign:'center',
                         filter: { type: 'textbox', condition: "between", listeners: ['change'] }
                    },
                    /*
                    { title: "City", width: "150", dataType: "string", dataIndx: "city",
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },                   
 
                    { title: "Mobile", width: "150", dataType: "string", dataIndx: "mobileno",
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    { title: "Email", width: "200", dataType: "string", dataIndx: "emailid",
                        validations: [
                            //{ type: 'minLen', value: 1, msg: "Required" },
                            //{ type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    { title: "Created By", width: "200", dataType: "string", dataIndx: "fullname",
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    */
                   
                   
                    /*
                   
                    { title: "Id", dataType: "integer", dataIndx: "id", editable: false, width: "8%", align:'center', halign:'center',
                         filter: { type: 'textbox', condition: "between", listeners: ['change'] }
                    },
                    { title: "Name", width: "15%", dataType: "string", dataIndx: "name",
                        validations: [
                            { type: 'minLen', value: 1, msg: "Required" },
                            { type: 'maxLen', value: 100, msg: "length should be <= 100" }
                        ],                           
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    { title: "Description", width: "15%", dataType: "string", dataIndx: "description",
                        validations: [

                            { type: 'maxLen', value: 200, msg: "length should be <= 200" }
                        ],
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    { title: "Created By", width: "10%", dataType: "string", dataIndx: "fullname",
                        filter: { type: 'textbox', condition: 'contain', listeners: ['change'] }
                    },
                    { title: "Holiday Date", width: "19%", dataType: "date", dataIndx: "hoildaydate", align:'center', halign:'center',
                        filter: { type: 'textbox', condition: "between", init: _this.pqDatePicker, listeners: ['change'] }
                    },
                   
                    */
                    { title: "Status", width: "150", dataType: "integer", dataIndx: "status", align:'center', halign:'center',
                       
                        options: _this.db.apt_status_int,
                       
                        filter: { type: "select",
                            condition: "equal",
                            //prepend: { '': '--Select--' },
                            valueIndx: "id",
                            labelIndx: "name",
                            listeners: ['change'],
                            options: _this.db.apt_status_int,

                        },
                        //*
                        render:function( ui ){
                            console.log('--------------------------------1-');
                            var rowData = ui.rowData,
                                dataIndx = ui.dataIndx;
                            var value = rowData[dataIndx];
                           
                            console.log(value);
                            var name = _this.getStatusApt(value);
                            console.log('--------------------------------2-');
                            console.log(name);
                            console.log(_this.db.apt_status_int);
                            return name;
                        }
                        //*/
                    },

            ],

        };         
       
        // Initialize the grid
        _this.initAppointmentPQGrid(gridConfig); 
       
    };  
    
    return Sgbz;
    
})(jQuery, Sgbz || {});
/**********Site Membership End*******************************************************/
