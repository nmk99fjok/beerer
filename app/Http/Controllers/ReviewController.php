<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource('App\Models\Review', 'review');
    }

    /*
     * 記事へのレビューを投稿する
     */
    public function store(ReviewRequest $request, Review $review)
    {
        $article = Article::find($request->article_id);

        $review->rating = $request->rating;
        $review->body = $request->body;
        $review->user_id = Auth::id();
        $review->article_id = $request->article_id;

        $review->save();

        return redirect()->route('articles.show', compact('article'));
    }

    /*
     * 記事へのレビューを編集する
     */
    public function update(ReviewRequest $request, Review $review)
    {
        $article = Article::find($request->article_id);

        $review->rating = $request->rating;
        $review->body = $request->body;

        $review->save();

        return redirect()->route('articles.show', ['article' => $article]);
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('articles.index');
    }
}
