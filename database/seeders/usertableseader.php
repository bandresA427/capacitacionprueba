<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;
class usertableseader extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { // agregar datos a la tabla user
        DB::table('users')->insert([
            //primero admin
            [
                'name' => 'admin',
                'email' => 'admin2@jjll.com',
                'usertype' => 'admin',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'password' => Hash::make('1234')
            ],

            // nivel supervisor
            [
                'name' => 'superv',
                'email' => 'supervisor@jjll.com',
                'usertype' => 'supervisor',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'password' => Hash::make('1234')
            ],

            //nivel user
            [
                'name' => 'user',
                'email' => 'user@jjll.com',
                'usertype' => 'user',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'password' => Hash::make('1234')
            ]

        ]);

    }
}