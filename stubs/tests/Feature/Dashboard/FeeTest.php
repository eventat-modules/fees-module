<?php

namespace Tests\Feature\Dashboard;

use App\Models\Fee;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_display_a_list_of_fees()
    {
        $this->actingAsAdmin();

        Fee::factory()->create(RuleFactory::make(['%name%' => 'Foo']));

        $this->get(route('dashboard.fees.index'))
            ->assertSuccessful()
            ->assertSee('Foo');
    }

    public function test_it_can_display_the_fee_details()
    {
        $this->actingAsAdmin();

        $fee = Fee::factory()->create(RuleFactory::make(['%name%' => 'Foo']));

        $this->get(route('dashboard.fees.show', $fee))
            ->assertSuccessful()
            ->assertSee('Foo');
    }

    public function test_it_can_display_fees_create_form()
    {
        $this->actingAsAdmin();

        $this->get(route('dashboard.fees.create'))
            ->assertSuccessful();
    }

    public function test_it_can_create_a_new_fee()
    {
        $this->actingAsAdmin();

        $feesCount = Fee::count();

        $response = $this->post(
            route('dashboard.fees.store'),
            Fee::factory()->raw(
                RuleFactory::make([
                    '%name%' => 'Foo',
                    '%description%' => 'test description',
                    'price' => 0,
                    'active' => true,
                ])
            )
        );

        $response->assertRedirect();

        $fee = Fee::all()->last();

        $this->assertEquals(Fee::count(), $feesCount + 1);

        $this->assertEquals($fee->name, 'Foo');
    }

    public function test_it_can_display_the_fees_edit_form()
    {
        $this->actingAsAdmin();

        $fee = Fee::factory()->create();

        $this->get(route('dashboard.fees.edit', $fee))
            ->assertSuccessful();
    }

    public function test_it_can_update_the_fee()
    {
        $this->actingAsAdmin();

        $fee = Fee::factory()->create();

        $response = $this->put(
            route('dashboard.fees.update', $fee),
            Fee::factory()->raw(
                RuleFactory::make([
                    '%name%' => 'Foo',
                    '%description%' => 'test description',
                    'price' => 0,
                    'active' => true,
                ])
            )
        );

        $fee->refresh();

        $response->assertRedirect();

        $this->assertEquals($fee->name, 'Foo');
    }

    public function test_it_can_delete_the_fee()
    {
        $this->actingAsAdmin();

        $fee = Fee::factory()->create();

        $feesCount = Fee::count();

        $response = $this->delete(route('dashboard.fees.destroy', $fee));

        $response->assertRedirect();

        $this->assertEquals(Fee::count(), $feesCount - 1);
    }

    public function test_it_can_display_trashed_fees()
    {
        if (! $this->useSoftDeletes($model = Fee::class)) {
            $this->markTestSkipped("The '$model' doesn't use soft deletes trait.");
        }

        Fee::factory()->create(RuleFactory::make(['deleted_at' => now(), '%name%' => 'Ahmed']));

        $this->actingAsAdmin();

        $response = $this->get(route('dashboard.fees.trashed'));

        $response->assertSuccessful();

        $response->assertSee('Ahmed');
    }

    public function test_it_can_display_trashed_fee_details()
    {
        if (! $this->useSoftDeletes($model = Fee::class)) {
            $this->markTestSkipped("The '$model' doesn't use soft deletes trait.");
        }

        $fee = Fee::factory()->create(RuleFactory::make(['deleted_at' => now(), '%name%' => 'Ahmed']));

        $this->actingAsAdmin();

        $response = $this->get(route('dashboard.fees.trashed.show', $fee));

        $response->assertSuccessful();

        $response->assertSee('Ahmed');
    }

    public function test_it_can_restore_deleted_fee()
    {
        if (! $this->useSoftDeletes($model = Fee::class)) {
            $this->markTestSkipped("The '$model' doesn't use soft deletes trait.");
        }

        $fee = Fee::factory()->create(['deleted_at' => now()]);

        $this->actingAsAdmin();

        $response = $this->post(route('dashboard.fees.restore', $fee));

        $response->assertRedirect();

        $this->assertNull($fee->refresh()->deleted_at);
    }

    public function test_it_can_force_delete_fee()
    {
        if (! $this->useSoftDeletes($model = Fee::class)) {
            $this->markTestSkipped("The '$model' doesn't use soft deletes trait.");
        }

        $fee = Fee::factory()->create(['deleted_at' => now()]);

        $visitorCount = Fee::withTrashed()->count();

        $this->actingAsAdmin();

        $response = $this->delete(route('dashboard.fees.forceDelete', $fee));

        $response->assertRedirect();

        $this->assertEquals(Fee::withoutTrashed()->count(), $visitorCount - 1);
    }

    public function test_it_can_filter_fees_by_name()
    {
        $this->actingAsAdmin();

        Fee::factory()->create([
            'name' => 'Foo',
        ]);

        Fee::factory()->create([
            'name' => 'Bar',
        ]);

        $this->get(route('dashboard.fees.index', [
            'name' => 'Fo',
        ]))
            ->assertSuccessful()
            ->assertSee(__('fees.filter'))
            ->assertSee('Foo')
            ->assertDontSee('Bar');
    }
}
