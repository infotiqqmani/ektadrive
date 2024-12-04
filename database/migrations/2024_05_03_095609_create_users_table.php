<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->string('password');
        //     $table->string('role')->default(1);
        //     $table->string('mobile');
        //     $table->string('profile_img')->nullable();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->timestamps();
        // });

        // ===============================================================
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default(1);
            $table->string('mobile');
            $table->string('profile_img')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('team_lead_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->timestamps();
            $table->foreign('team_lead_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
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
