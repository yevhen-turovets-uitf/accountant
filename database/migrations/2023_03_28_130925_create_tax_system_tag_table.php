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
        Schema::create('tax_system_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('tag_id')->constrained('tags', 'id')->onDelete('cascade');
            $table->foreignId('tax_system_id')->constrained('tax_systems', 'id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_system_tag');
    }
};
