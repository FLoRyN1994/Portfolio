<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    public function run(): void
    {
        $agencies = [
            [
                'name' => 'REEA',
                'url' => 'https://reea.net',
                'logo_path' => 'agencies/reea.svg',
                'period' => 'Sep 2018 – Present',
                'description' => 'Drupal Developer — large-scale Drupal 8–10 applications on Symfony-based architecture: custom modules, RESTful APIs, Docker deployments, system architecture, and Agile code reviews.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Holycode',
                'url' => 'https://holycode.com',
                'logo_path' => 'agencies/holycode.png',
                'period' => 'Mar 2024 – Dec 2025',
                'description' => 'PHP / Drupal Developer — stabilised and evolved a large-scale Drupal 8–10 platform: legacy refactoring, custom modules, SSO integration with 360Learning, and enterprise-level architecture work with product and QA teams.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Softehnica',
                'url' => 'https://soft-tehnica.com/ro/',
                'logo_path' => 'agencies/softehnica.png',
                'period' => null,
                'description' => 'Agency partner — client website platform deliveries.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Infinit Digital',
                'url' => 'https://infinitdigital.ro/en/',
                'logo_path' => 'agencies/infynit.png',
                'period' => null,
                'description' => 'Agency partner — client website platform deliveries.',
                'sort_order' => 4,
            ],
        ];

        foreach ($agencies as $data) {
            Agency::updateOrCreate(['name' => $data['name']], $data);
        }
    }
}
