<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member\Member;
class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $count_user_aktif = User::where('isActive', '=', 1)->count();
        $count_user_Nonaktif = User::where('isActive', '=', 0)->count();
        $count_member = Member::count();
        // $count_jabatan = Jabatan::count();
        $count_admin = User::where('id_role', 1)
            ->count();
        return view('dashboard.content.dashboard.dashboard', compact('count_user_aktif', 'count_user_Nonaktif', 'count_admin', 'count_member'));
    }
}
