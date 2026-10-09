<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $menus = [
            ['category' => 'Coffee', 'name' => 'Americano', 'description' => 'Strong espresso with hot water', 'price' => 25000],
            ['category' => 'Coffee', 'name' => 'Cappuccino', 'description' => 'Espresso with steamed milk and foam', 'price' => 32000],
            ['category' => 'Coffee', 'name' => 'Latte', 'description' => 'Espresso with steamed milk', 'price' => 32000],
            ['category' => 'Coffee', 'name' => 'Macchiato', 'description' => 'Espresso marked with a dollop of foam', 'price' => 28000],
            ['category' => 'Coffee', 'name' => 'Flat White', 'description' => 'Espresso with velvety steamed milk', 'price' => 35000],
            ['category' => 'Coffee', 'name' => 'Espresso', 'description' => 'Double shot of strong coffee', 'price' => 20000],
            ['category' => 'Coffee', 'name' => 'Mocha', 'description' => 'Espresso with chocolate and steamed milk', 'price' => 38000],
            ['category' => 'Coffee', 'name' => 'Cold Brew', 'description' => 'Smooth cold coffee concentrate', 'price' => 28000],
            ['category' => 'Non-Coffee', 'name' => 'Matcha Latte', 'description' => 'Creamy matcha with steamed milk', 'price' => 40000],
            ['category' => 'Non-Coffee', 'name' => 'Iced Tea', 'description' => 'Refreshing iced tea', 'price' => 18000],
            ['category' => 'Non-Coffee', 'name' => 'Smoothie Bowl', 'description' => 'Blended fruit with toppings', 'price' => 45000],
            ['category' => 'Non-Coffee', 'name' => 'Hot Chocolate', 'description' => 'Rich chocolate drink', 'price' => 30000],
            ['category' => 'Snacks', 'name' => 'Croissant', 'description' => 'Buttery pastry', 'price' => 25000],
            ['category' => 'Snacks', 'name' => 'Muffin', 'description' => 'Chocolate chip muffin', 'price' => 20000],
            ['category' => 'Snacks', 'name' => 'Cookie', 'description' => 'Homemade cookie', 'price' => 15000],
            ['category' => 'Snacks', 'name' => 'Sandwich', 'description' => 'Chicken & cheese sandwich', 'price' => 35000],
            ['category' => 'Desserts', 'name' => 'Cheesecake', 'description' => 'Classic New York cheesecake', 'price' => 50000],
            ['category' => 'Desserts', 'name' => 'Brownie', 'description' => 'Fudgy chocolate brownie', 'price' => 28000],
            ['category' => 'Beverages', 'name' => 'Orange Juice', 'description' => 'Fresh squeezed orange juice', 'price' => 22000],
            ['category' => 'Beverages', 'name' => 'Lemonade', 'description' => 'Refreshing homemade lemonade', 'price' => 20000],
        ];

        $coffeeSugarOptions = Option::where('type', 'sugar')->get();
        $iceOptions = Option::where('type', 'ice')->get();
        $milkOptions = Option::where('type', 'milk')->get();

        foreach ($menus as $menuData) {
            $category = Category::where('name', $menuData['category'])->first();
            $menu = Menu::create([
                'category_id' => $category->id,
                'name' => $menuData['name'],
                'slug' => Str::slug($menuData['name']),
                'description' => $menuData['description'],
                'price' => $menuData['price'],
                'status' => 'available',
            ]);

            if ($menuData['category'] === 'Coffee') {
                $menu->options()->attach($coffeeSugarOptions->pluck('id'));
                $menu->options()->attach($iceOptions->pluck('id'));
                $menu->options()->attach($milkOptions->pluck('id'));
            }
        }
    }
}
