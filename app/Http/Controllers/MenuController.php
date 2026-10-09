<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::where('status', 'available');

        if ($request->has('category') && $request->category !== '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('description', 'like', '%'.$request->search.'%');
        }

        $menus = $query->get();
        $categories = Category::orderBy('order')->get();

        return view('menu.index', compact('menus', 'categories'));
    }

    public function show($slug)
    {
        $menu = Menu::where('slug', $slug)->firstOrFail();

        return response()->json($menu->load('options', 'category'));
    }
}
