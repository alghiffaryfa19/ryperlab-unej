<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MataKuliah;
use Storage;

class MatkulController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(MataKuliah::query())
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("matkul.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.matkul", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.matkul.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'deskripsi' => 'required',
            'thumbnail' => 'mimes:jpeg,bmp,png,jpg,JPG',
        ]);

        if (empty($request->file('thumbnail'))) {
            MataKuliah::create([
              'name' => $request->name,
              'slug' => Str::slug($request->name),
              'deskripsi' => $request->deskripsi,
            ]);
        } else {
            MataKuliah::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'deskripsi' => $request->deskripsi,
                'thumbnail' => $request->file('thumbnail')->store('matkul'), 
              ]);
        }

        return redirect()->route('matkul.index');
    }

    public function edit($id)
    {
        $matkul = MataKuliah::find($id);
        return view('admin.matkul.edit', compact('matkul'));        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'deskripsi' => 'required',
            
        ]);
        $matkul = MataKuliah::find($id);
        if (empty($request->file('thumbnail'))) {
            $matkul->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'deskripsi' => $request->deskripsi,
            ]);
        } else {
            Storage::delete($matkul->thumbnail);
            $matkul->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'deskripsi' => $request->deskripsi,
                'thumbnail' => $request->file('thumbnail')->store('matkul'), 
            ]);
        }

        return redirect()->route('matkul.index');
      }
 
    public function destroy($id)
    {
        $matkul = MataKuliah::find($id);
        if (!$matkul) {
            return redirect()->back();
        }
        Storage::delete($matkul->thumbnail);
        $matkul->delete();
        return redirect()->route('matkul.index');
    }      
}
