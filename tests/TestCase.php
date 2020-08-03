<?php

namespace App\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Contracts\Console\Kernel;
use App\User;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    protected function setUp(): void
    {
        parent::setUp();

        \Artisan::call('migrate');
        \Artisan::call('db:seed');

        $this->withoutExceptionHandling();

        $user = new User([
            'id' => 1,
            'name' => 'TestUser'
        ]);
        $this->be($user);
    }
}
