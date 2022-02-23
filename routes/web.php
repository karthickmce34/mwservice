<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('login');
});*/

/*Route::group(['middleware' => ['auth']], function () {
    //Route::get('/', 'HomeController@index')->name('home');
    Route::resource('home', 'HomeController');
});*/

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', 'Auth\LoginController@getLogin');
Route::post('login', 'Auth\LoginController@postLogin');
Route::get('login/logout', 'Auth\LoginController@logout');
Route::get('/callback', 'Auth\LoginController@callback');


Route::get('emailsingin', 'SigninController@getIndex')->name('emailsingin.index');
Route::get('attendance', 'AttendanceController@getIndex')->name('attendance.index');

Route::get('home', 'HomeController@getIndex')->name('home.index');
//Route::resource('home', 'HomeController');
Route::get('home/appdata', 'HomeController@getAppdata');
Route::get('home/cusdata', 'HomeController@getCusdata');
Route::get('home/cusdetail', 'HomeController@getCusdetail');
Route::get('home/spareappdata', 'HomeController@getSpareappdata');
Route::get('home/prddetail', 'HomeController@getPrddetail');
Route::get('home/productdetail', 'HomeController@getProductdetail');
Route::get('home/taxcalc', 'HomeController@getTaxcalc');
Route::get('home/docseq', 'HomeController@getDocseq');
Route::get('home/attend_detail', 'HomeController@getAttendDetails');
Route::get('home/attendadd', 'HomeController@getAttendadd');
Route::get('home/calender', 'HomeController@getCalender');

Route::resource('serviceengineer', 'ServiceEngineerController');
Route::get('serviceengineer/delete/{id}', 'ServiceEngineerController@destroy');

Route::resource('serviceagent', 'ServiceAgentController');
Route::get('serviceagent/delete/{id}', 'ServiceAgentController@destroy');


Route::resource('complaintregister', 'ComplaintRegisterController');
Route::get('complaintregister/delete/{id}', 'ComplaintRegisterController@destroy');
Route::get('complaintregister/addnew/{id}', 'ComplaintRegisterController@addnew');
Route::post('complaintregister/storedoc', 'ComplaintRegisterController@postStoredoc');
Route::get('complaintregister/editdoc/{id}', 'ComplaintRegisterController@editdoc');
Route::put('complaintregister/updatedoc/{id}', 'ComplaintRegisterController@updatedoc');
Route::post('complaintregister/updatestatus', 'ComplaintRegisterController@postUpdatestatus');
Route::post('complaintregister/updateproduct', 'ComplaintRegisterController@postUpdateproduct');
Route::post('complaintregister/taxcalc', 'ComplaintRegisterController@taxcalc');
Route::get('complaintregister/deletedoc/{id}', 'ComplaintRegisterController@deleteDoc');




Route::resource('servicespareregister', 'ServiceSpareRegisterController');
Route::get('servicespareregister/addnew/{id}', 'ServiceSpareRegisterController@addnew');
Route::post('servicespareregister/storedoc', 'ServiceSpareRegisterController@postStoredoc');
Route::get('servicespareregister/editdoc/{id}', 'ServiceSpareRegisterController@editdoc');
Route::put('servicespareregister/updatedoc/{id}', 'ServiceSpareRegisterController@updatedoc');
Route::get('servicespareregister/addprd/{id}', 'ServiceSpareRegisterController@addprd');
Route::post('servicespareregister/deputeengineer', 'ServiceSpareRegisterController@postDeputeengineer');
Route::post('servicespareregister/storeprd', 'ServiceSpareRegisterController@postStoreprd');
Route::post('servicespareregister/updatestatus', 'ServiceSpareRegisterController@postUpdatestatus');
Route::post('servicespareregister/thingstodo', 'ServiceSpareRegisterController@postThingstodo');
Route::post('servicespareregister/thingsedit', 'ServiceSpareRegisterController@postThingsedit');
Route::post('servicespareregister/thingsupdate', 'ServiceSpareRegisterController@postThingsupdate');
Route::post('servicespareregister/thingstotaken', 'ServiceSpareRegisterController@postThingstotaken');
Route::post('servicespareregister/takenedit', 'ServiceSpareRegisterController@postTakenedit');
Route::post('servicespareregister/takenupdate', 'ServiceSpareRegisterController@postTakenupdate');
Route::post('servicespareregister/servicechargeedit', 'ServiceSpareRegisterController@postServicechargeedit');
Route::post('servicespareregister/servicechargeupdate', 'ServiceSpareRegisterController@postServicechargeupdate');
Route::post('servicespareregister/productadd', 'ServiceSpareRegisterController@postProductadd');
Route::get('servicespareregister/editprd/{id}', 'ServiceSpareRegisterController@editprd');
Route::put('servicespareregister/updateprd/{id}', 'ServiceSpareRegisterController@updateprd');
Route::post('servicespareregister/productupdte', 'ServiceSpareRegisterController@postProductupdte');
Route::post('servicespareregister/servicecharge', 'ServiceSpareRegisterController@postServicecharge');
Route::post('servicespareregister/offerprint', 'ServiceSpareRegisterController@postOfferprint');
Route::post('servicespareregister/invperformaprint', 'ServiceSpareRegisterController@postInvperformaprint');
Route::post('servicespareregister/offerdata', 'ServiceSpareRegisterController@postOfferdata');
Route::post('servicespareregister/emailsend', 'ServiceSpareRegisterController@postEmailsend');
Route::post('servicespareregister/updateorderstatus', 'ServiceSpareRegisterController@postUpdateorderstatus');
Route::get('servicespareregister/deleteprd/{id}', 'ServiceSpareRegisterController@deletePrd');
Route::get('servicespareregister/deletethingstodo/{id}', 'ServiceSpareRegisterController@deletethingstodo');
Route::post('servicespareregister/offeradd', 'ServiceSpareRegisterController@offeradd');
Route::post('servicespareregister/updatedefault', 'ServiceSpareRegisterController@postUpdatedefault');


Route::resource('visitplan', 'VisitplanController');
Route::get('visitplan/addnew/{id}', 'VisitplanController@addnew');
Route::post('visitplan/storedoc', 'VisitplanController@postStoredoc');
Route::get('visitplan/editdoc/{id}', 'VisitplanController@editdoc');
Route::put('visitplan/updatedoc/{id}', 'VisitplanController@updatedoc');
Route::post('visitplan/updatestatus', 'VisitplanController@postUpdatestatus');
Route::get('visitplan/addphoto/{id}', 'VisitplanController@addphoto');
Route::post('visitplan/storephoto', 'VisitplanController@postStorephoto');
Route::get('visitplan/editphoto/{id}', 'VisitplanController@editphoto');
Route::put('visitplan/updatephoto/{id}', 'VisitplanController@updatephoto');
Route::post('visitplan/updatestatus', 'VisitplanController@postUpdatestatus');

Route::resource('pendingvisit', 'PendingvisitplanController');
Route::post('pendingvisit/insertsummary', 'PendingvisitplanController@postInsertsummary');

Route::resource('visitplansummary', 'VisitplansummaryController');
Route::get('visitplansummary/index', 'VisitplansummaryController@getIndex');

Route::resource('product', 'ProductController');

Route::resource('servicecharge', 'ServiceChargeController');
Route::get('servicecharge/delete/{id}', 'ServiceChargeController@destroy');

Route::resource('user', 'UserController');
Route::get('user/delete/{id}', 'UserController@destroy');

Route::resource('email', 'EmailController');
Route::post('email/message', 'EmailController@postMessage');
Route::post('email/sendmail', 'EmailController@postSendmail');
Route::post('email/emaildata', 'EmailController@postEmaildata');
Route::post('email/spareappdata', 'EmailController@postSpareappdata');
Route::post('email/appdata', 'EmailController@postAppdata');
Route::post('email/emailstatus', 'EmailController@postEmailstatus');

Route::resource('servicereport', 'ServiceReportController');
Route::post('servicereport/servicedata', 'ServiceReportController@servicedata');
