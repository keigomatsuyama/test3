<?php
namespace Database\Factories;

use App\Models\WeightTarget;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightTargetFactory extends Factory
{
    protected $model = WeightTarget::class;

    public function definition()
    {
        return [
            // user_idを追加
            'user_id' => User::factory(),  // ユーザーのファクトリからランダムにuser_idを設定
            'target_weight' => $this->faker->randomFloat(1, 40, 100), // ランダムな目標体重
        ];
    }
}
