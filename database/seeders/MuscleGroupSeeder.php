<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MuscleGroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            'Peito',
            'Costas',
            'Perna',
            'Ombro',
            'Bíceps',
            'Tríceps',
            'Abdômen',
            'Panturrilha',
            'Glúteo',
        ];

        foreach ($groups as $group) {
            DB::table('muscle_groups')->insert([
                'name' => $group,
                'slug' => Str::slug($group),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
