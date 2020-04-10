<?php

namespace Bulkly\Http\Controllers;

use Bulkly\Services\HistoryService;
use Bulkly\SocialPostGroups;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        return view('history.index');
    }

    public function getAllHistory(Request $request)
    {
        $buffer_posts = (new HistoryService())->getAllHistory($request);
        return response()->json($buffer_posts);
    }

    public function getAllGroupType()
    {
        $group_types = SocialPostGroups::distinct('type')->pluck('type');
        return response()->json($group_types);
    }
}
