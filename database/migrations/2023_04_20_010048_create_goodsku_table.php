<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodskuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goodsku', function (Blueprint $table) {
            $table->id();
            $table->string('good_info');
            $table->string('good_img');
            $table->string('good_category');
            $table->decimal('good_old_price');//定点数
            $table->decimal('good_new_price');
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
        Schema::dropIfExists('goodsku');
    }
}
