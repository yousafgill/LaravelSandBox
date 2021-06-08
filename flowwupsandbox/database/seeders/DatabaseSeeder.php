<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\status;
use App\Models\Category;
use App\Models\plan;
use App\Models\User;
use App\Models\Team;
use Laravel\Cashier\Cashier;

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

        //Create Category
        Category::create([
            'title' => 'Uncategorized',
            'category_color' => 'primary',
            'is_active' => true
        ]);

        //Create Plans
        plan::create([
            'name' =>'Starter',
            'plan_code' =>'plan_0001',
            'plan_stripe_code' => 'price_1InS0bKZIdFWcYAY4rOG3dNR',
            'total_teams' => 1,
            'total_active_boards' => 5,
            'total_tracked_users' => 250,
            'total_active_team_members' => 3,
            'daily_backup' => true,
            'support_included' =>true,
            'plan_fee' => 35
        ]);
        plan::create([
            'name' =>'Growth',
            'plan_code' =>'plan_0002',
            'plan_stripe_code' => 'price_1InS0bKZIdFWcYAYzvhQIMaj',
            'total_teams' => 5,
            'total_active_boards' => 15,
            'total_tracked_users' => 2500,
            'total_active_team_members' => 15,
            'daily_backup' => true,
            'support_included' =>true,
            'plan_fee' => 75
        ]);
        plan::create([
            'name' =>'Business',
            'plan_code' =>'plan_0003',
            'plan_stripe_code' => 'price_1InS0bKZIdFWcYAYrab5zPKv',
            'total_teams' => 10,
            'total_active_boards' => 100000,
            'total_tracked_users' => 1000000000,
            'total_active_team_members' => 100000000,
            'daily_backup' => true,
            'support_included' =>true,
            'plan_fee' => 125
        ]);

        plan::create([
            'name' =>'Trial',
            'plan_code' =>'Trial',
            'plan_stripe_code' => 'Trial',
            'total_teams' => 1,
            'total_active_boards' => 3,
            'total_tracked_users' => 3,
            'total_active_team_members' => 3,
            'daily_backup' => true,
            'support_included' =>true,
            'plan_fee' => 0
        ]);

        $admn=user::create([
            'name' => 'admin',
            'email' => 'admin@flowwup.com',
            'password' => Hash::make('admin1234'),
            'current_team_id' =>1,
            'plan_mode' => 'Subscription',
            'plan_until' => Carbon::now()->addYears(100)
        ]);
        
        $tm=Team::create([
            'user_id' => $admn->id,
            'name' => 'admin',
            'personal_team' => 1,
            'team_slug' => 'admin'
        ]);

        $sub=\DB::table('subscriptions')->insert([
            'team_id' => $tm->id,
            'name' => 'Business Plan',
            'stripe_id' => 'price_1InS0bKZIdFWcYAYrab5zPKv',
            'stripe_status' => 'Active',
            'stripe_plan' => 'price_1InS0bKZIdFWcYAYrab5zPKv',
            'quantity' => 1,
            'trial_ends_at' => Carbon::now()->addYears(10),
            'ends_at' =>Carbon::now()->addYears(10)
        ]);
    }
}
