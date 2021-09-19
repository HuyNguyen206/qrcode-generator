<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountHistory;
use App\Models\Qrcode;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
               'email' => 'nguyenlehuyuit@gmail.com',
               'name' => 'huy'
           ]);
        User::factory(9)->create();

        AccountHistory::factory(50)->create();
        Qrcode::factory(50)->create();
        Transaction::factory(50)->create();
        DB::table('roles')->insert([
           [
               'name' => 'admin'
           ],
            [
                'name' => 'moderator'
            ],
            [
                'name' => 'webmaster'
            ],
            [
                'name' => 'buyer'
            ]
        ]);
        $roles = Role::all();
        $users = User::all();
        $users->each(function($user) use($roles) {
            if($user->id == 1) {
                $user->roles()->attach(1);
            }else {
                $user->roles()->attach($roles->random());
            }
        });

    }
}
