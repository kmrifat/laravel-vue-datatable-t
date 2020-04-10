<?php


namespace Bulkly\Services;


use Bulkly\BufferPosting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoryService
{
    public function getAllHistory(Request $request)
    {
        $buffer_posts = BufferPosting::query();
        if ($request->query('query') != '') {
            $buffer_posts->where('post_text', 'like', '%' . $request->query('query') . '%');
        }

        if ($request->query('date') != '') {
            try {
                $date = Carbon::parse($request->query('date'));
                $buffer_posts->whereDate('created_at', $date);
            } catch (\Exception $exception) {

            }
        }

        if ($request->query('group_id') != '') {
            $buffer_posts->whereHas('groupInfo', function ($group_query) use ($request) {
                return $group_query->where('type', $request->query('group_id'));
            });
        }

        $buffer_posts->with(['groupInfo', 'accountInfo']);
        return $buffer_posts->paginate(10);
    }
}
