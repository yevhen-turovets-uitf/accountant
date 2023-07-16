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
        Schema::dropIfExists('currency_rates');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->decimal('usd_rate');
            $table->decimal('eur_rate');
            $table->boolean('on_main_page')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }
};
