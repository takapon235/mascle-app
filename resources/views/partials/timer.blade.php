<div class="mb-6">
    <div id="lap-timer" class="text-lg font-bold mb-4"><span id="lap-time">00:00:00</span></div>
    <button id="start-lap" class="btn btn-primary">START</button>
    <button id="stop-lap" class="btn btn-secondary" disabled>STOP</button>
    <button id="lap-record" class="btn btn-soft btn-primary" disabled>LAP</button>
    <button id="clear-lap" class="btn btn-soft btn-secondary" disabled>CLEAR</button>

    <div class="mt-4">
        <h4 class="text-lg font-bold">LAP:</h4>
        <ul id="lap-list" class="list-disc list-inside"></ul>
    </div>
</div>

<script>
    let lapStartTime;
    let lapTimerInterval;
    let lapElapsedTime = 0;

    // タイマー更新関数
    function updateLapTimer() {
        lapElapsedTime = Math.floor((Date.now() - lapStartTime) / 1000); // 秒単位で計算
        document.getElementById('lap-time').innerText = formatTime(lapElapsedTime);
    }

    // 時間を「00:00:00」形式にフォーマットする関数
    function formatTime(seconds) {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        const secs = seconds % 60;

        return String(hours).padStart(2, '0') + ':' +
               String(minutes).padStart(2, '0') + ':' +
               String(secs).padStart(2, '0');
    }

    // スタートボタンのクリックイベント
    document.getElementById('start-lap').onclick = function() {
        lapStartTime = Date.now() - lapElapsedTime * 1000; // 既存の経過時間を考慮
        lapTimerInterval = setInterval(updateLapTimer, 1000); // 1秒ごとに更新
        this.disabled = true; // スタートボタンを無効化
        document.getElementById('stop-lap').disabled = false; // ストップボタンを有効化
        document.getElementById('lap-record').disabled = false; // ラップ記録ボタンを有効化
        document.getElementById('clear-lap').disabled = false;
    };

    // ストップボタンのクリックイベント
    document.getElementById('stop-lap').onclick = function() {
        clearInterval(lapTimerInterval);
        this.disabled = true; // ストップボタンを無効化
        document.getElementById('start-lap').disabled = false; // スタートボタンを有効化
    };

    // ラップ記録ボタンのクリックイベント
    document.getElementById('lap-record').onclick = function() {
        const lapTime = formatTime(lapElapsedTime);
        const lapList = document.getElementById('lap-list');
        const lapItem = document.createElement('li');
        lapItem.innerText = lapTime;
        lapList.appendChild(lapItem);

    };

    // クリアボタンのクリックイベント
    document.getElementById('clear-lap').onclick = function() {
        clearInterval(lapTimerInterval);
        lapElapsedTime = 0;
        document.getElementById('lap-time').innerText = formatTime(lapElapsedTime);
        document.getElementById('lap-list').innerHTML = '';
        document.getElementById('start-lap').disabled = false;
        this.disabled = true;
    };
</script>
