<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('post_id');
            $table->string('message');

            $table->boolean('is_reply')->nullable()->default(0);
            $table->foreignId('reply_to')->nullable();

            $table->integer('comment_level')->nullable()->default(0);
            
            $table->string('image_url')->nullable();
            $table->integer('likes')->nullable()->default(0);
            $table->boolean('is_spam')->nullable()->default(0);
            $table->tinyInteger('is_new')->nullable()->default(1);
            
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
        Schema::dropIfExists('comments');
    }
}
