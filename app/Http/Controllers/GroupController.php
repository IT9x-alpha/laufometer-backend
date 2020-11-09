<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupStoreRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\GroupCollection
     */
    public function index(Request $request)
    {
        $groups = Group::all();

        return new GroupCollection($groups);
    }

    /**
     * @param \App\Http\Requests\GroupStoreRequest $request
     * @return \App\Http\Resources\GroupResource
     */
    public function store(GroupStoreRequest $request)
    {
        $group = Group::create($request->validated());

        return new GroupResource($group);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Group $group
     * @return \App\Http\Resources\GroupResource
     */
    public function show(Request $request, Group $group)
    {
        return new GroupResource($group);
    }

    /**
     * @param \App\Http\Requests\GroupUpdateRequest $request
     * @param \App\Models\Group $group
     * @return \App\Http\Resources\GroupResource
     */
    public function update(GroupUpdateRequest $request, Group $group)
    {
        $group->update($request->validated());

        return new GroupResource($group);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Group $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Group $group)
    {
        $group->delete();

        return response()->noContent();
    }
}
