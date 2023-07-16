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
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname');
            $table->string('login')->nullable()->unique();
            $table->boolean('is_entity')->default(0);
            $table->string('company_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_address')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('company_code')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('surname');
            $table->dropColumn('login');
            $table->dropColumn('is_entity');
            $table->dropColumn('company_name');
            $table->dropColumn('phone');
            $table->dropColumn('company_address');
            $table->dropColumn('company_id');
            $table->dropColumn('company_code');
            $table->dropSoftDeletes();
        });
    }
};
