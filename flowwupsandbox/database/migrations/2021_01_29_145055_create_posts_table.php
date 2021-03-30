<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_id')->index();
            $table->foreignId('user_id')->index();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('slug');
            
            $table->text('detail')->nullable();
            $table->string('public_url')->nullable();
            
            $table->boolean('is_spam')->nullable()->default(0);
            
            $table->unsignedInteger('votes')->nullable()->default(0);
            $table->date($column = 'estimated', $precision = 0)->nullable();
      
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
