<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PiGLy ログイン</title>
  <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
</head>
<body>
  <div class="container">
    <div class="form-box">
      <h1 class="title">PiGLy</h1>
      <h2 class="subtitle">ログイン</h2>

      <form action="{{ route('login') }}" method="POST">
        @csrf

        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" placeholder="メールアドレスを入力" value="{{ old('email') }}">
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror

        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" placeholder="パスワードを入力">
        @error('password')
          <div class="error-message">{{ $message }}</div>
        @enderror

        <button type="submit">ログイン</button>
        <p class="link-text"><a href="/register/step1">アカウント作成はこちら</a></p>
      </form>
    </div>
  </div>
</body>
</html>
