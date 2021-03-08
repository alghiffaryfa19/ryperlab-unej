<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class DashboardAsistenController extends Controller
{
    public function asist()
    {
        $kelas = Kelas::whereHas('asistant', function($q){
            $q->where('asistant_id', auth()->user()->asistant->id);
         })->get();
        return view('asisten.dashboard.index', compact('kelas'));
    }
}
