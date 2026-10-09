<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    public function run(): void
    {
        $agencies = [
            ['name' => 'REEA',           'url' => 'https://reea.net',                'logo_path' => 'agencies/reea.svg',     'sort_order' => 1],
            ['name' => 'Holycode',       'url' => 'https://holycode.com',            'logo_path' => 'agencies/holycode.png', 'sort_order' => 2],
            ['name' => 'Softehnica',     'url' => 'https://soft-tehnica.com/ro/',    'logo_path' => 'agencies/softehnica.png','sort_order' => 3],
            ['name' => 'Infinit Digital','url' => 'https://infinitdigital.ro/en/',   'logo_path' => 'agencies/infynit.png',  'sort_order' => 4],
        ];

        foreach ($agencies as $data) {
            Agency::updateOrCreate(['name' => $data['name']], $data);
        }
    }
}
