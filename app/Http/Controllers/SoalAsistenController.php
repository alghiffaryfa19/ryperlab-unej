<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ujian;
use Illuminate\Support\Str;
use App\Models\Kelas;
use App\Models\Soal;

class SoalAsistenController extends Controller
{
    public function index($id,$ujians)
    {
        $ujian = Ujian::with('kelas')->find($ujians);
        if(request()->ajax())
        {
            return datatables()->of(Soal::where('ujian_id',$ujian->id))
            ->editColumn('soals', function ($data) {
                $mystring = Str::limit(str_replace("&nbsp;", ' ', strip_tags($data->soal)), 50, ' ....');;
                return $mystring;
            })
            ->editColumn('edit', function ($data) use ($ujian) {
                $mystring = '<a href="'.route("soal.asisten.edit", [$ujian->kelas->id,$ujian->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("soal.asisten.delete", [$ujian->kelas->id,$ujian->id,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })


            ->rawColumns(['soals','edit'])
            ->make(true);
        }
        return view('asisten.dashboard.soal.index', compact('ujian'));
    }

    public function create($id,$ujians)
    {
        $ujian = Ujian::with('kelas')->find($ujians);
        return view('asisten.dashboard.soal.create', compact('ujian'));
    }

    public function store(Request $request, $id, $ujians)
    {
        $this->validate($request, [
            'soal' => 'required',
        ]);

        $ujian = Ujian::with('kelas')->find($ujians);

        $ujian->soal()->create([
            'soal' => $request->soal,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'option_5' => $request->option_5,
            'right_answer' => $request->right_answer,
            'pembahasan' => $request->pembahasan,
            'skor' => $request->skor,
        ]);

        return redirect()->route('soal.asisten', [$ujian->kelas->id, $ujian->id]);
    }

    public function edit($id,$ujians,$soal)
    {
        $soal = Soal::with('ujian.kelas')->find($soal);
        return view('asisten.dashboard.soal.edit', compact('soal'));
    }

    public function update(Request $request, $id,$ujians,$soal)
    {
        $soal = Soal::with('ujian.kelas')->find($soal);
        $soal->update([
            'soal' => $request->soal,
            'option_1' => $request->option_1,
            'option_2' => $request->option_2,
            'option_3' => $request->option_3,
            'option_4' => $request->option_4,
            'option_5' => $request->option_5,
            'right_answer' => $request->right_answer,
            'pembahasan' => $request->pembahasan,
            'skor' => $request->skor,
        ]);

        return redirect()->route('soal.asisten', [$soal->ujian->kelas->id, $soal->ujian->id]);
    }

    public function destroy($id,$ujians,$soal)
        {
            $soal = Soal::with('ujian.kelas')->find($soal);
            if (!$soal) {
                return redirect()->back();
            }
           
            $soal->delete();
            return redirect()->route('soal.asisten', [$soal->ujian->kelas->id, $soal->ujian->id]);
        }
}
