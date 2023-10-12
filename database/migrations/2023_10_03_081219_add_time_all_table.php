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
        Schema::table('provinces', function (Blueprint $table) {
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            
        });

        Schema::table('villages', function (Blueprint $table) {
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            
        });

        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            
        });

        Schema::table('hris_roles', function (Blueprint $table) {
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            
        });

        Schema::table('pugindo_roles', function (Blueprint $table) {
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            
        });

        Schema::table('portal_roles', function (Blueprint $table) {
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('provinces', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            
        });

        Schema::table('villages', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            
        });

        Schema::table('hris_roles', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            
        });

        Schema::table('pugindo_roles', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            
        });

        Schema::table('portal_roles', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            
        });
    }
};
