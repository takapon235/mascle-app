<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\UserDetail;

class UserDetailsController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function createMemo()
    {
        return view('execution.training_memo');
    }

    public function handleTrainingEnd()
    {
        if (Auth::check()) {
            return redirect()->route('training.memo.form');
        }

        return redirect()->route('dashboard');
    }

    public function storeMemo(Request $request)
    {
        $request->validate([
            'training_memo' => 'required|max:1000',
            'total_time' => 'required|integer', // total_timeのバリデーションを追加
        ]);

        $user = auth()->user();

        // ログインしていない場合の処理
        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインしてください。');
        }

        UserDetail::create([
            'user_id' => $user->id,
            'date' => now()->toDateString(),
            'total_time' => $request->total_time, // 受け取ったtotal_timeを格納
            'training_memo' => $request->training_memo, // 受け取ったメモを格納
        ]);

        return redirect()->route('dashboard')->with('success', 'メモを保存しました！');
    }
}