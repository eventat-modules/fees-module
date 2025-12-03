<?php

namespace Tests\Feature\Api;

use App\Models\Fee;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_fees()
    {
        $this->actingAsAdmin();

        Fee::query()->truncate();

        Fee::factory()->count(2)->create();

        $this->getJson(route('api.fees.index'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                    ],
                ],
            ]);
    }

    public function test_fees_select2_api()
    {
        Fee::query()->truncate();

        Fee::factory()->count(5)->create();

        $response = $this->getJson(route('api.fees.select'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'text'],
                ],
            ]);

        $this->assertEquals($response->json('data.0.id'), 1);

        $this->assertCount(5, $response->json('data'));

        $response = $this->getJson(route('api.fees.select', ['selected_id' => 4]))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'text'],
                ],
            ]);

        $this->assertEquals($response->json('data.0.id'), 4);

        $this->assertCount(5, $response->json('data'));
    }

    public function test_it_can_display_the_visitor_details()
    {
        $this->actingAsAdmin();

        $Fee = Fee::factory(RuleFactory::make(['%name%' => 'Foo']))->create();

        $response = $this->getJson(route('api.fees.show', $Fee))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ]);

        $this->assertEquals($response->json('data.name'), 'Foo');
    }
}
