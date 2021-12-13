<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /** @test */
    public function 記事へのレビューを投稿し保存できる()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();

        $review = factory(Review::class)->create([
            'user_id' => $user->id,
            'article_id' => $article->id
        ])->toArray();

        $response = $this
            ->actingAs($user, 'user')
            ->post(route('reviews.store'), $review);

        $this->assertDatabaseHas('reviews', $review);
    }

    /** @test */
    public function レビューが記事詳細画面に表示される()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();

        $review = factory(Review::class)->create([
            'user_id' => $user->id,
            'article_id' => $article->id
        ]);

        $response = $this->get(route('articles.show', ['article' => $article->id]));

        $response->assertSee($review->body);
    }

    /** @test */
    public function 記事へのレビューを更新できる()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();

        $review = factory(Review::class)->create([
            'user_id' => $user->id,
            'article_id' => $article->id
        ]);

        $postdata = [
            'rating' => 4,
            'body' => 'test for update review'
        ];

        $response = $this
            ->actingAs($user, 'user')
            ->put(route('reviews.update', ['review' => $review->id]), $postdata);

        $this->assertDatabaseHas('reviews', $postdata);
    }

    /** @test */
    public function 記事へのレビューを削除する()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();

        $review = factory(Review::class)->create([
            'user_id' => $user->id,
            'article_id' => $article->id
        ]);

        $response = $this
            ->actingAs($user, 'user')
            ->delete(route('reviews.destroy', ['review' => $review->id]));

        $this->assertDeleted($review);
    }
}
