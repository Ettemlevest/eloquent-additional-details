<?php

namespace Ettemlevest\AdditionalDetails\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Ettemlevest\AdditionalDetails\AdditionalDetailsServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            AdditionalDetailsServiceProvider::class,
        ];
    }
}
