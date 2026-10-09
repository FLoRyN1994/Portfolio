<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    public function run(): void
    {
        $agencies = [
            ['name' => 'REEA',            'url' => 'https://reea.net',           'sort_order' => 1],
            ['name' => 'Eton Digital',    'url' => 'https://etondigital.com',    'sort_order' => 2],
            ['name' => 'Holycode',        'url' => 'https://holycode.com',       'sort_order' => 3],
            ['name' => 'Softehnica',      'url' => 'https://softehnica.ro',      'sort_order' => 4],
            ['name' => 'Infynit Digital', 'url' => 'https://infynit.digital',    'sort_order' => 5],
        ];

        foreach ($agencies as $data) {
            Agency::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
