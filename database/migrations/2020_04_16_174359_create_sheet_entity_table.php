<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheetEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheet_entity', function (Blueprint $table) {
            $table->id();
            $table->integer('sheet_id');
            $table->integer('evaluatee_id');
            $table->integer('rater_id');
            $table->json('objective')->nullable();
            $table->integer('total_progress')->nullable();
            $table->string('total_score')->nullable();
            $table->integer('status')->default(0);
            $table->integer('del_flg')->default(0);
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
        Schema::dropIfExists('sheet_entity');
    }
}
