<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assigments;
use Illuminate\Support\Str;
use App\Models\Kelas;
use App\Models\Submissions;
use Storage;


class HasilTugasController extends Controller
{
    public function index($id,$tugas)
    {
        $tugas = Assigments::with('kelas')->find($tugas);
        if(request()->ajax())
        {
            return datatables()->of(Submissions::with('mahasiswa.user')->where('assigments_id',$tugas->id)->select('submissions.*'))
            ->editColumn('edit', function ($data) use ($tugas) {
                $mystring = '<a href="'.route("hasil.tugas.asisten.edit", [$tugas->kelas->id,$tugas->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Buka</a><a href="'.route("hasil.tugas.asisten.delete", [$tugas->kelas->id,$tugas->id,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })


            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('asisten.dashboard.tugas.hasil.index', compact('tugas'));
    }

    public function edit($id,$tugas,$hasil)
    {
        $submission = Submissions::with('assigment','mahasiswa.user')->find($hasil);
        return view('asisten.dashboard.tugas.hasil.edit', compact('submission'));
    }

    public function destroy($id,$tugas,$hasil)
        {
            $submission = Submissions::with('assigment','mahasiswa.user')->find($hasil);
            if (!$submission) {
                return redirect()->back();
            }
            Storage::delete($submission->file);
            $submission->delete();
            return redirect()->route('hasil.tugas.asisten', [$submission->assigment->kelas->id, $submission->assigment->id]);
        }
}
