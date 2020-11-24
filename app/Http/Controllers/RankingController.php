<?php

namespace App\Http\Controllers;

use App\Enum\ActivityTypeEnum;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function __invoke(): array
    {
        $walking = DB::table('activities')
            ->selectRaw('SUM(kilometers) as `kilometers`, groups.name as `name`')
            ->join('groups', 'group_id', '=', 'groups.id')
            ->where('activity_type', ActivityTypeEnum::WALKING())
            ->groupBy('group_id')
            ->orderByDesc('kilometers')
            ->get();

        $cycling = DB::table('activities')
            ->selectRaw('SUM(kilometers) as `kilometers`, groups.name as `name`')
            ->join('groups', 'group_id', '=', 'groups.id')
            ->where('activity_type', ActivityTypeEnum::CYCLING())
            ->groupBy('group_id')
            ->orderByDesc('kilometers')
            ->get();

        $swimming = DB::table('activities')
            ->selectRaw('SUM(kilometers) as `kilometers`, groups.name as `name`')
            ->join('groups', 'group_id', '=', 'groups.id')
            ->where('activity_type', ActivityTypeEnum::SWIMMING())
            ->groupBy('group_id')
            ->orderByDesc('kilometers')
            ->get();

        return [
            "data" => [
                "walking" => $walking,
                "cycling" => $cycling,
                "swimming" => $swimming
            ]
        ];
    }
}
