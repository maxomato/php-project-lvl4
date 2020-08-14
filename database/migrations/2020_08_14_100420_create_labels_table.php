<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->softDeletes();
            $table->unique(['name', 'deleted_at']);
        });

        Schema::create('task_labels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('task_id');
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->integer('label_id')->references('id')->on('labels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labels');
        Schema::dropIfExists('task_labels');
    }
}
