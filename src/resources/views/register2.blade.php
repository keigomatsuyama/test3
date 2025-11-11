<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PiGLy 新規会員登録 - STEP2</title>
  <link rel="stylesheet" href="{{ asset('css/register2.css') }}">
</head>

<body>
  <div class="container">
    <div class="form-box">
      <h1 class="title">PiGLy</h1>
      <h2 class="subtitle">新規会員登録</h2>
      <p class="step">STEP2 体重データの入力</p>
      <form action="{{ route('register.step2.store') }}" method="POST">
        @csrf

        <label for="current_weight">現在の体重</label>
        <input type="number" name="current_weight" id="current_weight" step="0.1" placeholder="現在の体重を入力">
        @error('current_weight')
        <div style="color:red;">{{ $message }}</div>
        @enderror

        <label for="target_weight">目標の体重</label>
        <input type="number" name="target_weight" id="target_weight" step="0.1" placeholder="目標の体重を入力">
        @error('target_weight')
        <div style="color:red;">{{ $message }}</div>
        @enderror

        <button type="submit">登録</button>
      </form>
    </div>
  </div>
</body>

</html>