<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_uuid')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact_number')->unique();
            $table->string('email_address')->unique();
            $table->string('street_address');
            $table->string('city');
            $table->string('postal_code');
            $table->string('country');
            $table->timestamp('date_of_birth');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
