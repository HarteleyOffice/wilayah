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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname',100);
            $table->string('username',60)->unique();
            $table->string('password',255);
            $table->string('email',100)->nullable();
            $table->string('phone',60)->nullable();
            $table->boolean('should_change_password');
            $table->foreignId('hris_role_id')->nullable()->references('id')->on('hris_roles');
            $table->foreignId('pugindo_role_id')->nullable()->references('id')->on('pugindo_roles');
            $table->foreignId('portal_role_id')->nullable()->references('id')->on('portal_roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
