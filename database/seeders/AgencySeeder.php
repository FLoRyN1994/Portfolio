<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    public function run(): void
    {
        $agencies = [
            ['name' => 'REEA',           'url' => 'https://reea.net',                'sort_order' => 1],
            ['name' => 'Holycode',       'url' => 'https://holycode.com',            'sort_order' => 2],
            ['name' => 'Softehnica',     'url' => 'https://soft-tehnica.com/ro/',    'sort_order' => 3],
            ['name' => 'Infinit Digital','url' => 'https://infinitdigital.ro/en/',   'sort_order' => 4],
        ];

        foreach ($agencies as $data) {
            Agency::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
