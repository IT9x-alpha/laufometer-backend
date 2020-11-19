<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\ActivityController;
use App\Http\Requests\ActivityStoreRequest;
use App\Http\Requests\ActivityUpdateRequest;
use App\Models\Activity;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ActivityController
 */
class ActivityControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        Activity::factory()->count(3)->create();

        $response = $this->get(route('activity.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            ActivityController::class,
            'store',
            ActivityStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $group = Group::factory()->create();
        $activity_type = "walking";
        $kilometers = $this->faker->randomFloat(2);
        $published_at = $this->faker->dateTime();

        $response = $this->post(route('activity.store'), [
            'group_id' => $group->id,
            'activity_type' => $activity_type,
            'kilometers' => $kilometers,
            'published_at' => $published_at,
        ]);

        $activities = Activity::query()
            ->where('group_id', $group->id)
            ->where('activity_type', $activity_type)
            ->where('kilometers', $kilometers)
            ->where('published_at', $published_at)
            ->get();
        $this->assertCount(1, $activities);

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $activity = Activity::factory()->create();

        $response = $this->get(route('activity.show', $activity));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            ActivityController::class,
            'update',
            ActivityUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $activity = Activity::factory()->create();
        $group = Group::factory()->create();
        $activity_type = "walking";
        $kilometers = $this->faker->randomFloat(2);

        $response = $this->put(route('activity.update', $activity), [
            'group_id' => $group->id,
            'activity_type' => $activity_type,
            'kilometers' => $kilometers,
        ]);

        $activity->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($group->id, $activity->group_id);
        $this->assertEquals($activity_type, $activity->activity_type);
        $this->assertEquals($kilometers, $activity->kilometers);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $activity = Activity::factory()->create();

        $response = $this->delete(route('activity.destroy', $activity));

        $response->assertNoContent();

        $this->assertDeleted($activity);
    }
}
