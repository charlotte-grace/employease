<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        create_vo_schema('skill_levels');
        populate_vo_data([
            'Beginner',
            'Intermediate',
            'Expert',
        ], 'skill_levels');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_levels');
    }
};
