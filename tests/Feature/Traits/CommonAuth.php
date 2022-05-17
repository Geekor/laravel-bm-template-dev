<?php

namespace Tests\Feature\Traits;

use Geekor\BackendMaster\Models\User;

trait CommonAuth
{
    public function test_api_without_token()
    {
        if ($this->my_testing_method === 'get') {
            $this->getJson($this->my_testing_api)->assertUnauthorized();
        }
    }

    public function test_api_by_bad_token()
    {
        if ($this->my_testing_method === 'get') {
            $this->withToken('frowqjfemo023ur')
                 ->getJson($this->my_testing_api)
                 ->assertUnauthorized();
        }
    }

    public function test_api_by_normal_user_token()
    {
        if ($this->my_testing_method === 'get') {
            $user = User::factory()->create();
            $this->actingAs($user)
                 ->getJson($this->my_testing_api)
                 ->assertUnauthorized();
        }
    }
}
