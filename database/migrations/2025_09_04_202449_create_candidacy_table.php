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
        Schema::create('candidacy', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('desired_role');
            $table->enum('education_level', ['MIDDLE_SCHOOL', 'HIGH_SCHOOL', 'UNDERGRADUATE', 'POSTGRADUATE', 'MASTER', 'PHD']);
            $table->string('observations')->nullable();
            $table->ipAddress('sender_ip');
            $table->string('cv_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidacy');
    }
};
