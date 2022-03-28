<?php

namespace Tests\Feature\Dashboard;

use App\Models\User;
use App\Models\Admin;
use Tests\Feature\BaseTestCase;

class AdminAuthTest extends BaseTestCase
{
    protected string $endpoint = '/api/dashboard';

    public function testSuperAdminLogin()
    {
        $admin = User::factory()->create();

        $payload = [
            'email' => $admin->email,
            'password' => 'password',
        ];

        $this->json('POST', $this->endpoint . '/login', $payload)
            ->assertSee('access_token')
            ->assertStatus(200);

        $this->assertAuthenticated('admins');
    }
}
