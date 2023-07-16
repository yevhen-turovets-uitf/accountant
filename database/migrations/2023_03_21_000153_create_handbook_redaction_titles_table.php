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
        Schema::create('handbook_redaction_titles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('handbook_redaction_id')->nullable();
            $table->foreign('handbook_redaction_id')->references('id')->on('handbook_redactions')->onDelete('cascade');
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
        Schema::dropIfExists('handbook_redaction_titles');
    }
};
