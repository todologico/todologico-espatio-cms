<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RXCP_Cate1Seeder extends Seeder
{
  
    public function run()
    {

        \App\Models\rxcp_cate1::factory(5)->create();

    }
}
