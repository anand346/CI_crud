<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        //
        $user = new UserModel();
        for($i = 0;$i < 10;$i++){
            $user->save([
                'username' => static::faker()->userName,
                'password' => static::faker()->password
            ]);
        }
        
    }
}
