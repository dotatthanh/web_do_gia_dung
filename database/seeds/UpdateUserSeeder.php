<?php

use App\Model\Entities\Admin;
use App\Model\Entities\User;
use Illuminate\Database\Seeder;

class UpdateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::query()->update(['password' => bcrypt('123123123')]);
        User::query()->update(['password' => bcrypt('123123123')]);
    }
}
