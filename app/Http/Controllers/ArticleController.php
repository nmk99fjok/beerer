<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\Review;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class ArticleController extends Controller
{
    /*
     * 記事の一覧画面を表示する
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->get('sort');

        $articles = Article::orderBy('title', 'desc')->searchArticle($search)->paginate(15);

        //sidebar.bladeと連動 記事のソート処理の場合分け
        switch($sort) {
            case 'sortReviewCount':
                $articles = Article::withCount('reviews')->orderBy('reviews_count', 'desc')->paginate(15);
                break;
            case 'sortRating':
                $articles = Article::paginate(15);
                $articles->setCollection($articles->sortByDesc('reviews_avg'));
                break;
            case 'sortNewArrival':
                $articles = Article::orderBy('created_at', 'desc')->searchArticle($search)->paginate(15);

        }

       $articles->load(['reviews', 'likes']);

        return view('articles.index', [
            'articles' => $articles,
            'search' => $search,
        ]);
    }

    /*
     * 記事作成画面を表示する
     */
    public function create()
    {
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('articles.create', [
            'allTagNames' => $allTagNames,
        ]);
    }

    /*
     * 記事のDBへの登録処理
     */
    public function store(ArticleRequest $request, Article $article)
    {
        $article->title = $request->title;
        $article->maker = $request->maker;
        $article->price = $request->price;
        $article->body  = $request->body;

        //storage/app以下に画像データを保存
        $path = $request->image->store('public/images');
        //画像のパスから、ファイル名.拡張子のみを取得
        $imagename = basename($path);
        //Articleテーブルのimageカラムにファイル名～を代入
        $article->image = $imagename;

        $article->save();

        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

        return redirect()->route('admin.index')->with('success', '登録が完了しました');
    }


    /*
     * 記事の更新画面を表示する
     */
    public function edit(Article $article)
    {
        $tagNames = $article->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('articles.edit', [
            'article' => $article,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }


    /*
     * 記事の更新処理をする
     */
    public function update(ArticleRequest $request, Article $article)
    {
        //新しい画像に更新したい場合
        if($request->hasFile('image')) {

            //元画像を削除する
            Storage::delete('public/images/' . $article->image);

            $path = $request->image->store('public/images');
            $article->image = basename($path);
        }

        $article->fill($request->all())->save();

        //タグを更新する際の処理↓

        //detachで中間テーブルのレコードを削除
        $article->tags()->detach();

        $request->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });

        return redirect()->route('articles.edit', ['article' => $article])->with('success', '更新が完了しました');
    }

    /*
     * 記事の削除処理をする
     */
    public function destroy(Article $article)
    {
        Storage::delete('public/images/' . $article->image);
        $article->delete();

        return redirect()->route('admin.index')->with('success', $article->title . 'を削除しました');
    }

    /*
     * 記事の詳細画面を表示する
     */
    public function show(Article $article)
    {
        $userReview = $article->reviews->where('user_id', Auth::id())->first();

        $reviews = $article->reviews()->orderBy('created_at', 'desc')->paginate(5);

        $article->load('tags');

        return view('articles.show', [
            'article' => $article,
            'userReview' => $userReview,
            'reviews' => $reviews
        ]);
    }

    //ビールのメーカーを一覧表示する
    public function maker()
    {
        $makers = Article::orderBy('maker', 'desc')->groupBy('maker')->get('maker');

        return view('articles.maker', [
            'makers' => $makers,
        ]);
    }

    //メーカーで絞り込みした時の一覧表示
    public function makerShow(string $name)
    {
        $articles = Article::where('maker', $name)->orderBy('title', 'desc')->get()->load(['likes', 'reviews']);

        $makerName = $name;

        return view('articles.makerShow', [
            'articles' => $articles,
            'makerName' => $makerName,
        ]);
    }

    /*
     * お気に入りへの登録
     */
    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
        ];
    }

    /*
     * お気に入り解除
     */
    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
        ];
    }
}
