<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\LogCallController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\AddressesController;
use App\Http\Controllers\CorporateAppointments;
use App\Http\Controllers\AddressProviderController;
use App\Http\Controllers\TaxReturnController;
use App\Http\Controllers\TestEmailController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TaxReturnAccountController;
use App\Http\Controllers\MediaSecurelyController;
use App\Http\Controllers\CompanyFollowwingController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\InvoicingController;
use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\TaxReturnsViewController;
use App\Http\Controllers\PassportClientController;
use App\Http\Controllers\TaskTemplateController;
use App\Http\Controllers\TaskSetController;


Route::controller(PassportClientController::class)->group(function () {

    Route::get('/create_client', 'create');
    Route::get('/redirect', 'redirect_client');
    Route::get('/auth/callback', 'auth_callback');

});


// Route::get('/redirect', function (Request $request) {

//     $request->session()->put('state', $state = Str::random(40));

//     $query = http_build_query([
//         'client_id' => '4',
//         'redirect_url' => 'https://ava/auth/callback',
//         'response_type' => 'code',
//         'scope' => '',
//         'state' => '123addsdsds',
//     ]);

//     return redirect('https://ava/oauth/authorize?'.$query);
// });


// Route::get('/auth/callback', function (Request $request) {
        
//     $state = $request->session()->pull('state');

//     throw_unless(
//         strlen($state) > 0 && $state === $request->state,
//         InvalidArgumentException::class
//     );

//     $response = Http::asForm()->post('https://ava/oauth/token', [
//         'grant_type' => 'authorization_code',
//         'client_id' => '4',
//         'client_secret' => 'Zj9PMZPbeOAJhgCgZDAnAKCE5WhYWc9gzwL2jMPr',
//         'redirect_url' => 'https://ava/auth/callback',
//         'code' => $request->code,
//         ]);
//         // dump($request->code);
//         // dump($response);
//         // dd($response->json());

//     return $response->json();
// });

Route::controller(ApiTokenController::class)->group(function () {

    Route::get('/reg-app', 'index')->name('reg_app');
    

    Route::post('/add_app', 'add_app')->name('add_app');
//    Route::post('/update-profile', 'update_profile')->name('update_profile');

});

// Route::get('files/{filePath}', [MediaSecurelyController::class, 'file_securely'])->middleware('auth')->where('filePath', '.*');
Route::controller(TestEmailController::class)->group(function () {

    Route::get('/test', 'index')->name('test');
    
    Route::get('/create-email', 'create_email')->name('create_email');
    Route::get('/emails', 'all_emails')->name('all_emails');
    Route::get('/email', 'email')->name('email');
    Route::post('/delete_mailbox_email', 'delete_email')->name('delete_mailbox_email');
//    Route::post('/update-profile', 'update_profile')->name('update_profile');

});

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

// Route::get('/register', function(){
//     return redirect()->route('login');
// });

Route::controller(PDFController::class)->group(function () {

    // Route::get('pdfview',array('as'=>'pdfview','uses'=>'pdfview'));
    Route::get('/pdfview', 'pdfview')->name('pdfview')->middleware('auth');
    Route::get('/create_pdf', 'create_pdf')->name('create_pdf')->middleware('auth');
    Route::get('/pdf2', 'pdf2')->name('pdf2')->middleware('auth');
    
    Route::post('/edit_pdf', 'edit_pdf')->name('edit_pdf')->middleware('auth');
    Route::post('/edit_pdf_4868', 'edit_pdf_4868')->name('edit_pdf_4868')->middleware('auth');
    Route::get('/test-pgf', 'pdf_to_json')->name('edit_pdf_4868_test')->middleware('auth');
    Route::get('/info_reader', 'info_reader')->name('info_reader')->middleware('auth');

    
    // Route::post('/pdfview', 'pdfview')->name('pdfview')->middleware('auth');

});


Route::controller(ServicesController::class)->group(function () {

    Route::get('/services', 'index')->name('services')->middleware('auth');
    Route::post('/new_service', 'new_service')->name('new_service')->middleware('auth');
    Route::post('/edit_service', 'edit_service')->name('edit_service')->middleware('auth');
    Route::get('/delete_service/{id}', 'delete_service')->name('delete_service')->middleware('auth');
    Route::get('/Dtservice', 'Dtservice')->name('Dtservice')->middleware('auth');
});

Route::controller(SalesController::class)->group(function () {
    Route::post('/new_sales', 'new_sales')->name('new_sales')->middleware('auth');
    Route::post('/edit_sales', 'edit_sales')->name('edit_sales')->middleware('auth');
    Route::get('/delete_sales/{id}', 'delete_sales')->name('delete_sales')->middleware('auth');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(UserController::class)->group(function () {

    Route::get('/profile', 'profile')->name('profile')->middleware('auth');
    Route::post('/update-profile', 'update_profile')->name('update_profile')->middleware('auth');

});

Route::controller(AddressProviderController::class)->group(function () {
    Route::get('/address-providers','index')->name('address_providers')->middleware('admin');
    Route::post('/add_address_providers', 'add_address_providers')->name('add_address_providers')->middleware('admin');
    Route::post('/update_address_provider', 'update')->name('update_address_provider')->middleware('admin');
    Route::get('/delete_address_provider/{id}', 'delete_address_provider')->name('delete_address_provider')->middleware('admin');
});

Route::controller(CorporateAppointments::class)->group(function () {
    Route::get('/corporate-appointments','index')->name('corporate_appointments')->middleware('auth');
    Route::post('/add_corporate_appointments', 'add_corporate_appointments')->name('add_corporate_appointments')->middleware('auth');
    Route::post('/update_corporate_appointments', 'update')->name('update_corporate_appointments')->middleware('auth');
    Route::get('/delete_corporate_appointments/{id}', 'delete_corporate_appointments')->name('delete_corporate_appointments')->middleware('auth');
});

Route::controller(AddressesController::class)->group(function () {
    Route::get('/addresses','index')->name('addresses')->middleware('admin');
    Route::post('/add_address', 'add_address')->name('add_address')->middleware('admin');
    Route::post('/update_address/{id}', 'update')->name('update_address')->middleware('auth');
    Route::post('/update_address_edit', 'update')->name('update_address_edit')->middleware('auth');
    Route::get('/address/{id}', 'edit')->name('edit_address')->middleware('auth');
    Route::get('/delete_address/{id}', 'delete_address')->name('delete_address')->middleware('admin');
    Route::post('/get_states', 'get_states')->name('get_states')->middleware('auth');
    Route::post('/add_relation_address', 'add_relation_address')->name('add_relation_address')->middleware('auth');
    Route::post('/new_relation_address', 'new_relation_address')->name('new_relation_address')->middleware('auth');
    Route::get('/{url}/{id}/addresses', 'address_by_url')->name('address_by_url')->middleware('admin');

    Route::post('/update_options', 'update_options')->name('user_update_options')->middleware('admin');
    Route::get('/IRS-Standard-Correspondence-Address', 'show_IRS_Standard_Correspondence_Address')->name('show_IRS_Standard_Correspondence_Address')->middleware('admin');
    Route::get('/Dtall_addresses','Dtall_addresses')->name('Dtall_addresses')->middleware('admin');
});

Route::controller(AccountsController::class)->group(function () {
    Route::get('/accounts', 'index')->name('accounts')->middleware('auth');
    Route::get('/Dtaccounts', 'Dtaccounts')->name('Dtaccounts')->middleware('auth');
    Route::post('/add_account', 'add_account')->name('add_account')->middleware('auth');
    Route::match(['post', 'get'], '/account/{id}', 'edit_account')->name('edit_account')->middleware('auth');
    Route::get('/delete_account/{id}', 'delete_account')->name('delete_account')->middleware('auth');
    Route::post('/get_parent_account_ajax', 'get_parent_account_ajax')->name('get_parent_account_ajax')->middleware('auth');
    Route::post('/send_email/{id}', 'send_email')->name('send_email')->middleware('auth');
    Route::get('/delete_email/{email_id}/{account_id}', 'delete_email')->name('delete_email')->middleware('auth');
});

Route::controller(ContactsController::class)->group(function () {
    Route::get('/contacts','index')->name('contacts')->middleware('auth');
    Route::post('/add_contact', 'add_contact')->name('add_contact')->middleware('auth');
    Route::match(['post', 'get'],'/contact/{id}', 'edit_contact')->name('edit_contact')->middleware('auth');
    Route::get('/delete_contact/{id}', 'delete_contact')->name('delete_contact')->middleware('auth');
    Route::get('/contacts/{id}/account', 'contacts_by_account')->name('contacts_by_account')->middleware('auth');
    Route::get('/get_contacts', 'Dtcontacts')->name('Dtcontacts')->middleware('auth');
});

Route::controller(CompaniesController::class)->group(function () {
    Route::get('/companies/{by?}','index')->name('companies')->middleware('auth');
    Route::post('/create_company', 'store')->name('create_company')->middleware('auth');
    Route::post('/update-company/{id}', 'update')->name('edit-company')->middleware('auth');
    Route::get('/company/{id}', 'edit')->name('edit_company')->middleware('auth');
    Route::get('/destroy_company/{id}', 'destroy')->name('destroy_company')->middleware('auth');
    Route::get('/companies/{id}/account', 'companies_by_account')->name('companies_by_account')->middleware('auth');
    Route::post('/uploade_file_company', 'uploade_file_company')->name('uploade_file_company')->middleware('auth');
    Route::post('/update_file_company', 'update_file_company')->name('update_file_company')->middleware('auth');
    Route::post('/create_tax_returns', 'create_tax_returns')->name('create_tax_returns')->middleware('auth');
    Route::post('/create_tax_returnspull2', 'create_tax_returnspull2')->name('create_tax_returnspull2')->middleware('auth');
    Route::get('/delete_tax_returns/{id}', 'delete_tax_returns')->name('delete_tax_returns')->middleware('auth');
    Route::post('/get_sorting_companies', 'get_sorting_companies')->name('get_sorting_companies')->middleware('auth');
    Route::post('/filter_companies_by_division', 'filter_companies_by_division')->name('filter_companies_by_division')->middleware('auth');
    Route::post('/prepare_tax_return_modal', 'prepare_tax_return_modal')->name('prepare_tax_return_modal')->middleware('auth');
    Route::post('/following_company', 'following_company')->name('following_company')->middleware('auth');
    Route::post('/delete_following_company', 'delete_following_company')->name('delete_following_company')->middleware('auth');
    Route::post('/disengage_company', 'disengage_company')->name('disengage_company')->middleware('auth');
    Route::get('/Dtcompanies', 'Dtcompanies')->name('Dtcompanies')->middleware('auth');
    
});

Route::controller(CompanyFollowwingController::class)->group(function () {
    Route::post('/following_company', 'following_company')->name('following_company')->middleware('auth');
    Route::get('/delete_following_company/{id}', 'delete_following_company')->name('delete_following_company')->middleware('auth');
});

Route::controller(TaxReturnController::class)->group(function () {

    Route::post('/create_tax_returns', 'create_tax_returns')->name('create_tax_returns')->middleware('auth');
    Route::post('/create_tax_returnspull2', 'create_tax_returnspull2')->name('create_tax_returnspull2')->middleware('auth');
    Route::post('/edit_tax_returns', 'edit_tax_returns')->name('edit_tax_returns')->middleware('auth');
    Route::get('/delete_tax_returns/{id}', 'delete_tax_returns')->name('delete_tax_returns')->middleware('auth');
    Route::get('/{url}/{id}/tax-return', 'tax_returns_by_url')->name('tax_returns_by_url')->middleware('auth');
    Route::post('/get_prev_year', 'get_prev_year')->name('get_prev_year')->middleware('auth');
});

Route::controller(TaxReturnsViewController::class)->group(function () {
    Route::get('tax-returns', 'tax_returns')->name('tax_returns')->middleware('auth');
    Route::post('/year_filter_tax_returns', 'year_filter_tax_returns')->name('year_filter_tax_returns')->middleware('auth');
    Route::post('/sort_by_name_tax_returns', 'sort_by_name_tax_returns')->name('sort_by_name_tax_returns')->middleware('auth');
    Route::get('DttaxReturnd', 'DttaxReturnd')->name('DttaxReturnd')->middleware('auth');
});

Route::controller(TaxReturnAccountController::class)->group(function () {

    Route::post('/create_tax_returns_account', 'create_tax_returns_account')->name('create_tax_returns_account')->middleware('auth');
    Route::post('/create_tax_returnspull2_account', 'create_tax_returnspull2_account')->name('create_tax_returnspull2_account')->middleware('auth');
    Route::post('/edit_tax_returns_account', 'edit_tax_returns_account')->name('edit_tax_returns_account')->middleware('auth');
    Route::get('/delete_tax_returns_account/{id}', 'delete_tax_returns')->name('delete_tax_returns_account')->middleware('auth');
    Route::get('/{url}/{id}/tax-return-account', 'tax_returns_by_url_account')->name('tax_returns_by_url_account')->middleware('auth');
    Route::post('/get_prev_year_tax_return_account', 'get_prev_year_tax_return_account')->name('get_prev_year_tax_return_account')->middleware('auth');
    
});

Route::controller(LogCallController::class)->group(function () {
    Route::get('/log-call/{id}/{url}', 'get_call')->name('log_call')->middleware('auth');
    Route::post('/add_log_call','add_log_call')->name('add_log_call')->middleware('auth');
    Route::post('/edit_call', 'edit_call')->name('edit_call')->middleware('auth');
    Route::get('/delete_call/{id}/{url}', 'delete_call')->name('delete_call')->middleware('auth');
});

Route::controller(TaskController::class)->group(function () {
    Route::get('/task/{id}/{url}', 'get_task')->name('task')->middleware('auth');
    Route::post('/add_task','add_task')->name('add_task')->middleware('auth');
    Route::post('/edit_task', 'edit_task')->name('edit_task')->middleware('auth');
    Route::get('/delete_task/{id}/{url}', 'delete_task')->name('delete_task')->middleware('auth');
});

Route::controller(EventController::class)->group(function () {
    Route::get('/event/{id}/{url}', 'get_event')->name('event')->middleware('auth');
    Route::post('/add_event','add_event')->name('add_event')->middleware('auth');
    Route::post('/edit_event', 'edit_event')->name('edit_event')->middleware('auth');
    Route::get('/delete_event/{id}/{url}', 'delete_event')->name('delete_event')->middleware('auth');
});

Route::controller(NotesController::class)->group(function () {
    Route::post('/add_notes','add_notes')->name('add_notes')->middleware('auth');
    Route::post('/edit_notes/{id}', 'edit_notes')->name('edit_notes')->middleware('auth');
    Route::get('/delete_notes/{id}', 'delete_notes')->name('delete_notes')->middleware('auth');
    Route::get('/{url}/{id}/notes', 'get_notes')->name('notes')->middleware('auth');
});

Route::controller(FilesController::class)->group(function () {
    Route::post('/add_files','add_files')->name('add_files')->middleware('auth');
    Route::post('/edit_files', 'edit_files')->name('edit_files')->middleware('auth');
    Route::get('/delete_files/{id}', 'delete_files')->name('delete_files')->middleware('auth');
    Route::get('/{url}/{id}/files', 'get_files')->name('files')->middleware('auth');
    Route::post('/search_file', 'search_file')->name('search_file')->middleware('auth');
});

Route::controller(SendEmailController::class)->group(function () {
    Route::post('/send_email', 'send_email')->name('send_email')->middleware('auth');
    Route::get('/delete_email/{email_id}/', 'delete_email')->name('delete_email')->middleware('auth');
    Route::get('/email-notafications', 'email_notifications')->name('email_notifications')->middleware('admin');
    Route::post('/save_email_notafication', 'save_email_notafication')->name('save_email_notafication')->middleware('auth');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('test-google', function() {
    Storage::disk('google')->put('test.txt', 'Hello World');
});

Route::controller(InvoicingController::class)->group(function () {
    Route::get('/invoicings', 'invoicings')->name('invoicings')->middleware('auth');
    Route::get('/invoicings/Projected-Revenues', 'projected_revenues')->name('projected_revenues')->middleware('auth');
    Route::post('/sales_year_filter', 'sales_year_filter')->name('sales_year_filter')->middleware('auth');
    Route::get('/Dtinvoicings', 'Dtinvoicings')->name('Dtinvoicings')->middleware('auth');

});

Route::controller(TaskTemplateController::class)->group(function () {
    Route::get('/task-template', 'index')->name('task_template')->middleware('admin');
    Route::post('/create_task_template', 'store')->name('create_task_template')->middleware('admin');
    Route::get('/delete_task_template{id}', 'destroy')->name('delete_task_template')->middleware('admin');
    Route::post('/edit_task_template', 'update')->name('edit_task_template')->middleware('admin');
    Route::get('/Dtask_template', 'Dtask_template')->name('Dtask_template')->middleware('auth');
});

Route::controller(TaskSetController::class)->group(function () {
    Route::get('/task-set', 'index')->name('task_set')->middleware('admin');
    Route::post('/create_task_set', 'store')->name('create_task_set')->middleware('admin');
    Route::post('/add_task_set_company', 'add_task_set_company')->name('add_task_set_company')->middleware('admin');
    Route::get('/delete_task_set{id}', 'destroy')->name('delete_task_set')->middleware('admin');
    Route::post('/edit_task_set', 'update')->name('edit_task_set')->middleware('admin');
    Route::get('/Dtask_set', 'Dtask_set')->name('Dtask_set')->middleware('auth');
});

Route::controller(GoogleDriveController::class)->group(function () {
    Route::get('/google-drive-auth', 'auth_google')->name('google.drive.auth')->middleware('auth');
    Route::get('/google-drive-callback', 'callback')->name('callback')->middleware('auth');
    Route::get('/google-drive-list', 'list')->name('google.drive.list')->middleware('auth');
    Route::post('/google-drive-upload', 'upload')->name('google.drive.upload')->middleware('auth');
    Route::get('/google-upload_form', 'upload_form')->name('upload_form')->middleware('auth');
});

