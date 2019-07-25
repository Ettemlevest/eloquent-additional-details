<?php

namespace Ettemlevest\AdditionalDetails\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Ettemlevest\AdditionalDetails\AdditionalDetailsServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Ettemlevest\AdditionalDetails\Models\DetailDefinition;

abstract class TestCase extends Orchestra
{
    protected $testUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    protected function getPackageProviders($app)
    {
        return [
            AdditionalDetailsServiceProvider::class,
        ];
    }

    /**
     * Set up the environment
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Set up the database.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
        });

        include_once __DIR__.'/../database/migrations/create_additional_detail_definitions_table.php.stub';
        include_once __DIR__.'/../database/migrations/create_additional_details_table.php.stub';

        (new \CreateAdditionalDetailDefinitionsTable)->up();
        (new \CreateAdditionalDetailsTable)->up();

        $this->testUser = User::create(['email' => 'test@example.org']);

        DetailDefinition::create(['model_type' => User::class, 'description' => 'Main test detail']);
        DetailDefinition::create(['model_type' => User::class, 'description' => 'Another test detail']);
        DetailDefinition::create(['model_type' => User::class, 'description' => 'Third test detail']);
    }
}
