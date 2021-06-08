<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('plan_code')->unique();
            $table->string('plan_stripe_code')->unique();
            $table->integer('total_teams')->nullable()->default(0);
            $table->integer('total_active_boards')->nullable()->default(0);
            $table->integer('total_tracked_users')->nullable()->default(0);
            $table->integer('total_active_team_members')->nullable()->default(0);
            // $table->integer('total_active_team_members')->nullable()->default(0);
            $table->boolean('daily_backup')->nullable()->default(0);
            $table->boolean('support_included')->nullable()->default(0);
            $table->integer('plan_fee')->nullable()->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
