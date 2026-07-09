<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiscountSeeder extends Seeder
{
    public function run()
    {
        $builder = $this->db->table('discount');

        for ($i = 0; $i < 10; $i++) {

            $builder->insert([
                'tanggal'   => date('Y-m-d', strtotime("+$i day")),
                'nominal'   => ($i + 1) * 10000,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]);
        }
    }
}