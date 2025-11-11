<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>目標体重設定</title>
  <link rel="stylesheet" href="{{ asset('css/setting.css') }}">
</head>

<body>
  <header>
    <h1 class="logo">PiGLy</h1>
    <div class="actions">
      <a href="#" class="button">目標体重設定</a>
      <button class="button logout">ログアウト</button>
    </div>
  </header>

  <main>
    <div class="setting-card">
      <h2>目標体重設定</h2>
      <form action="{{ route('weight_target.update') }}" method="POST">
        @csrf
        <input type="number" step="0.1" name="target_weight"
          value="{{ old('target_weight', $weightTarget->target_weight ?? '') }}"
          class="form-control">
        @error('target_weight')
        <div class="error-text">{{ $message }}</div>
        @enderror
        <div class="buttons">
          <a href="/weight_logs" class="back">戻る</a>
          <button type="submit" class="update">更新</button>
        </div>
      </form>
    </div>
  </main>
</body>

</html>