<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /** @test */
    public function 正しいパスワードでログインできる()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('laraveltest11')
        ]);

        $response = $this->get(route('user.login'));
        $response->assertStatus(200);

        $response = $this
            ->post(route('user.login'), [
                'email' => $user->email,
                'password' => 'laraveltest11'
            ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function 違うパスワードではログインできない()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('laraveltest11')
        ]);

        $response = $this->get(route('user.login'));
        $response->assertStatus(200);

        $response = $this
            ->post(route('user.login'), [
                'email' => $user->email,
                'password' => 'laraveltest1'
            ]);

        $response->assertStatus(302);
        $response->assertRedirect('user/login');
        $this->assertGuest();
    }

    /** @test */
    public function 正しくログアウトできる()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->get('/')
            ->assertStatus(200);

        $this->post('user/logout');

        $response->assertStatus(200);

        $this->assertGuest();
    }
}
