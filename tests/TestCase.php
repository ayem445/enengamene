<?php

namespace Tests;

use Redis;
use Config;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function loginAdmin() {
        $user = factory(User::class)->create();
        Config::push('enengamene.administrators', $user->email);
        $this->actingAs($user);
    }

    public function flushRedis() {
        Redis::flushall();
    }
}
