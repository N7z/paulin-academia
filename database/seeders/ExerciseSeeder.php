<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        $userId = 1;

        DB::table('exercises')->insert([
            // PEITO
            [
                'user_id' => $userId,
                'muscle_group_id' => 1, // Peito
                'name' => 'Supino Reto',
                'weight_type' => 'lb',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'muscle_group_id' => 1,
                'name' => 'Supino Inclinado',
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // COSTAS
            [
                'user_id' => $userId,
                'muscle_group_id' => 2, // Costas
                'name' => 'Puxada Frontal',
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'muscle_group_id' => 2,
                'name' => 'Remada Curvada',
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // PERNA
            [
                'user_id' => $userId,
                'muscle_group_id' => 3, // Perna
                'name' => 'Agachamento Livre',
                'weight_type' => 'lb',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'muscle_group_id' => 3,
                'name' => 'Leg Press',
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // OMBRO
            [
                'user_id' => $userId,
                'muscle_group_id' => 4, // Ombro
                'name' => 'Desenvolvimento com Halteres',
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // BRAÇO
            [
                'user_id' => $userId,
                'muscle_group_id' => 5, // Bíceps
                'name' => 'Rosca Direta',
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'muscle_group_id' => 6, // Tríceps
                'name' => 'Tríceps Pulley',
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ABDÔMEN
            [
                'user_id' => $userId,
                'muscle_group_id' => 7, // Abdômen
                'name' => 'Abdominal Crunch',
                'weight_type' => 'unit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
