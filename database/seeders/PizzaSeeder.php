<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pizza;

class PizzaSeeder extends Seeder
{
    public function run(): void
    {
        Pizza::create([
            'name' => 'Пепперони',
            'description' => 'Острая пепперони, сыр и томатный соус',
            'price' => 69000,
            'image' => 'pizzas/pepperoni.jpg',
        ]);

        Pizza::create([
            'name' => 'Маргарита',
            'description' => 'Томатный соус, моцарелла, базилик',
            'price' => 59000,
            'image' => 'pizzas/margarita.jpg',
        ]);

        Pizza::create([
            'name' => 'Гавайская',
            'description' => 'Курица, ананасы, сыр, соус',
            'price' => 72000,
            'image' => 'pizzas/hawaiian.jpg',
        ]);
    }
}
