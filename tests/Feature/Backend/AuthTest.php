<?php

namespace Tests\Feature\Backend;

use Geekor\Core\Support\GkApi;
use Geekor\Core\Support\GkTestUtil;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthTest extends TestCase
{
    const ADMIN_USERNAME = 'admin';
    const ADMIN_PSW = '123456';
    const DEVICE_NAME = 'homestead-test';
    const BAD_TOKEN = 'jfewofgugnmsdfger';
    const NORNAL_USER_TOKEN = '14|3hy19ebLudbvKKYuW6oMv33fN3hkHnlfXhWqlMqQ';

    public function test_try_a_not_exists_api()
    {
        $this->get('/api/backend')->assertStatus(404);
    }

    /*
    |--------------------------------------------------------------------------
    | 登录测试
    |--------------------------------------------------------------------------
    */
    public function test_login_without_device_name()
    {
        $response = $this->post('/api/backend/auth/login', [
            'username' => self::ADMIN_USERNAME,
            'password' => self::ADMIN_PSW,
        ]);

        $response->assertStatus(400)->assertJson(['code' => GkApi::API_PARAM_MISS]);
    }

    public function test_login_with_bad_password()
    {
        $response = $this->post('/api/backend/auth/login', [
            'username' => self::ADMIN_USERNAME,
            'password' => 'qsdfwe',
            'device_name' => self::DEVICE_NAME
        ]);

        $response->assertStatus(400)->assertJson(['code' => GkApi::API_PARAM_ERROR]);
    }

    public function test_login_success()
    {
        $response = $this->post('/api/backend/auth/login', [
            'username' => self::ADMIN_USERNAME,
            'password' => self::ADMIN_PSW,
            'device_name' => self::DEVICE_NAME
        ]);

        $response->assertStatus(200)->assertJsonStructure(['info', 'token']);
    }

}
