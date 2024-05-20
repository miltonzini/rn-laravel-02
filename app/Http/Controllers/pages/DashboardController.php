<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Category;
use App\Models\User; 
use App\Models\Session; 

class DashboardController extends Controller
{
    public function showDashboard() {
        $productsCount = Product::count();
        $categoriesCount = Category::count();
        $usersCount = User::count();
        $sessionsCount = Session::count();
        return view('admin.dashboard', compact('productsCount', 'categoriesCount', 'usersCount', 'sessionsCount'));
    }
}
