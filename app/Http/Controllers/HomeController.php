<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class HomeController extends Controller
{
    public function index()
    {
        $featuredMenus = Menu::where('status', 'available')
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('home', compact('featuredMenus'));
    }
}
