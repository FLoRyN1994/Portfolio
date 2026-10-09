<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectPlatformSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            [
                'title'      => 'Ecolint',
                'slug'       => 'ecolint',
                'url'        => 'https://ecolint.ch',
                'role'       => 'Full-stack developer',
                'summary'    => 'Full-stack development on the public Ecolint website, delivered with an agency partner.',
                'thumbnail'  => '/projects/ecolint.jpg',
                'published'  => true,
                'sort_order' => 1,
            ],
            [
                'title'      => 'Swatch Group',
                'slug'       => 'swatch-group',
                'url'        => 'https://swatchgroup.com',
                'role'       => 'Full-stack developer',
                'summary'    => 'Full-stack development on the public Swatch Group website, delivered with an agency partner.',
                'thumbnail'  => '/projects/swatch-group.svg',
                'published'  => true,
                'sort_order' => 2,
            ],
            [
                'title'      => 'Blancpain',
                'slug'       => 'blancpain',
                'url'        => 'https://blancpain.com',
                'role'       => 'Full-stack developer',
                'summary'    => 'Full-stack development on the public Blancpain website, delivered with an agency partner.',
                'thumbnail'  => '/projects/blancpain.jpg',
                'published'  => true,
                'sort_order' => 3,
            ],
            [
                'title'      => 'Flowit',
                'slug'       => 'flowit',
                'url'        => 'https://flowit.ai',
                'role'       => 'Full-stack developer',
                'summary'    => 'Full-stack development on the public Flowit website, delivered with an agency partner.',
                'thumbnail'  => '/projects/flowit.png',
                'published'  => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($platforms as $data) {
            Project::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
