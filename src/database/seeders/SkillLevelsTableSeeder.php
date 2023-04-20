<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SkillLevelsTableSeeder extends Seeder
{
    private const SLUG_LEVEL_BEGINNER = 'beginner';
    private const SLUG_LEVEL_INTERMEDIATE = 'intermediate';
    private const SLUG_LEVEL_EXPERT = 'expert';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDate = now('UTC');
        $skillLevels = [
            [
                'name' => Str::title(self::SLUG_LEVEL_BEGINNER),
                'slug' => self::SLUG_LEVEL_BEGINNER,
                'order' => 1,
                'is_active' => true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'name' => Str::title(self::SLUG_LEVEL_INTERMEDIATE),
                'slug' => self::SLUG_LEVEL_INTERMEDIATE,
                'order' => 2,
                'is_active' => true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
            [
                'name' => Str::title(self::SLUG_LEVEL_EXPERT),
                'slug' => self::SLUG_LEVEL_EXPERT,
                'order' => 3,
                'is_active' => true,
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ],
        ];

        foreach ($skillLevels as $level) {
            DB::table('skill_levels')->insert($level);
        }
    }
}
