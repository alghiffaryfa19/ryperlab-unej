<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Asistant;
use App\Models\User;
use App\Models\MataKuliah;
use App\Models\Divisi;
use Storage;

class AsistantController extends Controller
{
    public function index()
    {
        $user = User::where('role',2)->select('id','name')->get();
        // $matkul = MataKuliah::select('id','name')->get();
        $divisi = Divisi::select('id','name')->get();
        if(request()->ajax())
        {
            return datatables()->of(Asistant::with('user','divisi')->select('asistants.*'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("asistant.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.asistant", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.asistant.index', compact('user','divisi'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'divisi_id' => 'required',
        ]);

        Asistant::create([
            'user_id' => $request->user_id,
            // 'matkul_id' => $request->matkul_id,
            'divisi_id' => $request->divisi_id,
            'foto' => $request->file('foto')->store('asisten'), 
        ]);

        return redirect()->route('asistant.index');
    }

    public function edit($id)
    {
        $user = User::where('role',2)->select('id','name')->get();
        $divisi = Divisi::select('id','name')->get();
        // $matkul = MataKuliah::select('id','name')->get();
        $asistant = Asistant::find($id);
        return view('admin.asistant.edit', compact('asistant','user','divisi'));        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            
        ]);


        $asistant = Asistant::find($id);

        if (empty($request->file('foto'))) {
            $asistant->update([
                'user_id' => $request->user_id,
                // 'matkul_id' => $request->matkul_id,
                'divisi_id' => $request->divisi_id,
            ]);
        } else {
            Storage::delete($asistant->foto);
            $asistant->update([
                'user_id' => $request->user_id,
                // 'matkul_id' => $request->matkul_id,
                'divisi_id' => $request->divisi_id,
                'foto' => $request->file('foto')->store('asisten'), 
            ]);
        }

        return redirect()->route('asistant.index');
      }
 
    public function destroy($id)
    {
        $asistant = Asistant::find($id);
        if (!$asistant) {
            return redirect()->back();
        }
        Storage::delete($asistant->foto);
        $asistant->delete();
        return redirect()->route('asistant.index');
    }      
}
