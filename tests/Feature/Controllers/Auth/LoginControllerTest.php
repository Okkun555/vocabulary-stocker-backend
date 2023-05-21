<?php

namespace Tests\Feature\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        User::factory(1)->create();
    }

    /**
     * @group LoginController
     */
    public function test_ログイン成功時、200ステータスとログイン情報を返却()
    {
        $user = User::find(1);
        $response = $this->post(route('login', [
            'email' => $user->email,
            'password' => 'password'
        ]));

        $response->assertOk();
        $response->assertJson([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }
}
