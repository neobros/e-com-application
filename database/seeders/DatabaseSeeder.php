<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'fname' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'role' => '1',
        ]);

        \App\Models\User::factory()->create([
            'fname' => 'super admin',
            'email' => 'superadmin@gmail.com',
            'role' => '1',
            'password' => '123456',
        ]);

        $phoneBrands = [
            ['brand_name' => 'Apple'],
            ['brand_name' => 'Samsung'],
            ['brand_name' => 'Xiaomi'],
            ['brand_name' => 'OnePlus'],
            ['brand_name' => 'Nokia'],
            ['brand_name' => 'Sony'],
            ['brand_name' => 'LG'],
            ['brand_name' => 'Google'],
            ['brand_name' => 'Huawei'],
            ['brand_name' => 'Oppo'],
            ['brand_name' => 'Vivo'],
        ];

        foreach ($phoneBrands as $brand) {
            Brand::create($brand);
        }
        
    }
}
