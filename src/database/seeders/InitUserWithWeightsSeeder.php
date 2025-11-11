<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;;

use App\Models\WeightTarget;

class InitUserWithWeightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'email' => 'demo@example.com', // 固定したい場合
            'password' => bcrypt('password'), // ログインできるように
        ]);

        // weight_target を1件作成
        WeightTarget::factory()->create([
            'user_id' => $user->id,
        ]);

        // weight_logs を35件作成
        WeightLog::factory()->count(35)->create([
            'user_id' => $user->id,
        ]);
    }
}
