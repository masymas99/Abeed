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
    Schema::create('job_listings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('title');
        $table->text('description');
        $table->string('skills_required');
        $table->text('benefits');
        $table->decimal('salary_min', 10, 2)->nullable();
        $table->decimal('salary_max', 10, 2)->nullable();
        $table->string('location');
        $table->enum('work_type', ['Remote', 'On-site']);
        $table->date('application_deadline');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('job_listings');
}
};
