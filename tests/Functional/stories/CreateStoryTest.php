<?php

namespace Tests\functional\stories;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\BrowserKitTesting\Concerns\InteractsWithDatabase;
use Tests\Functional\UiTestCase;

class CreateStoryTest extends UiTestCase
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
    public function testCreateStory()
    {
        $this->visit('/stories/create')
            ->click('/new story')
            ->type('test', 'title')
            ->type('test', 'url')
            ->press('Save')
            ->see('Story created!')
            ->seePageIs('/stories/test');
    }

    public function testCreateStoryWhenLogged()
    {
        $this->login();
        $this->createStory();
        $this->see('Markus');
        $this->see('Comment/s (0)');
    }

    public function testLogout()
    {
        $this->login();
        $this->see('/markus');
        $this->visit('/logout');
        $this->dontSee('/markus');
    }

    private function login()
    {
        $this->visit('/login/')
            ->type('test@test.com', 'email')
            ->type('test', 'password')
            ->press('Login');
    }

    private function createStory()
    {
        $this->visit('/stories/create')
            ->type('test', 'title')
            ->type('test', 'url')
            ->press('Save');
    }
}
