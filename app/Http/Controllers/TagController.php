<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //登録されているタグの一覧を表示
    public function index()
    {
        $tags = Tag::orderBy('name', 'desc')->groupBy('name')->get('name');

        return view('tags.index', [
            'tags' => $tags,
        ]);
    }

    //タグごとの記事一覧画面を表示
    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();

        return view('tags.show', ['tag' => $tag]);
    }
}
