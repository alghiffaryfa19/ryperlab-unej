<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\WaktuEnroll;
use Storage;

class WaktuEnrollController extends Controller
{

    public function index()
    {
        $waktu = WaktuEnroll::find(1);
        return view('admin.waktu.edit', compact('waktu'));        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'waktu' => 'required',
        ]);


        $waktu = WaktuEnroll::find(1);

        $waktu->update([
            'waktu' => $request->waktu,
        ]);

        return redirect()->route('waktu-enroll.index');
      }   
}
