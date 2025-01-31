<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empapplications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('empjobs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained();
            $table->string('full_name');
            $table->string('email');
            $table->string('resume_path');
            $table->text('cover_letter');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empapplications');
    }
};
