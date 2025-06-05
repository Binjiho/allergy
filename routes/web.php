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
