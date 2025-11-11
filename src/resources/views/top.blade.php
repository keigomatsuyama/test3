<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>PiGLy ダッシュボード</title>
  <link rel="stylesheet" href="{{ asset('css/top.css') }}">

</head>

<body>
  <header>
    <h1 class="logo">PiGLy</h1>
    <div class="actions">
      <!-- ✅ 目標体重設定 -->
      <a href="/weight/setting" class="button">目標体重設定</a>

      <!-- ✅ Fortify用ログアウト -->
      <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="button logout">ログアウト</button>
      </form>
    </div>
  </header>

  <main>
    <section class="summary">
      <div class="card">
        <p>目標体重</p>
        <h2>{{ number_format($targetWeight, 1) }} <span>kg</span></h2>
      </div>
      <div class="card">
        <p>目標まで</p>
        <h2>{{ number_format($targetWeight - $latestWeight, 1) }} <span>kg</span></h2>
      </div>
      <div class="card">
        <p>最新体重</p>
        <h2>{{ number_format($latestWeight, 1) }} <span>kg</span></h2>
      </div>
    </section>
    <section class="log">
      <form method="GET" action="{{ route('weight_logs.index') }}" class="search-bar">
        <input type="date" name="from" id="start-date" value="{{ request('from') }}">
        〜
        <input type="date" name="to" id="end-date" value="{{ request('to') }}">
        <button type="submit" class="search-btn">検索</button> <button type="button" class="reset-btn" onclick="window.location.href='/weight_logs'">リセット</button>
        <label for="modal-toggle" class="add-btn">データ追加</label>
      </form>
      <!-- モーダル開閉トリガー -->
      <input type="checkbox" id="modal-toggle" class="hidden-toggle" {{ $errors->any() ? 'checked' : '' }}>

      <!-- モーダル本体 -->
      <div class="modal">
        <div class="modal-content">
          <h2>Weight Logを追加</h2>
          <form method="POST" action="{{ route('weight_logs.store') }}">
            @csrf
            <label>
              日付 <span class="required">必須</span><br>
              <input type="date" name="date" value="{{ old('date') }}">               @error('date')
              <div class="error-message">{{ $message }}</div>
              @enderror
            </label>

            <label>
              体重 <span class="required">必須</span><br>
              <input type="number" name="weight" step="0.1" value="{{ old('weight') }}" > kg
              @error('weight')
              <div class="error-message">{{ $message }}</div>
              @enderror
            </label>

            <label>
              摂取カロリー <span class="required">必須</span><br>
              <input type="number" name="calorie" value="{{ old('calorie') }}" > cal
              @error('calorie')
              <div class="error-message">{{ $message }}</div>
              @enderror
            </label>

            <label>
              運動時間 <span class="required">必須</span><br>
              <input type="time" name="time" value="{{ old('time') }}" >
              @error('time')
              <div class="error-message">{{ $message }}</div>
              @enderror
            </label>

            <label>
              運動内容<br>
              <textarea name="exercise" placeholder="運動内容を追加">{{ old('exercise') }}</textarea>
              @error('exercise')
              <div class="error-message">{{ $message }}</div>
              @enderror
            </label>

            <div class="buttons">
              <label for="modal-toggle" class="btn cancel">戻る</label>
              <button type="submit" class="btn submit">登録</button>
            </div>
          </form>
        </div>
      </div>

      <table class="log-table">
        <thead>
          <tr>
            <th>日付</th>
            <th>体重</th>
            <th>食事摂取カロリー</th>
            <th>運動時間</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($weightLogs as $log)
          <tr>
            <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
            <td>{{ number_format($log->weight, 1) }}kg</td>
            <td>{{ $log->calories }}cal</td>
            <td>{{ $log->exercise_time ?? '00:00' }}</td>
            <td>
              <a href="{{ route('weight_logs.weight', ['weightLogId' => $log->id]) }}">✏️</a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5">データがありません</td>
          </tr>
          @endforelse
        </tbody>
      </table>

      <div class="pagination-wrapper">
        {{ $weightLogs->onEachSide(1)->links('vendor.pagination.tailwind') }}
      </div>
    </section>

    </section>
  </main>
</body>
@if ($errors->any())
<script>
  window.addEventListener('load', () => {
    document.getElementById('modal-toggle').checked = true;
  });
</script>
@endif

</html>