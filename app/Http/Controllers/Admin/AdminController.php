<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $articles = Article::paginate(15);
        return view('admin.index', ['articles' => $articles]);
    }

    public function articleReview(Article $article)
    {
        return view('admin.articleReview', ['article' => $article]);
    }

    public function destroyReview(Review $review)
    {
        $review->delete();

        return  redirect()->route('admin.index')->with('success', 'コメントを削除しました');
    }
}
