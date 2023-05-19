<?php

namespace Tests\Feature\Requests\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class LoginRequestTest extends TestCase
{
    /**
     * @group FormRequest
     * @dataProvider dataProvider
     */
    public function test_login_request_validation(bool $expected, array $data): void
    {
        $rules = (new LoginRequest())->rules();

        $validator = Validator::make($data, $rules);

        $this->assertEquals($expected, $validator->passes());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            'success' => [
                true,
                [
                    'email' => 'sample@email.com',
                    'password' => 'password',
                ],
            ],
            'failed_email_required' => [
                false,
                [
                    'email' => '',
                    'password' => 'password',
                ]
            ],
            'failed_email_format' => [
                false,
                [
                    'email' => 'sample',
                    'password' => 'password',
                ]
            ],
            'failed_password_required' => [
                false,
                [
                    'email' => 'sample@email.com',
                    'password' => ''
                ]
            ],
        ];
    }
}
