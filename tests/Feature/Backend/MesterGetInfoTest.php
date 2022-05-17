<?php

namespace Tests\Feature\Backend;

use Tests\Feature\Traits\AuthTokenCheck;
use Tests\TestCase;

class MesterGetInfoTest extends TestCase
{
    use AuthTokenCheck;

    protected $my_testing_api = '/api/backend/auth/info';
    protected $my_testing_method = 'get';
    protected $my_device_name = 'php-auto-test';
}
