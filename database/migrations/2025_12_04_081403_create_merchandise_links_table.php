<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('merchandise_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('merchandise_id');
            $table->string('shop_name', 100);
            $table->string('url', 255);
            $table->timestamps();

            $table->foreign('merchandise_id')->references('id')->on('merchandise')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchandise_links');
    }
};
