<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// main
Route::controller(\App\Http\Controllers\Main\MainController::class)->group(function () {
    Route::get('/', 'main')->name('main');
    Route::post('data', 'data')->name('main.data');
});

// intro M1
Route::controller(\App\Http\Controllers\Intro\IntroController::class)->prefix('intro')->group(function () {
    Route::get('greeting', 'greeting')->name('intro.greeting');
    Route::get('history', 'history')->name('intro.history');
    Route::get('mission', 'mission')->name('intro.mission');
    Route::get('regulation', 'regulation')->name('intro.regulation');
    Route::get('executive', 'executive')->name('intro.executive');
    Route::get('committee', 'committee')->name('intro.committee');
    Route::get('councilor', 'councilor')->name('intro.councilor');
    Route::get('branch', 'branch')->name('intro.branch');
    Route::get('research', 'research')->name('intro.research');
    Route::get('direction', 'direction')->name('intro.direction');

});

// news M2
Route::controller(\App\Http\Controllers\News\NewsController::class)->prefix('news')->group(function () {
    Route::get('prize', 'prize')->name('news.prize');
    Route::get('prizeRule', 'prizeRule')->name('news.prize.rule');
    Route::get('research', 'research')->name('news.research');
    Route::get('researchRule', 'researchRule')->name('news.research.rule');
    Route::get('/prize/upsert/{sid?}', 'prizeUpsert')->name('prize.upsert');
    Route::get('/prize/collective', 'prizeCollective')->name('prize.collective');
    Route::get('/research/upsert/{sid?}', 'researchUpsert')->name('research.upsert');
    Route::get('/research/collective', 'researchCollective')->name('research.collective');

    Route::get('cpa', 'cpa')->name('news.cpa');

    Route::post('data', 'data')->name('news.data');
});

// archive M3
Route::controller(\App\Http\Controllers\Archive\ArchiveController::class)->prefix('archive')->group(function () {
    Route::get('eLearning', 'eLearning')->name('archive.eLearning');
});

// Journal M4
Route::controller(\App\Http\Controllers\Journal\JournalController::class)->prefix('journal')->group(function () {
    Route::get('publication', 'publication')->name('journal.publication');
    Route::get('publication/upsert/{sid?}', 'upsert')->name('publication.upsert');
    Route::get('aard', 'aard')->name('journal.aard');
    Route::get('aair', 'aair')->name('journal.aair');
    Route::get('asSearch', 'asSearch')->name('journal.asSearch');
    Route::get('asSearchList', 'asSearchList')->name('journal.asSearchList');
    Route::get('asKwon', 'asKwon')->name('journal.asKwon');
    Route::get('asKwonList', 'asKwonList')->name('journal.asKwonList');

    Route::post('data', 'data')->name('journal.data');
});

// Workshop M5
Route::prefix('workshop')->group(function() {
    Route::controller(\App\Http\Controllers\Workshop\WorkshopController::class)->group(function() {
        Route::get('overseas', 'overseas')->name('workshop.overseas');
        Route::get('education', 'education')->name('workshop.education');

        Route::get('domestic', 'domestic')->name('workshop.domestic');
        Route::get('upsert/{sid?}', 'upsert')->name('workshop.upsert');
        Route::get('detail/{wsid}/', 'detail')->name('workshop.detail');

        Route::post('data', 'data')->name('workshop.data');
    });

    // 사전등록
    Route::controller(\App\Http\Controllers\Workshop\RegistrationController::class)->prefix('{wsid}/registration')->group(function() {
        Route::get('upsert', 'index')->name('registration');
        Route::get('{member_gubun}/upsert/{sid?}', 'upsert')->where('member_gubun','Y|N')->name('registration.upsert');
        Route::get('upsert/preview/{sid}', 'preview')->name('registration.preview');
        Route::get('upsert/complete/{sid}', 'complete')->name('registration.complete');
        Route::get('office_search', 'office_search')->name('registration.office_search');

        //조회
        Route::get('search', 'search')->name('registration.search');
        Route::get('search_result/{sid}', 'search_result')->name('registration.search_result');
        Route::get('receipt/{sid}', 'receipt')->name('registration.receipt');

        Route::post('data', 'data')->name('registration.data');
    });

    //강의원고
    Route::controller(\App\Http\Controllers\Workshop\LectureController::class)->prefix('{wsid}/lecture')->group(function() {
        Route::get('/', 'index')->name('lecture');
        Route::get('upload/{sid?}', 'upload')->name('lecture.upsert');

        Route::post('data', 'data')->name('lecture.data');
    });
});

// General M7
Route::controller(\App\Http\Controllers\General\GeneralController::class)->prefix('general')->group(function () {
    Route::get('center', 'center')->name('general.center');
    Route::get('hospitalSearch', 'hospitalSearch')->name('general.hospitalSearch');
    Route::post('data', 'data')->name('general.data');
});


// mypage
Route::prefix('auth')->middleware('auth.check')->group(function () {
    Route::controller(\App\Http\Controllers\Mypage\MypageController::class)->prefix('mypage')->group(function () {
        Route::get('/intro', 'intro')->name('mypage.intro');
        //개인정보 수정
        Route::get('/pwCheck', 'pwCheck')->name('mypage.pwCheck');
        Route::get('/modify', 'modify')->name('mypage.modify');
        //비밀번호 변경
        Route::get('/password', 'password')->name('mypage.password');
        Route::get('/repassword', 'repassword')->name('mypage.repassword');
        //학술대회 참석현황
        Route::get('/certi', 'certi')->name('mypage.certi');
        Route::get('/certiReceipt', 'certiReceipt')->name('mypage.certiReceipt');
        //회원검색
        Route::get('/member_search', 'member_search')->name('mypage.member_search');
        //책갈피
        Route::get('/bookmark', 'bookmark')->name('mypage.bookmark');
        //회원탈퇴
        Route::get('/withdraw', 'withdraw')->name('mypage.withdraw');

        Route::post('data', 'data')->name('mypage.data');
    });

    //Fee
    Route::controller(\App\Http\Controllers\Mypage\FeeController::class)->group(function () {
        Route::get('/fee', 'fee')->name('mypage.fee');
        Route::get('/upsert', 'upsert')->name('fee.upsert');
        Route::get('/receipt', 'receipt')->name('fee.receipt');

        Route::post('Feedata', 'Feedata')->name('fee.data');
    });

});

// auth
Route::prefix('auth')->group(function () {
    Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {

        //개인정보취급방침
        Route::get('privacy', 'privacy')->name('privacy');
        Route::get('refusal', 'refusal')->name('refusal');

//        Route::middleware('guest')->group(function () {
            Route::get('join/{step}', 'join')->where('step', '1|2|3|4|5')->name('join');
            Route::get('findId', 'findId')->name('findId');
            Route::get('findPw', 'findPw')->name('findPw');

//        });

        Route::post('data', 'data')->name('auth.data');
    });

    Route::controller(\App\Http\Controllers\Auth\LoginController::class)->group(function () {
//        Route::middleware('guest')->group(function () {
            Route::match(['get', 'post'], 'login', 'login')->name('login');
//        });
        Route::post('logout', 'logout')->middleware('auth.check')->name('logout');
    });
});


require __DIR__ . '/common.php';
