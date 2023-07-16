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
            $table->string('phone')->after('surname')->nullable();
            $table->unsignedBigInteger('inn')->after('phone')->nullable();
            $table->dropColumn('company_code');
            $table->integer('number_contract')->nullable()->after('company_inn');
            $table->timestamp('date_from')->nullable()->after('number_contract');
            $table->timestamp('date_to')->nullable()->after('date_from');
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
            $table->dropColumn('phone');
            $table->dropColumn('inn');
            $table->string('company_code')->nullable();
            $table->dropColumn('number_contract');
            $table->dropColumn('date_from');
            $table->dropColumn('date_to');
        });
    }
};
