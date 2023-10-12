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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name',20)->unique();
            $table->string('code',20)->unique();
            $table->string('address',255);
            $table->string('phone',60);
            $table->boolean('is_active');
            $table->foreignId('city_id')->constrained('cities');
            $table->string('ip_address',30)->nullable();
            $table->decimal('lat',9,6)->nullable();
            $table->decimal('lng',9,6)->nullable();
            $table->string('created_by',100);
            $table->string('updated_by',100);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
