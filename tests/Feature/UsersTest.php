<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    /**
     * Testing login page
     *
     * @return void
     */
    public function testLoginPage()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
