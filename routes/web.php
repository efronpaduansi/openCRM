<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\ProspekController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ExtendController;

use App\Http\Controllers\Customer\PendaftaranController;
use App\Http\Controllers\Customer\NotificationController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\TicketController;



/*
::: Frontend Routes :::
*/

Route::get('/', [WebsiteController::class, 'index'])->name('welcome');
Route::get('/pricing', [WebsiteController::class, 'pricing'])->name('pricing');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');

/*
::: Authentication Routes :::
*/
Route::group(['prefix' => 'auth'], function(){
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'doLogin'])->name('auth.dologin');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'doRegister'])->name('auth.doregister');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('/email', [EmailController::class, 'kirim_email']);

/*
::: Backend Routes :::
*/
Route::group(['prefix' => 'admin'], function () {
    // Route for dashboard
    Route::get('/', [HomeController::class, 'admin'])->name('admin.index');
    // Route for customers
    Route::get('/customers', [CustomersController::class, 'index'])->name('admin.customers.index');
    Route::post('/customers/update/{id}', [CustomersController::class, 'do_disable'])->name('admin.customers.disable');
    // Route for prospek
    Route::get('/prospek', [ProspekController::class, 'index'])->name('admin.prospek.index');
    Route::post('/prospek/{id}', [ProspekController::class, 'convert_to_client'])->name('admin.prospek.convert_to_client');
    
    Route::get('/prospek/upgrade', [ProspekController::class, 'upgrade'])->name('admin.prospek.upgrade');
    // Route for Invoices
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('admin.invoices.index');
    Route::get('/invoices/client', [InvoiceController::class, 'selectClient'])->name('admin.invoices.client');
    Route::post('/invoices/client', [InvoiceController::class, 'getByClientId'])->name('admin.invoices.get_by_client');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('admin.invoices.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::put('/invoices/{id}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/invoices/{id}', [InvoiceController::class, 'delete'])->name('invoices.delete');

    Route::get('/payments', [PaymentController::class, 'index'])->name('admin.payments.index');
    // Route for produks
    Route::get('/produk', [ProdukController::class, 'index'])->name('admin.produk.index');
    Route::post('/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('admin.produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::put('/profile/update/{id}', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
    Route::put('/profile/{id}', [ProfileController::class, 'changeProfilePhoto'])->name('admin.profile.change-profile-photo');
    Route::put('/profile/update/pass/{id}', [ProfileController::class, 'updatePass'])->name('admin.profile.update-pass');


    Route::get('/staffs', [StaffController::class, 'index'])->name('admin.staff.index');
    Route::post('/staffs', [StaffController::class, 'store'])->name('admin.staff.store');
    Route::put('/staffs/{id}', [StaffController::class, 'update'])->name('admin.staff.update');
    Route::delete('/staffs{id}', [StaffController::class, 'destroy'])->name('admin.staff.destroy');

});

Route::group(['prefix' => 'guest'], function () {
    Route::get('/', [HomeController::class, 'guest'])->name('guest.index');

    Route::get('/pilih-produk', [PendaftaranController::class, 'index'])->name('pendaftaran.index')->middleware('auth');
    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'pendaftaran'])->name('pendaftaran.create')->middleware('auth');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/produk', [PendaftaranController::class, 'list_produk'])->name('produk');
});

Route::group(['prefix' => 'client'], function () {
    Route::get('/', [HomeController::class, 'client'])->name('client.index');
    Route::get('/invoices/{id}', [InvoiceController::class, 'get_my_invoices'])->name('my.invoices');
    Route::get('/invoice/{id}', [InvoiceController::class, 'my_invoice'])->name('my.invoice');
    Route::get('/invoice/status/paid', [InvoiceController::class, 'invoicesPaid'])->name('my.invoice.paid');
    Route::get('/invoice/status/unpaid', [InvoiceController::class, 'invoicesUnpaid'])->name('my.invoice.unpaid');
    Route::get('/payment-link', [InvoiceController::class, 'payment_link'])->name('payment.link');

    Route::get('/notification/{id}', [NotificationController::class, 'showById'])->name('client.notification.show');
    Route::get('/notifications', [NotificationController::class, 'showAll'])->name('client.notifications.all');
    Route::get('/produk', [ProdukController::class, 'myPackage'])->name('client.produk.mypackage');
    Route::get('/produk/upgrade/req', [ProdukController::class, 'reqUpgrade'])->name('client.produk.req_upgrade');
    Route::get('/produk/upgrade/send_req/{id}', [ProdukController::class, 'sendReqUpgrade'])->name('client.produk.send_req_upgrade');
    Route::get('/produk/extend', [ProdukController::class, 'extend'])->name('client.produk.extend');

});
// Global routes for Tickets
Route::get('/pengaduan', [TicketController::class, 'index'])->name('pengaduan.index');
Route::get('/pengaduan/create', [TicketController::class, 'create'])->name('pengaduan.create');
Route::post('/pengaduan/store', [TicketController::class, 'store'])->name('pengaduan.store');
Route::get('/pengaduan/show/{no}', [TicketController::class, 'show'])->name('pengaduan.show');

// Informasi perpanjangan langganan
Route::get('/extend', [ExtendController::class, 'index'])->name('extend.index');
Route::post('/extend', [ExtendController::class, 'send'])->name('extend.send');
Route::put('/extend', [ExtendController::class, 'update'])->name('extend.update');
Route::put('/extend/reject', [ExtendController::class, 'reject'])->name('extend.reject');