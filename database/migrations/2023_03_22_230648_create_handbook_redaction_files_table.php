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
        Schema::create('handbook_redaction_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('file_url');
            $table->foreignId('handbook_redaction_id')->constrained('handbook_redactions', 'id')->onDelete('cascade');
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
        Schema::dropIfExists('handbook_redaction_files');
    }
};
