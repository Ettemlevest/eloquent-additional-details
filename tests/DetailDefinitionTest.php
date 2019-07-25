<?php

namespace Ettemlevest\AdditionalDetails\Tests;

use Ettemlevest\AdditionalDetails\Models\DetailDefinition;
use Illuminate\Database\QueryException;

class DetailDefinitionTest extends TestCase
{
    /** @test */
    public function it_can_list_detail_definitions_for_model()
    {
        $detail_definitions = DetailDefinition::forModel(User::class)->pluck('description')->toArray();

        $this->assertEquals(['Another test detail', 'Main test detail', 'Third test detail'], $detail_definitions);
    }

    /** @test */
    public function it_only_lists_detail_definitions_for_expected_model()
    {
        DetailDefinition::create(['model_type' => 'TestClass', 'description' => 'Other detail']);

        $detail_definitions = DetailDefinition::forModel(User::class)->pluck('description')->toArray();

        $this->assertEquals(['Another test detail', 'Main test detail', 'Third test detail'], $detail_definitions);
    }
}
