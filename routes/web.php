<?php

use App\Http\Controllers\AboutContentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\changeStatusController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\deleteController;
use App\Http\Controllers\HeadingController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\IndexContentController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RentEnquiryController;
use App\Http\Controllers\RentstudioController;
use App\Http\Controllers\ShortsController;
use App\Http\Controllers\ShowAssignController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\ShowTypeController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\TestMailController;
use App\Http\Controllers\UpdatePositionController;
use App\Http\Controllers\WebContactController;
use App\Http\Controllers\WebsiteController;
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


Route::get('/', [WebsiteController::class, 'index'])->name('index');
Route::get('/index', [WebsiteController::class, 'index'])->name('index');
Route::get('/DPDP_Act', [WebsiteController::class, 'DPDP_Act'])->name('DPDP_Act');
Route::get('/show', [WebsiteController::class, 'index'])->name('show');
Route::get('/shorts', [WebsiteController::class, 'index'])->name('shorts');
Route::get('/contact', [WebsiteController::class, 'index'])->name('contact');
Route::get('about', [WebsiteController::class, 'about'])->name('about');
Route::get('showdetails/{title}/{subtitle}/{id}', [WebsiteController::class, 'ShowDetails'])->name('showdetails');
Route::get('rentstudiodetails', [WebsiteController::class, 'rentstudiodetails'])->name('rentstudiodetails');
Route::get('/privacy-policy', [WebsiteController::class, 'privacypolicy'])->name('privacypolicy');

Route::get('/terms-and-conditions', [WebsiteController::class, 'termsandconditions'])->name('termsandconditions');
Route::post('send-mail', [MailController::class, 'index'])->middleware('throttle:2,1')->name('sendmail');
Route::post('rentenquiry', [WebsiteController::class, 'rentenquiry'])->middleware('throttle:2,1')->name('rentenquiry');

Route::fallback(function () {
    return redirect('/');
});
//admin---------------------------------------------------------------------------------

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('admin.guest')->group(function () {
        Route::get('/', [AuthController::class, 'index'])->name('login');

        Route::post('/', [AuthController::class, 'login'])->name('logindata');

        Route::get('/registration', [AuthController::class, 'registration'])->name('registration');

        Route::post('/registration', [AuthController::class, 'registrationdata'])->name('registrationdata');
    });
    Route::middleware('admin.auth')->group(function () {

        //Admin Section

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/adminprofile', [AdminController::class, 'adminprofile'])->name('adminprofile');

        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

        Route::post('/adminprofile', [AdminController::class, 'adminprofile'])->name('updateProfileImg');

        Route::patch('/adminprofile', [AdminController::class, 'adminprofile'])->name('updateProfile');

        Route::post('/changeStatus', [changeStatusController::class, 'changeStatus'])->name('changeStatus');

        Route::post('/changePublicationStatus', [changeStatusController::class, 'changePublicationStatus'])->name('changePublicationStatus');
        Route::get('/changePassword', [AdminController::class, 'changePasswordShow'])->name('changePassword');

        Route::put('/changePassword', [AdminController::class, 'changePassword'])->name('changePassworddata');

        Route::delete('/deleteData', [deleteController::class, 'destroy'])->name('DeleteData');

        //Contact Details

        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        //Rent Enquiry Details

        Route::get('/rentenquirydetails', [RentEnquiryController::class, 'index'])->name('rentenquirydetails');

        //update position 

        Route::post('/updatePositions', [UpdatePositionController::class, 'index'])->name('updatePositions');

        //Show Section

        Route::get('/show', [ShowController::class, 'index'])->name('show');

        Route::post('/addshow', [ShowController::class, 'save'])->name('addshow');

        Route::get('/editshow/{id}', [ShowController::class, 'index'])->name('editshow');
        //Show Section

        Route::get('/rentstudio', [RentstudioController::class, 'index'])->name('rentstudio');

        Route::post('/addrentstudio', [RentstudioController::class, 'save'])->name('addrentstudio');

        Route::get('/editrentstudio/{id}', [RentstudioController::class, 'index'])->name('editrentstudio');

        //Show Type Section

        Route::get('/showtype', [ShowTypeController::class, 'index'])->name('showtype');

        Route::post('/addshowtype', [ShowTypeController::class, 'save'])->name('addshowtype');

        Route::get('/editshowtype/{id}', [ShowTypeController::class, 'index'])->name('editshowtype');

        Route::delete('/DeleteShowType', [ShowTypeController::class, 'destroy'])->name('DeleteShowType');

        //Show Assign Section

        Route::get('/showassign', [ShowAssignController::class, 'index'])->name('showassign');

        Route::post('/addshowassign', [ShowAssignController::class, 'save'])->name('addshowassign');

        Route::get('/editshowassign/{id}', [ShowAssignController::class, 'index'])->name('editshowassign');

        //Shorts Section

        Route::get('/shorts', [ShortsController::class, 'index'])->name('shorts');

        Route::post('/addshortsassign', [ShortsController::class, 'save'])->name('addshorts');

        Route::get('/editshortsassign/{id}', [ShortsController::class, 'index'])->name('editshorts');

        //Shorts Section

        Route::get('/teammember', [TeamMemberController::class, 'index'])->name('teammember');

        Route::post('/addteammember', [TeamMemberController::class, 'save'])->name('addteammember');

        Route::get('/editteammember/{id}', [TeamMemberController::class, 'index'])->name('editteammember');


        //Heading Section

        Route::get('/heading', [HeadingController::class, 'index'])->name('heading');

        Route::post('/addheading', [HeadingController::class, 'save'])->name('addheading');

        Route::get('/editheading/{id}', [HeadingController::class, 'index'])->name('editheading');


        //IndexContent Section

        Route::get('/indexcontent', [IndexContentController::class, 'index'])->name('indexcontent');

        Route::post('/addindexcontent', [IndexContentController::class, 'save'])->name('addindexcontent');

        Route::get('/editindexcontent/{id}', [IndexContentController::class, 'index'])->name('editindexcontent');


        //AboutContent Section

        Route::get('/aboutcontent', [AboutContentController::class, 'index'])->name('aboutcontent');

        Route::post('/addaboutcontent', [AboutContentController::class, 'save'])->name('addaboutcontent');

        Route::get('/editaboutcontent/{id}', [AboutContentController::class, 'index'])->name('editaboutcontent');


        //Social Media Section

        Route::get('/socialmedia', [SocialMediaController::class, 'show'])->name('socialmedia');

        //Web Contact Section

        Route::get('/webcontact', [WebContactController::class, 'show'])->name('webcontact');

        Route::get('image-upload', [ImageUploadController::class, 'imageUpload'])->name('image.upload');
        Route::post('image-upload', [ImageUploadController::class, 'imageUploadPost'])->name('image.upload.post');
    });
});
Route::get('send-mail', [TestMailController::class, 'index']);
