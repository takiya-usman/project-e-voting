<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KandidatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert data ke table kandidat
        // insert data ke table kandidat
        DB::table('kandidat')->insert([
            [
                'nama_kandidat' => 'Kandidat Ke 1',
                'nama_calon' => 'Joni',
                'foto' => 'default.jpg',
            ],
            [
                'nama_kandidat' => 'Kandidat Ke 2',
                'nama_calon' => 'Dewi',
                'foto' => 'default.jpg',
            ],
            [
                'nama_kandidat' => 'Kandidat Ke 3',
                'nama_calon' => 'Budi',
                'foto' => 'default.jpg',
            ],
        ]);
    }
}
