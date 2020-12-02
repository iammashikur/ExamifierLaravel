<?php

use Illuminate\Database\Seeder;
use App\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'phone'=>'admin@examifier.com',
                'is_admin'=>'1',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Examiner',
               'phone'=>'examiner@examifier.com',
                'is_examiner'=>'1',
               'password'=> bcrypt('123456'),
            ],

            [
                'name'=>'Student',
                'phone'=>'01770815577',
                 'is_admin'=>'0',
                'password'=> bcrypt('123456'),
             ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
