<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                "name" => "Bruno Dilhof",
                "login" => "17085",
                "email" => "dilhof.bruno@dpb.sk",
                "password" => \Hash::make("heslo"),
                "color" => "#3498db",
            ],
            [
                "name" => "Veronika Tomšíková",
                "login" => "11451",
                "email" => "tomsikova.veronika@dpb.sk",
                "password" => \Hash::make("heslo"),
                "color" => "#e74c3c",
            ],
            [
                "name" => "Andrej Horný",
                "login" => "13599",
                "email" => "horny.andrej@dpb.sk",
                "password" => \Hash::make("heslo"),
                "color" => "#2ecc71",
            ],
            [
                "name" => "Daniel Šuchaň",
                "login" => "5591",
                "email" => "suchan.daniel@dpb.sk",
                "password" => \Hash::make("heslo"),
                "color" => "#f39c12",
            ],
        ];

        User::insert($users);
    }
}


