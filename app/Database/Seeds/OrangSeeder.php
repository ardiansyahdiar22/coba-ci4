<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

use CodeIgniter\Database\Seeder;

class OrangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama'          => 'Budi',
            'alamat'        => 'Jl gagak no 89 Jakarta Selatan',
            'created_at'    => Time::now(),
            'updated_at'    => Time::now(),
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('orang')->insert($data);
    }
}
