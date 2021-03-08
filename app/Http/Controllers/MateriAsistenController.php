<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Materi;
use App\Models\Kelas;
use Storage;

class MateriAsistenController extends Controller
{
    public function index($id)
    {
        $kelas = Kelas::find($id);
        if(request()->ajax())
        {
            return datatables()->of(Materi::where('kelas_id',$kelas->id))
            ->editColumn('edit', function ($data) use ($kelas) {
                $mystring = '<a href="'.route("materi.asisten.edit", [$kelas->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("materi.asisten.delete", [$kelas->id,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('asisten.dashboard.materi.index', compact('kelas'));
    }

    public function create($id)
    {
        $kelas = Kelas::find($id);
        return view('asisten.dashboard.materi.create', compact('kelas'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'deskripsi' => 'required',
        ]);

        $kelas = Kelas::find($id);

        if (empty($request->file('file'))) {
            $kelas->materi()->create([
              'title' => $request->title,
              'slug' => Str::slug($request->title),
              'deskripsi' => $request->deskripsi,
            ]);
        } else {
            $kelas->materi()->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'deskripsi' => $request->deskripsi,
                'file' => $request->file('file')->store('materi'), 
            ]);
        }

        return redirect()->route('materi.asisten', $kelas->id);
    }

    public function edit($id,$materi)
    {
        $kelas = Kelas::find($id);
        $materi = Materi::find($materi);
        return view('asisten.dashboard.materi.edit', compact('kelas','materi'));
    }

    public function update(Request $request, $id, $materi)
    {
        $this->validate($request, [
            'title' => 'required',
            'deskripsi' => 'required',
        ]);

        $kelas = Kelas::find($id);
        $materi = Materi::find($materi);
        if (empty($request->file('file'))) {
            $materi->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'deskripsi' => $request->deskripsi,
            ]);
        } else {
            Storage::delete($materi->file);
            $materi->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'deskripsi' => $request->deskripsi, 
                'file' => $request->file('file')->store('materi'), 
            ]);
        }

        return redirect()->route('materi.asisten',$kelas->id);
      }

      public function destroy($id,$materi)
        {
            $kelas = Kelas::find($id);
            $materi = Materi::find($materi);
            if (!$materi) {
                return redirect()->back();
            }
            Storage::delete($materi->file);
            $materi->delete();
            return redirect()->route('materi.asisten',$kelas->id);
        }
}
