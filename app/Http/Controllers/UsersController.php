<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\UserDetail;

class UsersController extends Controller
{
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $trainingHistory = UserDetail::where('user_id', $id)->get();


        return view('users.show', compact('user', 'trainingHistory'));
    }
}
