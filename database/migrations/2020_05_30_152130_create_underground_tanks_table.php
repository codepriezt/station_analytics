<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUndergroundTanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('underground_tanks', function (Blueprint $table) {
            $table->id();
            $table->double('depth');
            $table->double('width');
            $table->double('length');
            $table->double('radius')->default(0.00);
            $table->double('height')->default(0.00);
            $table->double('supplied_radius')->default(0.00);
            $table->double('supplied_length')->default(0.00);
            $table->double('supplied_depth')->default(0.00);
            $table->double('supplied_width')->default(0.00);
            $table->double('supplied_height')->default(0.00);
            $table->enum('filled' , ['full' , 'empty' , 'half'])->default('empty');
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
        Schema::dropIfExists('underground_tanks');
    }
}
