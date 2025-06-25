@extends('layouts.app')

@section('content')
<div class="prose hero bg-base-200 mx-auto max-w-full rounded">
    <div class="hero-content text-center my-10">
        <div class="max-w-md mb-10">
            <h2>Work Out !</h2>

            {{-- タイマーを埋め込む --}}
            @include('partials.timer')

            {{-- 筋トレ終了ボタン --}}
            <form action="{{ route('training.memo.form') }}" method="GET" id="training-form">
                @csrf
                <input type="hidden" name="total_time" id="total_time" value="0">
                <button type="submit" class="btn btn-primary btn-lg normal-case" onclick="setTotalTime()">筋トレ終了</button>
            </form>
        </div>
    </div>
</div>

{{-- 経過時間表示用の要素を右下に配置 --}}
<div id="elapsed-time" class="text-lg font-bold mb-4" style="position: fixed; bottom: 20px; right: 20px;">
    経過時間: <span id="time">00:00:00</span>
</div>

<script>
    let startTime = Date.now();
    let elapsedTime = 0;
    let timer;

    //経過時間を更新する関数
    function updateElapsedTime() {
        elapsedTime = Math.floor((Date.now() - startTime) / 1000); // 秒単位で計算
        document.getElementById('time').innerText = formatTime(elapsedTime); // 表示を更新
    }

    // 時間を「00:00:00」の形式にフォーマットする関数
    function formatTime(seconds) {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        const secs = seconds % 60;

        // フォーマットを整える
        return String(hours).padStart(2, '0') + ':' +
            String(minutes).padStart(2, '0') + ':' +
            String(secs).padStart(2, '0');

    }

    // タイマーを開始
    timer = setInterval(updateElapsedTime, 1000); // 1秒ごとに更新

    function setTotalTime() {
        // ボタンが押されたときにtotal_timeを設定
        document.getElementById('total_time').value = elapsedTime; // 隠しフィールドに値を設定
        clearInterval(timer); // タイマーをクリア
    }
</script>
@endsection