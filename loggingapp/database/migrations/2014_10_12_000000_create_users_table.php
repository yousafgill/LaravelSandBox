<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->boolean('registered_with_email')->nullable();
            $table->timestampTz('email_verified_at',0)->nullable();
            $table->string('password')->nullable();
            
            $table->string('google_id')->nullable();
            $table->boolean('registered_with_google')->nullable();
            $table->string('facebook_id')->nullable();
            $table->boolean('registered_with_facebook')->nullable();
            $table->string('avatar')->nullable();
            $table->string('primary_phone')->nullable();
            
            $table->rememberToken();
            $table->timestampsTz(0);
            $table->softDeletesTz('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}