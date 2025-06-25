@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-4">ユーザー詳細</h1>
    
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-semibold mb-2">{{ $user->name }}</h2>
        <p class="text-gray-700 mb-2">メール: {{ $user->email }}</p>
        <p class="text-gray-700 mb-2">登録日: {{ $user->created_at->format('Y年m月d日') }}</p>
    </div>

    <h2 class="text-2xl font-bold mb-4">筋トレ履歴</h2>
    @if($trainingHistory->isEmpty())
        <p class="text-gray-500">筋トレ履歴はありません。</p>
    @else
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">日付</th>
                    <th class="py-2 px-4 border-b">トレーニング時間</th>
                    <th class="py-2 px-4 border-b">メモ内容</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trainingHistory as $record)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">{{ $record->date }}</td>
                        <td class="py-2 px-4 border-b">{{ formatTime($record->total_time) }}</td>
                        <td class="py-2 px-4 border-b">{{ $record->training_memo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    {{-- ダッシュボードに戻るボタン --}}
    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">トップページに戻る</a>
    </div>
</div>

@php
    // 時間を「00:00:00」形式にフォーマットする関数
    function formatTime($totalTime) {
        $hours = floor($totalTime / 3600);
        $minutes = floor(($totalTime % 3600) / 60);
        $seconds = $totalTime % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
@endphp

@endsection