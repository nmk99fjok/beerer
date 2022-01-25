<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    protected $fillable = [
        'title', 'maker', 'price', 'body', 'image'
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany('App\Models\Review');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'likes')->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }

    //(ログイン中の)ユーザーがお気に入り登録をしているかどうかを返す
    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    //ユーザーが記事にレビューを投稿しているかどうかを返す
    public function isReviewed(?User $user): bool
    {
        return $user
            ? (bool)$this->reviews->where('user_id', $user->id)->count()
            : false;
    }

    //reviewテーブルのratingカラムの平均値を返すアクセサ
    public function getReviewsAvgAttribute(): int
    {
        return round($this->reviews->pluck('rating')->avg(), 0);
    }

    public function scopeSearchArticle($query, $search)
    {
        if(empty($search)) {
            return;
        }
        return $query->where(function ($query) use($search) {
            $query->orWhere('title', 'LIKE', "%{$search}%")
                  ->orWhere('maker', 'LIKE', "%{$search}%")
                  ->orWhere('body', 'LIKE', "%{$search}%");
        });
    }
}
