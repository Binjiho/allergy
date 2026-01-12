<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// main
Route::controller(\App\Http\Controllers\Admin\Main\MainController::class)->group(function () {
    Route::get('/', 'main')->name('main');
    Route::post('data', 'data')->name('main.data');
});

// M1 member
Route::controller(\App\Http\Controllers\Admin\Member\MemberController::class)->prefix('member')->group(function () {
    Route::get('/{case?}', 'index')->where('case', 'levelN|levelA|levelB|levelC|levelD|withdraw|elimination|admin')->name('member');
    Route::get('upsert/{sid}', 'upsert')->name('member.upsert');
    Route::get('popup/search', 'popupSearch')->name('member.popup.search');

    Route::get('offline', 'offline')->name('memberoff');
    Route::get('offline/upsert/{sid}', 'offlineUpsert')->name('memberoff.upsert');

    Route::get('excel', 'excel')->name('member.excel');
    Route::post('data', 'data')->name('member.data');
});

//M2 회비
Route::controller(\App\Http\Controllers\Admin\Fee\FeeController::class)->prefix('fee')->group(function () {
    Route::get('/{case?}', 'index')->where('case', 'full|unpaid')->name('fee');
    Route::get('popup/all-list/{user_sid}', 'allList')->name('fee.popup.all-list');
    Route::get('upsert/{sid?}', 'upsert')->name('fee.upsert');
    Route::get('receipt/{sid?}', 'receipt')->name('fee.receipt');
    Route::get('remail/{sid?}', 'remail')->name('fee.remail');
    Route::get('excel/{case?}', 'excel')->where('case', 'full|unpaid')->name('fee.excel');
    Route::post('data', 'data')->name('fee.data');
});

//M3 국외학술대회지원관리
Route::controller(\App\Http\Controllers\Admin\Overseas\OverseasController::class)->prefix('overseas')->group(function () {
    Route::get('/', 'index')->name('overseas');
    Route::get('upsert/{sid?}', 'upsert')->name('overseas.upsert');
    Route::get('remail/{sid?}', 'remail')->name('overseas.remail');
    Route::get('excel', 'excel')->name('overseas.excel');
    Route::post('data', 'data')->name('overseas.data');

    // apply
    Route::controller(\App\Http\Controllers\Admin\Overseas\ApplyController::class)->prefix('{o_sid}/apply')->group(function() {
        Route::get('/', 'index')->name('apply');
        Route::get('modify/{sid}', 'modify')->name('apply.modify');
        Route::get('report_modify/{sid}', 'report_modify')->name('apply.report_modify');
        Route::get('all-judge-change', 'allJudgeChange')->name('apply.all-judge-change');
        Route::get('memo', 'memo')->name('apply.memo');

        Route::get('excel', 'excel')->name('apply.excel');
        Route::get('completeZip', 'completeZip')->name('apply.completeZip');
        Route::get('reportZip', 'reportZip')->name('apply.reportZip');
        
        Route::post('data', 'data')->name('apply.data');
    });

});

Route::controller(\App\Http\Controllers\Admin\Grantees\GranteesController::class)->prefix('grantees')->group(function () {
    Route::get('/', 'index')->name('grantees');
    Route::get('upsert/{sid?}', 'upsert')->name('grantees.upsert');
    Route::get('collective', 'collective')->name("grantees.collective");
    Route::get('memo', 'memo')->name('grantees.memo');
    Route::get('excel', 'excel')->name('grantees.excel');
    Route::post('data', 'data')->name('grantees.data');
});

// 학술행사 M4
Route::prefix('workshop')->group(function() {
    Route::controller(\App\Http\Controllers\Admin\Workshop\WorkshopController::class)->group(function() {
        Route::get('/', 'index')->name('workshop');
        Route::get('upsert/{sid?}', 'upsert')->name('workshop.upsert');

        Route::post('data', 'data')->name('workshop.data');
    });

    // 상세
    Route::controller(\App\Http\Controllers\Admin\Workshop\DetailController::class)->prefix('{wsid}/detail')->group(function() {
        Route::get('/', 'index')->name('detail');
        Route::get('/upsert/{sid?}', 'upsert')->name('detail.upsert');

        Route::get('collective', 'collective')->name("detail.collective");
        Route::get('/excel', 'excel')->name('detail.excel');
        Route::post('data', 'data')->name('detail.data');
    });
});
//교육강좌
Route::prefix('education')->group(function() {
    Route::controller(\App\Http\Controllers\Admin\Education\EducationController::class)->group(function() {
        Route::get('/', 'index')->name('education');
        Route::get('upsert/{sid?}', 'upsert')->name('education.upsert');

        Route::post('data', 'data')->name('education.data');
    });

    // 사전등록
    Route::controller(\App\Http\Controllers\Admin\Education\RegistrationController::class)->prefix('{wsid}/registration')->group(function() {
        Route::get('/', 'index')->name('registration');
        Route::get('/upsert/{sid?}', 'upsert')->name('registration.upsert');
        Route::get('office_search', 'office_search')->name('registration.office_search');

        Route::get('/receipt/{sid}', 'receipt')->name('registration.receipt');
        Route::get('/memo', 'memo')->name('registration.memo');
        Route::get('resend/{sid}', 'resend')->name('registration.resend');

        Route::get('collective', 'collective')->name("registration.collective");
        Route::get('/excel', 'excel')->name('registration.excel');
        Route::post('data', 'data')->name('registration.data');
    });
});

// 메일
Route::prefix('mail')->group(function () {
    Route::controller(\App\Http\Controllers\Admin\Mail\MailController::class)->group(function () {
        Route::get('/', 'index')->name("mail");
        Route::get('detail/{sid}', 'detail')->name("mail.detail");
        Route::get('upsert/{sid?}', 'upsert')->name("mail.upsert");
        Route::get('preview/{sid}', 'preview')->name("mail.preview");
        Route::post('data', 'data')->name('mail.data');
    });

    Route::controller(\App\Http\Controllers\Admin\Mail\MailAddressController::class)->prefix('address')->group(function () {
        Route::get('/', 'index')->name("mail.address");
        Route::get('upsert/{sid?}', 'upsert')->name("mail.address.upsert");

        Route::prefix('detail')->group(function () {
            Route::get('{ma_sid}', 'detail')->name("mail.address.detail");
            Route::get('{ma_sid}/upsert-{type}/{sid?}', 'detailUpsert')->name("mail.address.detail.upsert");
        });

        Route::post('data', 'data')->name('mail.address.data');
    });
});

// 접속통계
Route::controller(\App\Http\Controllers\Admin\Stat\StatController::class)->prefix('stat')->group(function () {
    Route::get('/', 'index')->name("stat");
    Route::get('referer', 'referer')->name("stat.referer");
    Route::get('data', 'data')->name("stat.data");
});

// auth
Route::controller(\App\Http\Controllers\Admin\Auth\LoginController::class)->prefix('auth')->group(function () {
    Route::post('logout', 'logout')->name('logout');
});

require __DIR__ . '/common.php';
