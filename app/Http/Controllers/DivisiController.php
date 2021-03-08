<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Divisi;
use Storage;

class DivisiController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Divisi::query())
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("divisi.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.divisi", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.divisi.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Divisi::create([
            'name' => $request->name,
        ]);

        return redirect()->route('divisi.index');
    }

    public function edit($id)
    {
        $divisi = Divisi::find($id);
        return view('admin.divisi.edit', compact('divisi'));        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);


        $divisi = Divisi::find($id);

        $divisi->update([
            'name' => $request->name,
        ]);

        return redirect()->route('divisi.index');
      }
 
    public function destroy($id)
    {
        $divisi = Divisi::find($id);
        if (!$divisi) {
            return redirect()->back();
        }
       
        $divisi->delete();
        return redirect()->route('divisi.index');
    }      
}
