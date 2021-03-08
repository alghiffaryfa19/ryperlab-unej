<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->longText('soal')->nullable();
            $table->mediumText('option_1')->nullable();
            $table->mediumText('option_2')->nullable();
            $table->mediumText('option_3')->nullable();
            $table->mediumText('option_4')->nullable();
            $table->mediumText('option_5')->nullable();
            $table->string('right_answer')->nullable();
            $table->longText('pembahasan')->nullable();
            $table->double('skor');
            $table->unsignedBigInteger('ujian_id');
            $table->foreign('ujian_id')->references('id')->on('ujians')->onDelete('cascade');
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
        Schema::dropIfExists('soals');
    }
}
