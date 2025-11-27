<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Saran', 'description' => 'Saran untuk perbaikan dan pengembangan'],
            ['name' => 'Kritik', 'description' => 'Kritik yang membangun untuk layanan kami'],
            ['name' => 'Pengaduan', 'description' => 'Pengaduan tentang layanan atau produk'],
            ['name' => 'Pertanyaan', 'description' => 'Pertanyaan terkait dinas atau layanan'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
