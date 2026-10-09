<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $options = [
            ['type' => 'sugar', 'name' => '0% Sugar', 'value' => '0', 'extra_fee' => 0],
            ['type' => 'sugar', 'name' => '25% Sugar', 'value' => '25', 'extra_fee' => 0],
            ['type' => 'sugar', 'name' => '50% Sugar', 'value' => '50', 'extra_fee' => 0],
            ['type' => 'sugar', 'name' => '75% Sugar', 'value' => '75', 'extra_fee' => 0],
            ['type' => 'sugar', 'name' => '100% Sugar', 'value' => '100', 'extra_fee' => 0],
            ['type' => 'ice', 'name' => 'No Ice', 'value' => 'none', 'extra_fee' => 0],
            ['type' => 'ice', 'name' => 'Less Ice', 'value' => 'less', 'extra_fee' => 0],
            ['type' => 'ice', 'name' => 'Normal Ice', 'value' => 'normal', 'extra_fee' => 0],
            ['type' => 'ice', 'name' => 'Extra Ice', 'value' => 'extra', 'extra_fee' => 0],
            ['type' => 'milk', 'name' => 'Regular Milk', 'value' => 'regular', 'extra_fee' => 0],
            ['type' => 'milk', 'name' => 'Oat Milk', 'value' => 'oat', 'extra_fee' => 5000],
            ['type' => 'milk', 'name' => 'Almond Milk', 'value' => 'almond', 'extra_fee' => 5000],
            ['type' => 'milk', 'name' => 'Soy Milk', 'value' => 'soy', 'extra_fee' => 3000],
        ];

        foreach ($options as $option) {
            Option::create($option);
        }
    }
}
