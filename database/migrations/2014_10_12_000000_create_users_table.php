<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('phone')->nullable()->unique();
            $table->string('email')->unique();
            $table->integer('identity_number')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->boolean('status')->default(false);
            $table->date('birth_at')->nullable();
            $table->enum('sex', ['Bay', 'Bayan'])->nullable();
            $table->foreignId('position_id')->nullable()->constrained();
            $table->softDeletes();
            $table->timestamps();
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
