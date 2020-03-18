<?php

use Illuminate\Database\Seeder;

class RecipeTableSeeder extends Seeder
{
    public function run()
    {
        \App\Recipe::insert([
            [
                'title' => "Boiled Yam",
                'body' => "- Cut the yam tuber into 1 inch slices.
                - Peel and cut the slices into half moons or circular shapes.
                - Wash the slices, place in a pot and pour water to cover the contents.
                - Boil till the yam is soft. This is when you can easily drive a fork into the slices without resistance.
                - Add salt and leave to cook for about 2 minutes.
                - Turn off the heat and drain the water.
                "
            ],
            [
                'title' => "Chicken Suya Salad",
                'body' => "- Rinse all the vegetables thoroughly.
                - Cut the pieces of chicken suya into thin stripes with a width of about half an inch (about 1.5cm).
                - Cut thin strips of the cucumber along the fruit.
                - Cut the tomatoes and cabbage.
                - Arrange the vegetables like petals
                "
            ]
        ]);
    }
}
