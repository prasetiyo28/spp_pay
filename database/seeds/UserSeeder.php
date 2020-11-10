<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->user();
    }

    public function user()
    {

        $payload = [
            'nama' => 'KepalaSekolah',
            'email' => 'ritamasfufah123@gmail.com',
            'password' => bcrypt('123Holmes'),
            'role' => 'superadmin',
        ];

        User::firstOrCreate($payload);

        $payload = [
            'nama' => 'Admin',
            'email' => 'dydana98@gmail.com',
            'password' => bcrypt('secret'),
            'role' => 'admin',
        ];

        User::firstOrCreate($payload);
    }
}
