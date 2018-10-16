<?php

namespace Tests\functional\stories;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\BrowserKitTesting\Concerns\InteractsWithDatabase;
use Tests\Functional\UiTestCase;

class CreateUserTest extends UiTestCase
{
    use DatabaseMigrations;
    use InteractsWithDatabase;

    protected function setUp()
    {
        parent::setUp();

        User::create(
            [
                'name' => 'Markus',
                'email' => 'test@test.com',
                'password' => bcrypt('test'),
            ]
        );
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $this->visit('/login/')
            ->type('John', 'name')
            ->type('john@doe.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/home');
    }

    public function testLoginUser()
    {
        $this->visit('/login/')
            ->type('test@test.com', 'email')
            ->type('test', 'password')
            ->press('Login')
            ->seePageIs('/');
    }
}
