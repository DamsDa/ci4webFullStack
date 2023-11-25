<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;

class OrangSeeder extends Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'nama' => 'kaka',
        //         'alamat'    => 'kakabaan street 1 kentz',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'nama' => 'dams',
        //         'alamat'    => 'damsbaan street 1 kentz',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'nama' => 'fallindelava',
        //         'alamat'    => 'fallindelavabaan street 1 kentz',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        // ];
        // menggunakan faker
        $faker = \Faker\Factory::create('fr_FR');
        // loop sampai 100
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'nama' => $faker->name,
                'alamat'    => $faker->address,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => time::now()
            ];
            $this->db->table('orang')->insert($data);
        }
    }
}
