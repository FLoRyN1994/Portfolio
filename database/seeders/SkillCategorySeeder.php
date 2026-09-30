<?php

namespace Database\Seeders;

use App\Models\SkillCategory;
use Illuminate\Database\Seeder;

class SkillCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'       => 'Drupal end to end',
                'items'      => ['Module development', 'Custom themes', 'Migrate & Feeds', 'Commerce', 'Acquia Cloud', 'Multisite', 'Performance'],
                'col_span'   => 2,
                'variant'    => 'accent',
                'sort_order' => 1,
            ],
            [
                'name'       => 'Backend PHP',
                'items'      => ['PHP 8', 'Symfony', 'Laravel', 'REST APIs', 'MySQL', 'Composer'],
                'col_span'   => 1,
                'variant'    => 'default',
                'sort_order' => 2,
            ],
            [
                'name'       => 'Frontend',
                'items'      => ['JavaScript', 'jQuery', 'Twig', 'SCSS / CSS', 'HTML5', 'Alpine.js'],
                'col_span'   => 1,
                'variant'    => 'default',
                'sort_order' => 3,
            ],
            [
                'name'       => 'Delivery',
                'items'      => ['Agile', 'Jira', 'Asana', 'Git', 'CI / CD'],
                'col_span'   => 1,
                'variant'    => 'default',
                'sort_order' => 4,
            ],
            [
                'name'        => 'What agencies get',
                'description' => 'A developer who integrates cleanly into existing teams, communicates across technical and stakeholder layers, and keeps delivery calm under client pressure.',
                'items'       => [],
                'col_span'    => 3,
                'variant'     => 'warm',
                'sort_order'  => 5,
            ],
        ];

        foreach ($categories as $data) {
            SkillCategory::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
