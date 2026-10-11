<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;

class HomeController extends Controller
{
    public function index()
    {
        $menus = Menu::with('category')
            ->where('status', 'available')
            ->orderBy('id')
            ->get();

        $categories = Category::orderBy('order')->get();

        $promo = Menu::with('category')
            ->where('status', 'available')
            ->whereHas('category', fn ($q) => $q->where('slug', 'coffee'))
            ->first()
            ?? $menus->first();

        return view('home', compact('menus', 'categories', 'promo'));
    }
}
