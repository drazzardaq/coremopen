<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

				$categories = ['Life', 'Businesses', 'Projects', 'Tasks', 'Finances', 'Identity',];

				for ($i = 0; $i < count($categories); $i++) { 
					Category::create([
							'name' => $categories[$i],
					]);
				}
    }
}
