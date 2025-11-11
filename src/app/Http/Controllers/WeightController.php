<?php

namespace App\Http\Controllers;

use Illuminate\Http\LoginRequest;
use App\Http\Requests\WeightUpdate1Request;
use App\Http\Requests\WeightUpdate2Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    public function setting()
    {
        return view('setting');
    }
    public function update1(WeightUpdate2Request $request)
    { // 認証ユーザー取得

        // バリデーション済みデータ取得
        $validated = $request->validated();

        // 既にレコードがあるかチェック
        $target = \App\Models\WeightTarget::firstOrNew(['user_id' => Auth::id()]);
        $target->target_weight = $validated['target_weight'];
        $target->save();

        // ✅ 更新後、体重管理画面にリダイレクト
        return redirect()->route('weight_logs.index')->with('success', '目標体重を更新しました。');
    }
    public function showStep2()
    {
        return view('register2');
    }
    public function storeStep2(RegisterRequest $request)
    {
        // RegisterRequest が自動でバリデーションを実行します
        $validated = $request->validated();

        // 保存処理（weight_targets テーブルに）
        WeightTarget::create([
            'user_id' => Auth::id(),
            'target_weight' => $validated['target_weight'],
        ]);

        // 成功したらリダイレクト
        return redirect()->route('weight_logs.index')->with('success', '体重データを登録しました！');
    }
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // 検索処理
        $query = $user->weightLogs();
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('date', [$request->from, $request->to]);
        }
        $weightLogs = $query->orderBy('date', 'desc')->paginate(8);

        // ✅ 目標体重を weight_targets テーブルから取得
        $targetWeight = \App\Models\WeightTarget::where('user_id', $user->id)->value('target_weight');

        // ✅ 最新体重を weight_logs から取得
        $latestWeight = $user->weightLogs()->latest('date')->value('weight');

        return view('top', compact('weightLogs', 'targetWeight', 'latestWeight'));
    }


    // 登録処理
    public function store(WeightUpdate1Request $request)
{
    $data = $request->validated();
    auth()->user()->weightLogs()->create([
        'date' => $data['date'],
        'weight' => $data['weight'],
        'calories' => $data['calorie'], // ← 保存時に変換
        'exercise_time' => $data['time'],
        'exercise_content' => $data['exercise'],
    ]);

    return redirect()->route('weight_logs.index')->with('success', 'データを追加しました！');
}


    public function weight($weightLogId)
    {
        $weightLog = WeightLog::findOrFail($weightLogId);
        return view('weightlog', compact('weightLog'));
    }
    public function update(WeightUpdate1Request $request, $weightLogId)
    {
        $validated = $request->validated(); // ここでバリデーション実行

        $log = WeightLog::findOrFail($weightLogId);
        $log->update([
            'date' => $validated['date'],
            'weight' => $validated['weight'],
            'calories' => $validated['calorie'], // ← DBのカラム名に合わせる
            'exercise_time' => $validated['time'], // ← 同上
            'exercise_content' => $validated['exercise'], // ← 同上
        ]);

        return redirect()->route('weight_logs.index')->with('success', '更新しました。');
    }

    public function destroy($weightLogId)
    {
        $log = WeightLog::findOrFail($weightLogId);
        $log->delete();

        return redirect()->route('weight_logs.index')->with('success', '削除しました。');
    }
}
