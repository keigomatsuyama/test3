<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PiGLy 新規会員登録</title>
  <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
</head>
<body>
  <div class="container">
    <div class="form-box">
      <h1 class="title">PiGLy</h1>
      <h2 class="subtitle">新規会員登録</h2>
      <p class="step">STEP1 アカウント情報の登録</p>

      <form action="{{ route('register') }}" method="POST">
        @csrf
        <label for="name">お名前</label>
        <input type="text" id="name" name="name" placeholder="名前を入力">
        @error('name')
          <div class="error-message">{{ $message }}</div>
        @enderror

        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" placeholder="メールアドレスを入力">
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror

        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" placeholder="パスワードを入力">
        @error('password')
          <div class="error-message">{{ $message }}</div>
        @enderror

        <button type="submit">次に進む</button>
        <p class="login-link"><a href="/login">ログインはこちら</a></p>
      </form>
    </div>
  </div>
</body>
</html>
