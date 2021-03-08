<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Assigments;
use App\Models\Kelas;
use Storage;

class TugasAsistenController extends Controller
{
    public function index($id)
    {
        $kelas = Kelas::find($id);
        if(request()->ajax())
        {
            return datatables()->of(Assigments::where('kelas_id',$kelas->id))
            ->editColumn('edit', function ($data) use ($kelas) {
                $mystring = '<a href="'.route("hasil.tugas.asisten", [$kelas->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Submission</a><a href="'.route("tugas.asisten.edit", [$kelas->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("tugas.asisten.delete", [$kelas->id,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('asisten.dashboard.tugas.index', compact('kelas'));
    }

    public function create($id)
    {
        $kelas = Kelas::find($id);
        return view('asisten.dashboard.tugas.create', compact('kelas'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'deskripsi' => 'required',
            'deadline' => 'required',
        ]);

        $kelas = Kelas::find($id);

        $kelas->assignment()->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('tugas.asisten', $kelas->id);
    }

    public function edit($id,$materi)
    {
        $tugas = Assigments::with('kelas')->find($materi);
        return view('asisten.dashboard.tugas.edit', compact('tugas'));
    }

    public function update(Request $request, $id, $materi)
    {
        $this->validate($request, [
            'title' => 'required',
            'deskripsi' => 'required',
        ]);

        $tugas = Assigments::with('kelas')->find($materi);
        $tugas->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('tugas.asisten',$tugas->kelas->id);
      }

      public function destroy($id,$materi)
        {
            $tugas = Assigments::with('kelas')->find($materi);
            if (!$tugas) {
                return redirect()->back();
            }
            
            $tugas->delete();
            return redirect()->route('tugas.asisten',$tugas->kelas->id);
        }
}
