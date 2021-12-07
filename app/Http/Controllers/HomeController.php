<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Carbon\Carbon;

class HomeController extends Controller
{
    // ホーム画面の表示
    public function index()
    {
        $articles = Article::all()->sortByDesc('reviews_avg');
        $articles->get(9);

        $today = Carbon::today()->timestamp;
        $todayArticle = Article::inRandomOrder($today)->first();

        return view('index', [
            'articles' => $articles,
            'todayArticle' => $todayArticle,
        ]);
    }
}
