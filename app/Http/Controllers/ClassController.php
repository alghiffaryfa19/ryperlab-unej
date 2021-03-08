<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\Asistant;

class ClassController extends Controller
{
    public function index()
    {
        $asistant = Asistant::with('user')->get();
        $matkul = MataKuliah::select('id','name')->get();
        if(request()->ajax())
        {
            return datatables()->of(Kelas::with('matkul')->select('kelas.*'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("materi", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Materi</a><a href="'.route("class.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.class", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.class.index', compact('asistant','matkul'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            
        ]);

        $kelas = Kelas::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            // 'assitant_id' => $request->assitant_id,
            'matkul_id' => $request->matkul_id,
        ]);

        $kelas->asistant()->attach($request->values);

        return redirect()->route('class.index');
    }

    public function edit($id)
    {
        $asistant = Asistant::with('user')->get();
        $class = Kelas::find($id);
        $matkul = MataKuliah::select('id','name')->get();
        return view('admin.class.edit', compact('class','asistant','matkul'));        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
           
        ]);


        $class = Kelas::find($id);
        $class->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            // 'assitant_id' => $request->assitant_id,
            'matkul_id' => $request->matkul_id,
        ]);

        $class->asistant()->sync($request->values);

        return redirect()->route('class.index');
      }
 
    public function destroy($id)
    {
        $class = Kelas::find($id);
        if (!$class) {
            return redirect()->back();
        }
        
        $class->delete();
        return redirect()->route('class.index');
    }
}
