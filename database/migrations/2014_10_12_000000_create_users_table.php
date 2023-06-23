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
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('status');
            $table->date('birth_at');
            $table->integer('salary')->nullable()->default(0);
            $table->enum('sex', ['Bay', 'Bayan']);
            $table->date('start_work');
            $table->date('end_work')->nullable();
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
