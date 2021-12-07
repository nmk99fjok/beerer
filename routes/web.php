<?php

// トップページ表示
Route::get('/', 'HomeController@index');

Route::namespace('User')->prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => true,
        'verify'   => false
    ]);

    // ユーザー詳細画面
    Route::get('/{name}', 'UserController@show')->name('show');

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {

    });
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {

        // 管理者用ダッシュボード
        Route::get('/', 'AdminController@index')->name('index');
        Route::get('/article/{article}/review', 'AdminController@articleReview')->name('articleReview');
        Route::delete('/review/{review}', 'AdminController@destroyReview')->name('destroyReview');

    });
});

// ビール記事
Route::resource('articles', 'ArticleController')->middleware('auth:admin');
Route::resource('articles', 'ArticleController')->only(['index', 'show']);
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/makers/all', 'ArticleController@maker')->name('maker');
    Route::get('/makers/{name}', 'ArticleController@makerShow')->name('makerShow');
    Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth:user');
    Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth:user');
});

// レビュー関連
Route::resource('reviews', 'ReviewController')->middleware('auth:user')->only('store','update','destroy');

// タグ系画面表示
Route::get('/tags', 'TagController@index')->name('tags.index');
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');
