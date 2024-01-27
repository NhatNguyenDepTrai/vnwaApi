<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Process;

class ProcessController extends Controller
{
    function getProcess()
    {
        $data = Process::where('status', 1)
            ->orderBy('ord', 'ASC')
            ->get();
        return response()->json($data);
    }
}
