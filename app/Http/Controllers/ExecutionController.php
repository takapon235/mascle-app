<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExecutionController extends Controller
{
    public function show()
    {
        return view('execution.execution');
    }
}
