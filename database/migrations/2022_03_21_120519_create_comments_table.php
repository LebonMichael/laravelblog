<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            //$table->foreignId('post_id')->index();
            $table->unsignedBigInteger('reply_id');
            $table->unsignedBigInteger('post_id')->index();
            $table->unsignedBigInteger('user_id');
            $table->Integer('is_active')->default(0);
            $table->unsignedBigInteger('photo_id');
            $table->text('body');
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
        Schema::dropIfExists('comments');
    }
};
