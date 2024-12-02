<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $authUser = auth("adminGuard")->user();

        $data['counts'] =  0;

        $data['userCounts'] = User::count();


        $userWeeklyQuery = User::query();
        $userTodayQuery = User::query();
        // role checking...
        if ($authUser->role === "manager") {
            $userTodayQuery->where('admin_id', $authUser->id);
            $userWeeklyQuery->where('admin_id', $authUser->id);
        }

        $data['todayUsers'] = $userTodayQuery->whereDate('created_at', Carbon::today())->paginate(25);
        $data['weeklyUsers'] = $userWeeklyQuery->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])->count();

        return view("admin.section.index", $data);
    }
}
