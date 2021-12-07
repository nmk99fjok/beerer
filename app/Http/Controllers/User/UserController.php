<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()->load('likes');

        $articles = $user->likes->sortByDesc('created_at');

        return view('user.show', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }
}
