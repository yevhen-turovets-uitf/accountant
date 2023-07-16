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
        Schema::table('blanks', function (Blueprint $table) {
            $table->boolean('access_required')->default(false)->after('category_id');
        });
        Schema::table('consultations', function (Blueprint $table) {
            $table->boolean('access_required')->default(false)->after('category_id');
        });
        Schema::table('handbooks', function (Blueprint $table) {
            $table->boolean('access_required')->default(false)->after('category_id');
        });
        Schema::table('norms', function (Blueprint $table) {
            $table->boolean('access_required')->default(false)->after('status');
        });
        Schema::table('reports', function (Blueprint $table) {
            $table->boolean('access_required')->default(false)->after('category_id');
        });
        Schema::table('tax_systems', function (Blueprint $table) {
            $table->boolean('access_required')->default(false)->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blanks', function (Blueprint $table) {
            $table->dropColumn('access_required');
        });
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropColumn('access_required');
        });
        Schema::table('handbooks', function (Blueprint $table) {
            $table->dropColumn('access_required');
        });
        Schema::table('norms', function (Blueprint $table) {
            $table->dropColumn('access_required');
        });
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('access_required');
        });
        Schema::table('tax_systems', function (Blueprint $table) {
            $table->dropColumn('access_required');
        });
    }
};
