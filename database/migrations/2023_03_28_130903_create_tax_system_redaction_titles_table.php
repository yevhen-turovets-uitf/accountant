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
        Schema::create('tax_system_redaction_titles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tax_system_redaction_id')->nullable();
            $table->foreign('tax_system_redaction_id')->references('id')->on('tax_system_redactions')->onDelete('cascade');
            $table->string('title');
            $table->string('text_id');
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
        Schema::dropIfExists('tax_system_redaction_titles');
    }
};
