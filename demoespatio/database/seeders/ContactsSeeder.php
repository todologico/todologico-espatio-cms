<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
  
    public function run()
    {

        \App\Models\ccc_cont1::factory(10)->create();

    }
}
