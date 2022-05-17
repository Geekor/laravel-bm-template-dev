<?php

namespace Tests\Feature\Backend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Traits\CommonAuth;
use Tests\TestCase;

class MesterInfoTest extends TestCase
{
    use CommonAuth;

    protected $my_testing_api = '/api/backend/auth/info';
    protected $my_testing_method = 'get';
}
