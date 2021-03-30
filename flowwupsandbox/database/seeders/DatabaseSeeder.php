<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\status;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        status::create(['title'=>'OPEN','status_order'=>1,'status_color'=>'primary']);
        status::create(['title'=>'UNDER REVIEW','status_order'=>2,'status_color'=>'danger']);
        status::create(['title'=>'PLANNED','status_order'=>3,'status_color'=>'orange']);
        status::create(['title'=>'IN PROGRESS','status_order'=>4,'status_color'=>'violet']);
        status::create(['title'=>'COMPLETE','status_order'=>5,'status_color'=>'success']);
        status::create(['title'=>'CLOSED','status_order'=>6,'status_color'=>'pink']);

    }
}
