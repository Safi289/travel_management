<?php
/*
|--------------------------------------------------------------------------
| JSON Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
| Response should be JSON datatype
|
*/

Route::group(['prefix' => 'json', 'namespace' => 'JsonCon', 'middleware' => ['auth:admin']], function () {
    Route::get('get-upazilas/{district}', 'LocationController@getUpazilasFromDistrict');
    Route::get('get-customers-by-id/{customer}', 'CustomerController@getCustomerById');
    Route::get('get-customers-by-group-id/{group_id}', 'CustomerController@getCustomerByGroup');
    Route::post('delete-attached-document/{document_id}', 'AttachedDocumentController@destroy')->name('attached-document.delete');
    Route::get('get-hajj-payment-status/{hajj_id}', 'DepositController@getPaymentStatus');
    Route::post('get-hajj-payment-details', 'DepositController@getDepositList');
    Route::get('get-passport-current-status', 'PassportHistoryController@getPassportStatus');
    Route::get('get-passport-status-history', 'PassportHistoryController@getPassportStatusHistory');
    Route::get('is-registered-passport', 'CustomerPassportController@isRegisteredPassport');
    Route::post('update-customer-note/{customer}', 'CustomerController@updateNote')->name('json.customer.update-note');
    Route::get('package/get-info/{package}', 'PackageController@getPackageInformation')->name('json.package.get-info');
});
