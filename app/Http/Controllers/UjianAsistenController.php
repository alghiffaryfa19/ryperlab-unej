<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Ujian;
use App\Models\Kelas;
use Storage;

class UjianAsistenController extends Controller
{
    public function index($id)
    {
        $kelas = Kelas::find($id);
        if(request()->ajax())
        {
            return datatables()->of(Ujian::where('kelas_id',$kelas->id))
            ->editColumn('edit', function ($data) use ($kelas) {
                $mystring = '<a href="'.route("hasil.ujian.asisten", [$kelas->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Hasil</a><a href="'.route("soal.asisten", [$kelas->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Soal</a><a href="'.route("ujian.asisten.edit", [$kelas->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("ujian.asisten.delete", [$kelas->id,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->editColumn('durasi', function ($data) {
                $mystring = $data->lama_ujian/3600;
                $durasi = strval($mystring). " Jam";
                return $durasi;
            })


            ->rawColumns(['edit','durasi'])
            ->make(true);
        }
        return view('asisten.dashboard.ujian.index', compact('kelas'));
    }

    public function create($id)
    {
        $kelas = Kelas::find($id);
        return view('asisten.dashboard.ujian.create', compact('kelas'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'date_ujian' => 'required',
            'time_start' => 'required',
            'jam_tutup' => 'required',
            'lama_ujian' => 'required',
        ]);

        $kelas = Kelas::find($id);

        $kelas->ujian()->create([
            'nama' => $request->nama,
            'date_ujian' => $request->date_ujian,
            'time_start' => $request->time_start,
            'jam_tutup' => $request->jam_tutup,
            'lama_ujian' => $request->lama_ujian*3600,
        ]);

        return redirect()->route('ujian.asisten', $kelas->id);
    }

    public function edit($id,$ujian)
    {
        $kelas = Kelas::find($id);
        $ujian = Ujian::find($ujian);
        return view('asisten.dashboard.ujian.edit', compact('kelas','ujian'));
    }

    public function update(Request $request, $id, $ujian)
    {
        $this->validate($request, [
            'nama' => 'required',
            'date_ujian' => 'required',
            'time_start' => 'required',
            'jam_tutup' => 'required',
            'lama_ujian' => 'required',
        ]);

        $kelas = Kelas::find($id);
        $ujian = Ujian::find($ujian);
        $ujian->update([
            'nama' => $request->nama,
            'date_ujian' => $request->date_ujian,
            'time_start' => $request->time_start,
            'jam_tutup' => $request->jam_tutup,
            'lama_ujian' => $request->lama_ujian*3600,
        ]);

        return redirect()->route('ujian.asisten',$kelas->id);
      }

      public function destroy($id,$ujian)
        {
            $kelas = Kelas::find($id);
            $ujian = Ujian::find($ujian);
            if (!$ujian) {
                return redirect()->back();
            }
           
            $ujian->delete();
            return redirect()->route('ujian.asisten',$kelas->id);
        }
}
