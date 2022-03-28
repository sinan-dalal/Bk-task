<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BaseTestCase extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function loginAsAdmin()
    {
        $this->actingAs(User::factory()->create(), 'admins');
    }
}
