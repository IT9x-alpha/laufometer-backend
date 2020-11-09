<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityStoreRequest;
use App\Http\Requests\ActivityUpdateRequest;
use App\Http\Resources\ActivityCollection;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ActivityCollection
     */
    public function index(Request $request)
    {
        $activities = Activity::all();

        return new ActivityCollection($activities);
    }

    /**
     * @param \App\Http\Requests\ActivityStoreRequest $request
     * @return \App\Http\Resources\ActivityResource
     */
    public function store(ActivityStoreRequest $request)
    {
        $activity = Activity::create($request->validated());

        return new ActivityResource($activity);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Activity $activity
     * @return \App\Http\Resources\ActivityResource
     */
    public function show(Request $request, Activity $activity)
    {
        return new ActivityResource($activity);
    }

    /**
     * @param \App\Http\Requests\ActivityUpdateRequest $request
     * @param \App\Models\Activity $activity
     * @return \App\Http\Resources\ActivityResource
     */
    public function update(ActivityUpdateRequest $request, Activity $activity)
    {
        $activity->update($request->validated());

        return new ActivityResource($activity);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Activity $activity)
    {
        $activity->delete();

        return response()->noContent();
    }
}
