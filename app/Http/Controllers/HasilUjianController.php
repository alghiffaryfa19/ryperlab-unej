<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ujian;
use Illuminate\Support\Str;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\HistoryUjian;

class HasilUjianController extends Controller
{
    public function index($id,$ujians)
    {
        $ujian = Ujian::with('kelas')->find($ujians);
        if(request()->ajax())
        {
            return datatables()->of(Nilai::with('mahasiswa.user')->where('ujian_id',$ujian->id)->select('nilais.*'))
            ->editColumn('total', function ($data) {
                return $data->nilai + $data->nilai_esay;
            })
            ->editColumn('edit', function ($data) use ($ujian) {
                $mystring = '<a href="'.route("hasil.ujian.asisten.edit", [$ujian->kelas->id,$ujian->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hasil.ujian.asisten.delete", [$ujian->kelas->id,$ujian->id,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })


            ->rawColumns(['total','edit'])
            ->make(true);
        }
        return view('asisten.dashboard.ujian.hasil.index', compact('ujian'));
    }

    public function edit($id,$ujians,$hasil)
    {
        $nilaii = Nilai::with('mahasiswa.user')->find($hasil);
        $pengerjaan = HistoryUjian::join('mahasiswas','mahasiswas.id','=','history_ujians.mahasiswa_id')->join('soals','soals.id','=','history_ujians.soal_id')
    		->where('history_ujians.mahasiswa_id',$nilaii->mahasiswa_id)
            ->whereHas('soal', function($q) use ($nilaii){
                $q->where('ujian_id',$nilaii->ujian_id);
             })
    		->get();
        return view('asisten.dashboard.ujian.hasil.edit', compact('nilaii','pengerjaan'));
    }

    public function update(Request $request, $id,$ujians,$nilaii)
    {
        $nilai = Nilai::with('mahasiswa.user')->find($nilaii);
        $nilai->update([
            'nilai_esay' => $request->nilai_esay,
        ]);

        return redirect()->route('hasil.ujian.asisten', [$nilai->ujian->kelas->id, $nilai->ujian->id]);
    }

    public function destroy($id,$ujians,$nilaii)
        {
            $nilai = Nilai::with('mahasiswa.user')->find($nilaii);
            if (!$nilai) {
                return redirect()->back();
            }
           
            
            $pengerjaan = HistoryUjian::whereHas('soal', function($q) use ($nilai){
                $q->where('ujian_id',$nilai->ujian_id);
            })->where('mahasiswa_id',$nilai->mahasiswa_id)->delete();

            $nilai->delete();

            return redirect()->route('hasil.ujian.asisten', [$nilai->ujian->kelas->id, $nilai->ujian->id]);
        }
}
