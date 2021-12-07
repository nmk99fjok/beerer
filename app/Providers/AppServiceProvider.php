<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Article;
use App\Models\Tag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //TagとArticleのリレーション数を取得,サイドバーへ変数を渡したいため
        if(Schema::hasTable('tags')) {
            $getCountTag = Tag::withCount('articles')
                ->orderBy('articles_count', 'desc')
                ->limit(5)
                ->get();

            view()->share('getCountTag', $getCountTag);
        }
    }
}
