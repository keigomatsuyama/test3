<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weight Log - PiGLy</title>
  <link rel="stylesheet" href="{{ asset('css/weightlog.css') }}">
</head>

<body>
  <header>
    <h1 class="logo">PiGLy</h1>
    <div class="header-buttons">
      <button class="setting-btn">⚙ 目標体重設定</button>
      <button class="logout-btn">🔓 ログアウト</button>
    </div>
  </header>

  <main>
    <div class="form-container">
      <h2>Weight Log</h2>

      {{-- 更新フォーム --}}
      <form method="POST" action="{{ route('weight_logs.update', ['weightLogId' => $weightLog->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="date">日付</label>
          <input
            type="date"
            id="date"
            name="date"
            class="form-control"
            value="{{ old('date', $weightLog->date ?? now()->format('Y-m-d')) }}">
          @error('date')
          <small class="error-text">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="weight">体重</label>
          <div class="input-inline">
            <input type="number" id="weight" name="weight" value="{{ old('weight', $weightLog->weight) }}" step="0.1">
            <span>kg</span>
          </div>
          @error('weight')
          <small class="error-text">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="calorie">摂取カロリー</label>
          <div class="input-inline">
            <input type="number" id="calorie" name="calorie" value="{{ old('calorie', $weightLog->calorie) }}">
            <span>cal</span>
          </div>
          @error('calorie')
          <small class="error-text">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="time">運動時間</label>
          <input type="time" id="time" name="time" value="{{ old('time', $weightLog->time) }}">
          @error('time')
          <small class="error-text">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="exercise">運動内容</label>
          <textarea id="exercise" name="exercise" placeholder="運動内容を追加">{{ old('exercise', $weightLog->exercise) }}</textarea>
          @error('exercise')
          <small class="error-text">{{ $message }}</small>
          @enderror
        </div>

        <div class="button-group">
          <a href="{{ route('weight_logs.index') }}" class="back-btn">戻る</a>
          <button type="submit" class="update-btn">更新</button>
        </div>
      </form>

      {{-- 削除フォーム --}}
      <form method="POST" action="{{ route('weight_logs.delete', ['weightLogId' => $weightLog->id]) }}" onsubmit="return confirm('このデータを削除しますか？');">
        @csrf
        <button type="submit" class="delete-btn">🗑</button>
      </form>
    </div>
  </main>
</body>

</html>