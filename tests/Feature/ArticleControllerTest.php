<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function 記事一覧のURLで画面表示ができる()
    {
        $response = $this->get(action('ArticleController@index'));

        $response->assertStatus(200)
            ->assertViewIs('index');
    }

    /** @test */
    public function test()
    {

    }
}
