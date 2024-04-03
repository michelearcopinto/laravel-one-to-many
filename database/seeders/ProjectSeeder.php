<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $title = $faker->sentence;
            $slug = Str::slug($title, '-');

            Project::create([
                'title' => $title,
                'slug' => $slug,
                'description' => $faker->paragraph,
            ]);
        }
    }
}
