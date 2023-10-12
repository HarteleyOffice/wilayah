<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->foreignId('kepala_unit_id')->before('created_by')->nullable()->references('id')->on('users');
            $table->foreignId('kepala_cabang_id')->after('kepala_unit_id')->nullable()->references('id')->on('users');
            $table->foreignId('wakil_area_manager_id')->after('kepala_cabang_id')->nullable()->references('id')->on('users');
            $table->foreignId('area_manager_id')->after('wakil_area_manager_id')->nullable()->references('id')->on('users');
            $table->foreignId('company_id')->after('area_manager_id')->nullable()->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn('kepala_unit_id');
            $table->dropColumn('kepala_cabang_id');
            $table->dropColumn('wakil_area_manager_id');
            $table->dropColumn('area_manager_id');
            $table->dropColumn('company_id');
        });
    }
};
