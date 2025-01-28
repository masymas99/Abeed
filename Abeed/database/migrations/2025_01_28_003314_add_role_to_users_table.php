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
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['Candidate', 'Employer', 'Admin'])->default('Candidate');
        $table->string('company_name')->nullable(); // فقط للمستخدمين من نوع Employer
        $table->string('company_logo')->nullable(); // فقط للمستخدمين من نوع Employer
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['role', 'company_name', 'company_logo']);
    });
}
};
