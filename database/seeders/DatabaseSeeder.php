<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Parcel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* Delete data from DB */
        DB::table('users')->truncate();
        DB::table('parcels')->truncate();

        for($i = 1; $i <= rand(8, 10); $i++) {
            User::factory()->create([
                'name' => 'User' . $i,
                'email' => 'user' . $i . '@szerveroldali.hu',
                'password' => bcrypt('password')
            ]);
        }

        $users = User::all();
        //$users_count = $users->count();

        for($i = 1; $i <= rand(15, 20); $i++) {
            $rand_user = $users->random();
            $parcel = Parcel::factory()->create([
                'user_id' => $rand_user['id']
            ]);
            $parcel->user()->associate($rand_user);
            $parcel->save();
         }
    }
}
