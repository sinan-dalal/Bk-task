<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BaseTestCase extends TestCase
{
    use  RefreshDatabase, WithFaker;

    public function loginAsAdmin()
    {
        $this->actingAs(Admin::factory()->create(), 'admins');
    }
}
