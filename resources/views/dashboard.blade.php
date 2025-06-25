@extends('layouts.app')

@section('content')
    <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
        <div class="hero-content text-center my-10">
            <div class="max-w-md mb-10">
                <h2>Welcome to the Muscle-App</h2>
                {{-- 筋トレ実行画面へのボタン --}}
                <a class="btn btn-primary btn-lg normal-case" href="{{ route('execution.execution') }}">START</a>
            </div>
        </div>
    </div>
@endsection