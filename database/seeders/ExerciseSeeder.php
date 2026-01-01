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
                'sets' => 3,
                'reps' => 10,
                'weight' => null,
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'muscle_group_id' => 1,
                'name' => 'Supino Inclinado',
                'sets' => 3,
                'reps' => 10,
                'weight' => null,
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // COSTAS
            [
                'user_id' => $userId,
                'muscle_group_id' => 2, // Costas
                'name' => 'Puxada Frontal',
                'sets' => 3,
                'reps' => 12,
                'weight' => null,
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'muscle_group_id' => 2,
                'name' => 'Remada Curvada',
                'sets' => 3,
                'reps' => 10,
                'weight' => null,
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // PERNA
            [
                'user_id' => $userId,
                'muscle_group_id' => 3, // Perna
                'name' => 'Agachamento Livre',
                'sets' => 4,
                'reps' => 8,
                'weight' => null,
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'muscle_group_id' => 3,
                'name' => 'Leg Press',
                'sets' => 3,
                'reps' => 12,
                'weight' => null,
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // OMBRO
            [
                'user_id' => $userId,
                'muscle_group_id' => 4, // Ombro
                'name' => 'Desenvolvimento com Halteres',
                'sets' => 3,
                'reps' => 10,
                'weight' => null,
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // BRAÇO
            [
                'user_id' => $userId,
                'muscle_group_id' => 5, // Bíceps
                'name' => 'Rosca Direta',
                'sets' => 3,
                'reps' => 12,
                'weight' => null,
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userId,
                'muscle_group_id' => 6, // Tríceps
                'name' => 'Tríceps Pulley',
                'sets' => 3,
                'reps' => 12,
                'weight' => null,
                'weight_type' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ABDÔMEN
            [
                'user_id' => $userId,
                'muscle_group_id' => 7, // Abdômen
                'name' => 'Abdominal Crunch',
                'sets' => 3,
                'reps' => 15,
                'weight' => null,
                'weight_type' => 'unit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
