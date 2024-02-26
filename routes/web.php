<?php

use App\Mail\Notify;
use App\Models\hours;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
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

Route::get('/users', function () {
    return view('welcome');
});

//ADD MACHINE
Route::get('/addMachine', [App\Http\Controllers\MachinesController::class, 'addMachine'])->name('machine');
Route::get('/ViewMachine', [App\Http\Controllers\MachinesController::class, 'viewMachine'])->name('machine.view');

//PREPARE SCHEDULE
Route::get('/DailySchedule', [App\Http\Controllers\MachinesController::class, 'dailySchedule'])->name('daily.schedule');
Route::get('/WeeklySchedule', [App\Http\Controllers\MachinesController::class, 'weeklySchedule'])->name('weekly.schedule');

//MYPLANS
Route::get('/DailyPlan', [App\Http\Controllers\MachinesController::class, 'dailyPlan'])->name('daily.plan');
Route::get('/WeeklyPlan', [App\Http\Controllers\MachinesController::class, 'weeklyPlan'])->name('weekly.plan');
Route::get('/HourlyPlan', [App\Http\Controllers\MachinesController::class, 'hourlyPlan'])->name('hourly.plan');


//APPROVE PLAN
Route::get('/ApprovePlans', [App\Http\Controllers\MachinesController::class, 'approvePlan'])->name('approve.plan');

//ADD CHECKLIST
Route::get('/AddChecklist', [App\Http\Controllers\MachinesController::class, 'addChecklist'])->name('add.list');
Route::post('/AddChecklist', [App\Http\Controllers\MachinesController::class, 'storeList'])->name('store.list');
Route::get('/MyChecklists', [App\Http\Controllers\MachinesController::class, 'showList'])->name('show.list');

//SEARCH
Route::post('/SubmitReport', [App\Http\Controllers\MachinesController::class, 'searchList'])->name('search.list');

//REPORT
Route::post('/storeReport/{id}', [App\Http\Controllers\MachinesController::class, 'storeReport'])->name('store.report');
Route::post('/storeReportB/{id}', [App\Http\Controllers\MachinesController::class, 'storeReportB'])->name('store.reportB');

//REPORTS
Route::get('/ReceivedReports', [App\Http\Controllers\MachinesController::class, 'approveReport'])->name('report.view');
Route::get('/ApprovedReports', [App\Http\Controllers\MachinesController::class, 'final'])->name('report.final');
Route::get('/ViewReport/{id}', [App\Http\Controllers\MachinesController::class, 'view'])->name('report.print');
// Route::get('/download/{id}', [App\Http\Controllers\MachinesController::class, 'PDFDownload'])->name('report.download');

//MYREPORTS
Route::get('/SentReports', [App\Http\Controllers\MachinesController::class, 'sentReports'])->name('myreports');
Route::post('/MyReports/{id}', [App\Http\Controllers\MachinesController::class, 'myreport'])->name('report.mine');

//Update Report
Route::post('/UpdateDaily/{id}', [App\Http\Controllers\MachinesController::class, 'updateD'])->name('report.updateD');

//file
Route::get('/View/{id}/file', [App\Http\Controllers\MachinesController::class, 'file'])->name('report.file');

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/Nyongoro/Activities', [App\Http\Controllers\HomeController::class, 'Nyongoro'])->name('calendar.nyongoro');
Route::get('/Dokolo/Activities', [App\Http\Controllers\HomeController::class, 'Dokolo'])->name('calendar.dokolo');
Route::get('/Kiambere/Activities', [App\Http\Controllers\HomeController::class, 'Kiambere'])->name('calendar.kiambere');
Route::get('/7forks/Activities', [App\Http\Controllers\HomeController::class, 'Forks'])->name('calendar.forks');
Route::get('/HeadOffice/Activities', [App\Http\Controllers\HomeController::class, 'HeadOffice'])->name('calendar.HO');

