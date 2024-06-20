<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    function index()
    {
        return view('pengembalian.index');
    }
}
