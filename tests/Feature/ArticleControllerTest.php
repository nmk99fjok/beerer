<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Admin;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /** @test */
    public function 記事一覧のURLで画面表示ができる()
    {
        $response = $this->get(action('ArticleController@index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.index');
    }

    /** @test */
    public function 記事一覧に投稿データが商品名の昇順で表示される()
    {
        $firstPost = factory(Article::class)->create([
            'title' => 'aaa',
        ]);
        $secondPost = factory(Article::class)->create([
            'title' => 'bbb',
        ]);
        $thirdPost = factory(Article::class)->create([
            'title' => 'ccc',
        ]);

        $response = $this->get(action('ArticleController@index'));

        $response->assertSeeInOrder($expects = [$firstPost->title, $secondPost->title, $thirdPost->title]);
    }

    /** @test */
    public function 記事作成画面のURLで画面表示ができる()
    {
        $admin = factory(Admin::class)->create();

        $response = $this
            ->actingAs($admin, 'admin')
            ->get(action('ArticleController@create'));

        $response->assertStatus(200)
            ->assertViewIs('articles.create')
            ->assertSee('ビール記事投稿フォーム');
    }

    /** @test */
    public function データを投稿し保存できる()
    {
        $postdata = factory(Article::class)->create()->toarray();

        $admin = factory(Admin::class)->create();

        $response = $this
            ->actingAs($admin, 'admin')
            ->from('admin')
            ->post(route('articles.store'), $postdata)
            ->assertRedirect(action('Admin\AdminController@index'));

        $this->assertDatabaseHas('articles', $postdata);
    }

    /** @test */
    public function 記事更新画面のURLで画面表示できる()
    {
        $admin = factory(Admin::class)->create();
        $article = factory(Article::class)->create();

        $response = $this
            ->actingAs($admin, 'admin')
            ->get(route('articles.edit', ['article' => $article->id]));

        $response->assertStatus(200)
            ->assertViewIs('articles.edit')
            ->assertSee('ビール記事更新フォーム');
    }

    /** @test */
    public function 投稿した記事を更新できる()
    {
        $admin = factory(Admin::class)->create();
        $article = factory(Article::class)->create();

        $postdata = factory(Article::class)->create([
            'body' => 'test for update article',
        ])->toArray();

        $response = $this
            ->actingAs($admin, 'admin')
            ->from(route('articles.edit', ['article' => $article->id]))
            ->put(route('articles.update', ['article' => $article->id]), $postdata)
            ->assertRedirect(route('articles.edit', ['article' => $article->id]));

        $this->assertDatabaseHas('articles', $postdata);
    }

    /** @test */
    public function 記事詳細画面のURLで画面表示ができる()
    {
        $article = factory(Article::class)->create();

        $response = $this->get(route('articles.show', ['article' => $article->id]));

        $response->assertStatus(200)
            ->assertViewIs('articles.show')
            ->assertSee($article->title);
    }

    /** @test */
    public function 記事詳細画面で特定の投稿が表示される()
    {
        $article = factory(Article::class)->create();
        $data = Article::find($article->id);

        $response = $this->get(route('articles.show', ['article' => $article->id]));

        $response->assertViewHas('article', $data);
    }

    /** @test */
    public function 記事を削除する()
    {
        $admin = factory(Admin::class)->create();
        $article = factory(Article::class)->create();

        $response = $this
            ->actingAs($admin, 'admin')
            ->delete(route('articles.destroy', ['article' => $article->id]));

        $this->assertDeleted($article);
    }
}
