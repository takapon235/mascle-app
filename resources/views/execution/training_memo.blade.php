{{-- resources/views/training/memo.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">筋トレメモを記入</h2>
    
    <form action="{{ route('training.memo.store') }}" method="POST">
        @csrf
        <input type="hidden" name="total_time" value="{{ request('total_time') }}">
        <div class="mb-4">
            <label for="training_memo" class="block text-sm font-medium">メモ</label>
            <textarea name="training_memo" id="training_memo" rows="5" class="w-full border rounded p-2" placeholder="今日のトレーニング内容..." required></textarea>
            @error('training_memo')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-center">
            <button type="submit" class="btn btn-wide btn-primary">送信</button>
        </div>
    </form>
</div>
@endsection