<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Category;
use App\Models\User; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Session; 

class DashboardController extends Controller
{
    public function showDashboard() {
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $usersCount = User::count();
        $sessionsCount = Session::count();
        $timeout = config('session.lifetime') * 60;
        $onlineUsersCount = DB::table('sessions')
            ->where('last_activity', '>=', Carbon::now()->subSeconds($timeout)->getTimestamp())
            ->whereNotNull('user_id')
            ->distinct('user_id')
            ->count('user_id');
        return view('admin.dashboard', compact('productsCount', 'categoriesCount', 'usersCount', 'sessionsCount', 'onlineUsersCount'));
    }
}
