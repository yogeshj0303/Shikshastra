<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NotificationApiController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobPostController; 
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EmpController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\EmployerDashboardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PricingPlanController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\StoriesController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AllcvController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\TopicDetailsController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\EmployeeApiController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\ApplyJobController;
use App\Http\Controllers\MidAuthController;
use App\Http\Controllers\AuthFileController;
use App\Http\Controllers\Api\ApplyInternshipController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SamplePaperController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\SeoController;
use Laravel\Socialite\Facades\Socialite;

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


//--------------------Job Seekers Work By Priya and Piyush-------------------------//

Route::get('/home-page', function () {
    return view('index');
});
Route::get('/gallery', function () {
    return view('frontend.gallery');
});

Route::get('/all-blogs', function () {
    return view('frontend.allblogs');
});

// Route::get('/chapter-details', function () {
//     return view('frontend.chapter-details');
// });
Route::get('chapter-details/{chapterID}',[NoteController::class,'frontIndex'])->name('chapter-details');

Route::get('view-subject/{subjectId}',[FrontendController::class,'index'])->name('view-subject');
Route::get('get-subject/{classId}',[FrontendController::class,'getSubject'])->name('get-subject');
// Route::get('saved_internship', function () {
//     return view('Front-end.saved_internship');
// })->name('saved_internship');

//--------------------------------Admin Access Work By Priya Shrivastava-------------------------------//
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/admin-login', function () {
    return view('admin.admin-login');
});
Route::get('enquiry', function () {
    return view('admin.enquiry.index');
});
Route::get('/contact-us', function () {
    return view('frontend.contact-us');
});
Route::get('/about-us', function () {
    return view('frontend.about-us');
});
Route::get('/blog-details/{id}',  [BlogController::class, 'show'])->name('blog-details');

Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');
Route::delete('/enquiry/{id}', [EnquiryController::class, 'destroy'])->name('enquiry.destroy');
Route::get('logout', [AdminLoginController::class,'logout'])->name('admin.logout');
//-------------------------------Admin Panel Data add ------Work By Priya Shrivastava-----------------//
Route::resource('plan_up', PlanController::class); 
Route::get('plan-delete/{id}',[PlanController::class,'destroy'])->name('plan-delete');
Route::post('plan_up_update/{id}',[PlanController::class,'update'])->name('plan_up_update');

Route::resource('blog',BlogController::class);
Route::get('blog-delete/{id}',[BlogController::class,'destroy'])->name('blog-delete');

Route::resource('blog-category',BlogCategoryController::class);
Route::get('blog-cat/{id}',[BlogCategoryController::class,'destroy'])->name('blog-cat');
Route::resource('faq',FaqController::class);
Route::resource('topic-detail',TopicDetailsController::class);
Route::resource('faqcategory',FaqCategoryController::class);
Route::resource('subject',SubjectController::class);
Route::resource('chapter',ChapterController::class);
Route::resource('seo',SeoController::class);
Route::resource('back-gallery',GalleryController::class);
Route::resource('sample-paper',SamplePaperController::class);
Route::resource('notes', NoteController::class);
// Route::delete('/notes', [NoteController::class, 'destroy'])->name('notes.destroy');
// Route::get('/notes/{id}/edit', [NoteController::class, 'edit'])->name('notes.edit');

Route::get('/get-subjects/{class_id}', [NoteController::class, 'getSubjects'])->name('get-subjects');
Route::get('/get-chapters/{subject_id}', [NoteController::class, 'getChapters'])->name('get-chapters');
Route::get('/sample-paper-details/{sample_id}', [FrontendController::class, 'getSamplePaper'])->name('sample-paper-details');

//   Route::get('sample-paper/{id}/edit', [SamplePaperController::class, 'edit'])->name('sample-paper.edit');
//     Route::put('sample-paper/{id}', [SamplePaperController::class, 'update'])->name('sample-paper.update');


Route::resource('location',LocationController::class);
Route::resource('contact1',ContactController::class);
Route::resource('category',CategoryController::class);
Route::get('category-delete/{id}',[CategoryController::class,'destroy'])->name('category-delete');
Route::resource('benefits',DepartmentController::class);
Route::post('notifystoreview', [NotificationApiController::class, 'store']);
Route::post('notifystorereject', [NotificationApiController::class, 'strReject']);
//---------------------------End Resource Routes-------------------------------//




Route::get('/adminlogin',[AdminLoginController::class,'adlogin'])->name('adlogin');
Route::post('admlogin', [AdminLoginController::class, 'admlogin']);


// Route::get('Employer_dashboard',[EmployerDashboardController::class,'showDashboard'])->name('Employer_dashboard');

Route::get('change-password', [AdminLoginController::class, 'changePassword'])->name('changepass');
Route::post('change-password', [AdminLoginController::class, 'changPasswordStore'])->name('change.password');
