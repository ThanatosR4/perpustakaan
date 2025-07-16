<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktivitas;

class AktivitasController extends Controller
{
    public function index()
    {
        $aktivitas = Aktivitas::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('aktivitas.index', compact('aktivitas'));
    }
}
