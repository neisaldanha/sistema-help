<?php

namespace Database\Seeders;
use App\Models\tab_usuarios;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        tab_usuarios::create([

            'ID_PESSOA'      => '1',
            'USU_EMAIL'     => 'nei.saldanha@gmail.com',
            'USU_LOGIN'      => 'saldanha',
            'USU_SENHA'  => bcrypt('salnei'),
            'USU_STATUS'      => 'A',
            'USU_NIVEL'      => 'A',
            'USU_DATA_CAD'      => '2021-07-02',
            'USU_DATA_UPDATE'   => '2021-07-02',
        ]);
    }
}
