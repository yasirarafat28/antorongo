<?php

use App\MemberRelation;
use App\Transaction;
use Carbon\Carbon;
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

Route::get('/', function () {

    return view('front.index');
    return redirect('/login');
});

Route::get('/testing', function () {

    return Transaction::total_by_slug_except_project_date('loan_profit_collect_income',['fdr_member','founding_member','daily_saving','short_term','long_term'],Null,NUll);

    return MemberRelation::releted_user_ids('6145');

    $from = '2015-12-22';
    $to = '2020-12-22';

    return Carbon::parse($to)->subDay('1')->format('Y-m-d');
    $slug = 'loan_revenue_collect_income';
    $project = 'daily_saving';
    //$project = 'fdr_member';
    return Transaction::total_by_slug_account_project_date($slug,$project,$from,$to);
});
Auth::routes();


//Temporary Controller
Route::get('/member-search', 'FrontController@member_search');
Route::get('/fdr_transaction_sync', 'TemporaryController@fdr_transaction_sync');
Route::get('/permission-synchronise', 'TemporaryController@permission_asncronas');
Route::get('/sync_user_project', 'TemporaryController@sync_user_project');


Route::post('/get-district-list-by-division', 'DistrictController@getDistrict')->name('getDistrict');
Route::post('/get-thana-list-by-district', 'ThanaController@getThana')->name('getThana');
Route::post('/getSalaryStructure', 'SalarySetupController@getSalaryStructure')->name('getSalaryStructure');


Route::get('/transaction-invoice/{txn_id}', 'InvoiceController@transaction_invoice')->name('transaction_invoice');



//All User Route
Route::group(['middleware' => ['auth']], function () {
    Route::post('/profile-update/{user_id}', 'ProfileController@profileUpdate');
    Route::post('/change_password', 'ProfileController@change_password')->name('change_password');
    Route::get('/password-reset', 'AccountController@passwordReset');
    Route::get('user-password-generator', 'AccessGeneratorController@index');
    Route::get('access-generate/{type}/{user_id}', 'AccessGeneratorController@generator');


    Route::get('/inbox', 'InqueryController@index');
    Route::get('/compose', 'InqueryController@compose');
    Route::get('/inbox/{id}', 'InqueryController@single');
    Route::post('compose-submit', 'InqueryController@SubmitCompose');

    Route::get('admin/message','MessageController@index');


    Route::get('/search', 'SearchController@search');


    Route::get('/profile', 'ProfileController@MyProfile');
    Route::post('/getUser', 'UserController@getUser')->name('getUser');
});

//Chairman Panel
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::get('dashboard', 'DashboardController@admin');

    //Report

    Route::get('report', 'ReportController@report')->name('report.statistics');

    //wallet
    Route::get('balance', 'WalletController@balance');
    Route::get('balance/transactions/{wallet}', 'WalletController@transactions');
    Route::get('balance/transfer/{from}', 'WalletController@transfer');
    Route::post('balance/transfer-submit', 'WalletController@transfer_submit')->name('transfer_submit');

    //Loan
    Route::post('loan/active/{id}', 'LoanController@ApproveLoan');
    Route::get('loan/reject/{id}', 'LoanController@RejectLoan');
    Route::get('loan/Remove/{id}', 'LoanController@DeleteLoan');
    Route::get('loan/find', 'LoanController@LoanFind');
    Route::get('loan/list', 'LoanController@LoanList');
    Route::get('loan/edit/{id}', 'LoanController@LoanEdit');
    Route::post('loan/edit/{id}', 'LoanController@LoanUpdate');
    Route::get('loan/application', 'LoanController@LoanApplication');
    Route::post('loan/application', 'LoanController@LoanApplicationSubmit')->name('LoanApplication');
    Route::post('loan/application/update/{id}', 'LoanController@LoanApplicationUpdate')->name('LoanApplicationUpdate');
    Route::get('collection/collect', 'CollectionController@Collect');
    Route::post('collection/collect', 'CollectionController@CollectSubmit')->name('LoanDepositSubmit');
    Route::get('collection/report', 'LoanController@collections');
    Route::post('loan/getLoansByUser', 'LoanController@getLoansByUser')->name('getLoansByUser');
    Route::post('loan/getLoanDetails', 'LoanController@getLoanDetails')->name('getLoanDetails');

    Route::get('loan/depository/{id}', 'LoanController@depository')->name('loanDepository');
    Route::post('loan/close/{id}', 'LoanController@close')->name('loanClose');

    Route::post('loan/add_reveanue', 'LoanController@add_reveanue')->name('loan.add_reveanue');
    Route::post('loan/add_interest', 'LoanController@add_interest')->name('loan.add_interest');
    Route::post('loan/fine_income', 'LoanController@fine_income')->name('loan.FineIncome');
    Route::post('loan/collect_reveanue', 'LoanController@collect_reveanue')->name('loan.collect_reveanue');
    Route::post('loan/collect_interest', 'LoanController@collect_interest')->name('loan.collect_interest');
    Route::post('loan/give_away', 'LoanController@give_away')->name('loan.give_away');
    Route::post('loan/waiver', 'LoanController@loan_waiver')->name('loan.waiver');


    Route::post('loan/add_depository', 'LoanDepositoryController@add_depository')->name('loan.add_depository');
    Route::post('loan/edit_depository/{id}', 'LoanDepositoryController@update_depository')->name('loan.update_depository');
    Route::delete('loan/delete_depository/{type}/{id}', 'LoanDepositoryController@delete_depository')->name('loan.delete_depository');


    Route::post('members/assign-share-holder', 'MemberController@assign_share_holder');
    Route::get('members/find', 'MemberController@MemberFind');
    Route::resource('members', 'MemberController');
    Route::get('get-member-data', 'MemberController@getData')->name('members.datatables.data');
    Route::get('member/edit', 'MemberController@MemberEdit');


    Route::any('members/add-to-group', 'MemberController@add_to_group');
    Route::delete('members/remove-from-group/{id}', 'MemberController@remove_from_group');
    Route::get('statement/daily', 'StatementController@daily');
    Route::get('statement/customize', 'StatementController@customize');
    Route::get('statement/daily-statement', 'StatementController@dailyStatement');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('meeting', 'MeetingController');

    //Saving


    Route::get('message','MessageController@index');
    Route::get('chat-get-messeged-user','MessageController@getMessegedUser');
    Route::get('fetch-chat-message','MessageController@FetchChatMessage')->name('FetchChatMessage');
    Route::get('submit-chat-message','MessageController@SubmitChatMessage')->name('SubmitChatMessage');


    Route::post('saving/getPackaesByType', 'SavingPackageController@getPackaesByType')->name('getPackaesByType');
    Route::post('saving/getSavingsByUser', 'SavingController@getSavingsByUser')->name('getSavingsByUser');
    Route::post('saving/getSavingDetails', 'SavingController@getSavingDetails')->name('getSavingDetails');
    Route::get('saving/find', 'SavingController@find')->name('SavingFind');
    Route::get('saving/edit/{id}', 'SavingController@SavingEdit')->name('SavingEdit');
    Route::post('saving/edit/{id}', 'SavingController@SavingUpdate')->name('SavingUpdate');
    Route::post('saving/deposit', 'SavingController@Deposit')->name('SavingDeposit');
    Route::post('saving/fine-income', 'SavingController@fine_income')->name('FineIncome');
    Route::get('saving/{type}/collection', 'SavingController@depositView');
    Route::get('saving/{type}/withdraw', 'SavingController@WithdrawView');
    Route::post('saving/withdraw', 'SavingController@Withdraw');
    Route::get('saving/{type}/list', 'SavingController@getList');
    Route::get('saving/{type}/collection-report', 'SavingController@CollectionList');
    Route::get('saving/{type}/withdraw-report', 'SavingController@WithdrawList');
    Route::get('saving-approve/{id}', 'SavingController@AdminApprove');
    Route::get('saving-decline/{id}', 'SavingController@AdminDecline');
    Route::get('saving/Remove/{id}', 'SavingController@DeleteSaving')->name('DeleteSaving');
    Route::get('saving/{type}/application', 'SavingController@application');
    Route::post('saving/application', 'SavingController@SavingApplication')->name('SavingApplication');
    Route::post('saving/daily-application', 'SavingController@SavingDailyApplication')->name('SavingDailyApplication');
    Route::post('saving/current-application', 'SavingController@SavingCurrentApplication')->name('SavingCurrentApplication');
    Route::resource('saving/{type}/packages', 'SavingPackageController');
    Route::resource('saving-transaction', 'SavingTransactionController');
    Route::post('saving/add-profit-manually', 'SavingController@ManualProfit')->name('SavingManualProfit');
    Route::post('saving/close/{id}', 'SavingController@SavingClose')->name('SavingClose');


    Route::resource('fdr-transaction', 'FdrTransactionController');
    Route::resource('loan-transaction', 'LoanTransactionController');
    Route::resource('meeting', 'MeetingController');
    Route::resource('documents', 'DocumentController');
    Route::get('transaction-head/{type}', 'TransactionHeadController@index');
    Route::resource('transaction-head', 'TransactionHeadController');
    Route::resource('transactions', 'TransactionController');

    //Income
    Route::resource('income', 'IncomeController');

    //Expense
    Route::resource('expense', 'ExpenseController');

    //FDR

    Route::get('fdr/application', 'FdrController@Application')->name('FDRApplication');
    Route::post('fdr/application', 'FdrController@ApplicationSubmit')->name('FDRApplicationSubmit');
    Route::get('fdr/list', 'FdrController@FdrList')->name('FdrList');
    Route::get('fdr-approve/{id}', 'FdrController@AdminApprove');
    Route::get('fdr-decline/{id}', 'FdrController@AdminDecline');
    Route::get('fdr/find', 'FdrController@find')->name('FdrFind');
    Route::get('fdr/withdraw', 'FdrController@withdrawForm')->name('FdrWithdrawForm');
    Route::post('fdr/withdraw', 'FdrController@withdraw')->name('FdrWithdraw');
    Route::get('fdr/withdraw-report', 'FdrController@withdrawReport')->name('withdrawReport');
    Route::get('fdr/profit-report', 'FdrController@profitReport')->name('profitReport');
    Route::post('fdr/add-profit-manually', 'FdrController@ManualProfit')->name('ManualProfit');
    Route::post('fdr/fine_income', 'FdrController@fine_income')->name('fdr.FineIncome');
    Route::post('fdr/deposit', 'FdrController@Deposit')->name('FdrDeposit');
    Route::post('fdr/getFdrsByUser', 'FdrController@getFdrsByUser')->name('getFdrsByUser');
    Route::post('fdr/getFdrDetails', 'FdrController@getFdrDetails')->name('getFdrDetails');
    Route::get('fdr/edit/{id}', 'FdrController@FdrEdit')->name('FdrEdit');
    Route::post('fdr/edit/{id}', 'FdrController@FdrUpdate')->name('FdrUpdate');

    Route::post('fdr/close/{id}', 'FdrController@close')->name('fdrClose');
    Route::get('fdr/Remove/{id}', 'FdrController@Deletefdr');

    //Printing
    Route::get('print/saving/{txn_id}', 'PrintController@saving')->name('print.saving');
    Route::get('print/fdr/{txn_id}', 'PrintController@fdr')->name('fdr.saving');
    Route::get('print/loan/{txn_id}', 'PrintController@loan')->name('loan.saving');

    //Salary
    Route::resource('hr/salary-setup', 'SalarySetupController');
    Route::resource('hr/salary-payment', 'SalaryPaymentController');

    Route::get('invoice-deposit', 'InvoiceController@DepositInvoice');
    Route::get('barcode-test/{id}', 'BarcodeController@test');


    //document
    Route::post('documents-upload', 'UploadController@upload')->name('upload');
    Route::get('documents-remove/', 'UploadController@remove')->name('document-remove');

    //Founder Deposit

    Route::post('founder-deposit/withdraw/{id}', 'FounderDepositController@withdraw');
    Route::post('founder-deposit/profit/{id}', 'FounderDepositController@profit');

    Route::resource('founder-deposit', 'FounderDepositController');


    // Web site management route

    Route::resource('blogs', 'BlogController');
    Route::resource('contacts', 'ContactController');
    Route::resource('galleries', 'GalleryController');
    // Route::post('galleries/logo', 'GalleryController@logo_add')->name('addLogo');
    // Route::post('/website-logo','GalleryController@websiteLogo')->name('website.LogoAdd');


});

