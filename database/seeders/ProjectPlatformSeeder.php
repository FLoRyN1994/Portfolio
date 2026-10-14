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
                'title' => 'Ecolint',
                'slug' => 'ecolint',
                'url' => 'https://ecolint.ch',
                'role' => 'Full-stack Drupal Developer',
                'summary' => 'Built and maintained the Drupal platform for Ecolint — the International School of Geneva, one of the world\'s oldest international schools — delivering multilingual editorial workflows, custom modules, and automated deployment pipelines for a 4 000-student institution.',
                'tech_stack' => ['Drupal 9', 'PHP', 'Symfony', 'Docker', 'MySQL'],
                'thumbnail' => '/projects/ecolint.jpg',
                'published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Swatch Group',
                'slug' => 'swatch-group',
                'url' => 'https://swatchgroup.com',
                'role' => 'Full-stack Drupal Developer',
                'summary' => 'Delivered full-stack Drupal development on Swatch Group\'s corporate website — the world\'s largest watchmaking conglomerate — handling content architecture, multilingual publishing, and brand-level infrastructure spanning 18+ luxury watch brands.',
                'tech_stack' => ['Drupal 9', 'PHP', 'REST API', 'Docker', 'SCSS'],
                'thumbnail' => '/projects/swatch-group.svg',
                'published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Blancpain',
                'slug' => 'blancpain',
                'url' => 'https://blancpain.com',
                'role' => 'Full-stack Drupal Developer',
                'summary' => 'Developed and maintained the Drupal platform for Blancpain, the world\'s oldest watch brand — building immersive product showcases, multilingual content structures, and a polished editorial experience for the ultra-luxury segment.',
                'tech_stack' => ['Drupal 9', 'PHP', 'JavaScript', 'Docker', 'MySQL'],
                'thumbnail' => '/projects/blancpain.jpg',
                'published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Flowit',
                'slug' => 'flowit',
                'url' => 'https://flowit.ai',
                'role' => 'Full-stack Drupal Developer',
                'summary' => 'Developed the Drupal marketing website for Flowit, a Swiss AI workflow-automation platform — building performant content pages, CMS integrations, and custom components for their product-led growth funnel.',
                'tech_stack' => ['Drupal 10', 'PHP', 'Tailwind CSS', 'REST API', 'Docker'],
                'thumbnail' => '/projects/flowit.png',
                'published' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'ISF',
                'slug' => 'isf',
                'url' => 'https://isf.ro',
                'role' => 'Full-stack Drupal Developer',
                'summary' => 'Built and maintained the Drupal platform for ISF (Institute of Financial Studies), Romania\'s financial-education regulator — delivering course catalogues, examination workflows, publication management, and member registration systems.',
                'tech_stack' => ['Drupal 9', 'PHP', 'MySQL', 'Symfony', 'Docker'],
                'thumbnail' => '/projects/isf-logo.png',
                'published' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Plus Auto',
                'slug' => 'plus-auto',
                'url' => 'https://plus-auto.ro',
                'role' => 'Full-stack Drupal Developer',
                'summary' => 'Full-stack Drupal development for Plus Auto, a Romanian automotive platform — building vehicle listing management, dealer integrations, advanced search functionality, and custom content workflows for the automotive sector.',
                'tech_stack' => ['Drupal 8', 'PHP', 'MySQL', 'REST API', 'JavaScript'],
                'thumbnail' => '/projects/plus-auto-logo.svg',
                'published' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($platforms as $data) {
            Project::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
