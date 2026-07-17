<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'حصاد المزروعات',
                'description' => 'خدمة حصاد المزروعات بكل أنواعها',
                'icon' => 'fas fa-leaf',
            ],
            [
                'name' => 'ري المزروعات',
                'description' => 'خدمة ري المزروعات والعناية بالمياه',
                'icon' => 'fas fa-water',
            ],
            [
                'name' => 'تنظيف الأرض',
                'description' => 'خدمة تنظيف وتجهيز الأراضي الزراعية',
                'icon' => 'fas fa-broom',
            ],
            [
                'name' => 'رش المبيدات',
                'description' => 'خدمة رش المبيدات والأسمدة',
                'icon' => 'fas fa-spray-can',
            ],
            [
                'name' => 'نقل المنتجات',
                'description' => 'خدمة نقل وتوزيع المنتجات الزراعية',
                'icon' => 'fas fa-truck',
            ],
            [
                'name' => 'العناية بالحيوانات',
                'description' => 'خدمة العناية بالحيوانات الزراعية',
                'icon' => 'fas fa-horse',
            ],
        ];

        foreach ($services as $service) {
            \App\Models\Service::create($service);
        }
    }
}
