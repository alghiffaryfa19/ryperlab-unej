<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Ujian;
use App\Models\StartUjian;
use App\Models\Soal;
use App\Models\SoalTemp;
use App\Models\Kelas;
use App\Models\HistoryUjian;
use Carbon\Carbon;
use App\Models\Nilai;
use Storage;

class MahasiswaDuaController extends Controller
{
    public function exam($slug)
    {
        $kelas = Kelas::where('slug',$slug)->first();
        $exam = Ujian::where('kelas_id',$kelas->id);
        if(request()->ajax())
        {
            return datatables()->of($exam)
            ->editColumn('edit', function ($data) use ($kelas) {
                if (cekSudahDikerjakan($data->id,auth()->user()->mahasiswa->id) && cekMasihDikerjakan($data->id,auth()->user()->mahasiswa->id) == 0) {
                    $mystring = '<a href="#" class="bg-green-500 text-white p-2 rounded mr-2 font-bold">Sudah dikerjakan</a>';
                }

                elseif (cekMasihDikerjakan($data->id,auth()->user()->mahasiswa->id) == 1) {
                    $mystring = '<a href="'.route("kerjakan", [$data->id,1]).'" class="bg-yellow-500 text-white p-2 rounded mr-2 font-bold">Lanjutkan</a>';
                }

                else {
                    if (waktu($data->date_ujian)) {
                        if (date('H:i:s',strtotime(Carbon::now()->format('H:i:s'))) < date('H:i:s',strtotime($data->jam_tutup))) {
                            $mystring = '<a href="'.route("detail_exam", [$kelas->slug,$data->id]).'" class="bg-blue-500 text-white p-2 rounded mr-2 font-bold">Kerjakan</a>';
                        } else {
                            $mystring = '<a class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Waktu Habis</a>';
                        }
                        
                        
                    } else {
                        $mystring = '<a class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Belum Buka</a>';
                    }
                    
                    
                }
                
                // $mystring = '<a href="s" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Submit</a>';
                return $mystring;
            })

            ->editColumn('durasi', function ($data) {
                $mystring = $data->lama_ujian/3600;
                $durasi = strval($mystring). " Jam";
                return $durasi;
            })

            ->editColumn('tutup', function ($data) {
                
                if (date('H:i:s',strtotime(Carbon::now()->format('H:i:s'))) < date('H:i:s',strtotime($data->jam_tutup))) {
                    $mystring = Carbon::parse($data->jam_tutup)->format('H:i:s');
                }

                else {
                    $mystring = 'Waktu Habis';
                }

                return $mystring;
                
            })

            ->rawColumns(['status','waktu','edit','durasi','tutup'])
            ->make(true);
        }
        
        return view('mahasiswa.class.exam.index', compact('exam','kelas'));
        
    }

    public function detail_exam($kelas,$id)
    {
        

        if (cekSudahDikerjakan($id,auth()->user()->mahasiswa->id)) {
            
            return redirect()->route('mahasiswa');
        }

        else
        {
            $class = Kelas::where('slug',$kelas)->first();
            $exam = Ujian::with('kelas')->find($id);
            $tutup = date('H:i:s',strtotime($exam->jam_tutup));
            $carbon = date('H:i:s',strtotime(Carbon::now()->format('H:i:s')));

            // return $carbon;
            
            if ($carbon < $tutup) {
                return view('mahasiswa.class.exam.detail', compact('exam','class'));
            }

            else {
                return redirect()->route('mahasiswa');
            }
        }
    }

    public function start_ujian(Request $request)
    {
        $lm_ujian = $request->lm_ujian;
        $tutup = strtotime($request->tutup);

        $time_end = strtotime(date('H:i:s'));
        $jam_habis = date('H:i:s',$time_end);

        $jam_tutup = date('H:i:s',$tutup);
        

        $selisih = $tutup-$time_end;
        
        if ($selisih > $lm_ujian) {
            $habis = strtotime(date('H:i:s')) + $lm_ujian;
        } else {
            $habis = strtotime(date('H:i:s')) + $selisih;
        }

        StartUjian::create([
            'ujian_id' => $request->ujian_id,
            'mahasiswa_id' => auth()->user()->mahasiswa->id,
            'time_start' => Carbon::parse(Carbon::now())->format('H:i:s'),
            'time_end' => date('H:i:s',$habis),
            'is_active' => 1,
          ]);

        $soal = Soal::where('ujian_id',$request->ujian_id)->get();
        $no = 0;
        foreach ($soal as $data) {
            $no++;
            SoalTemp::create([
                'nomor_soal' => $no,
                'ujian_id' => $data->ujian_id,
                'mahasiswa_id' => auth()->user()->mahasiswa->id,
                'soal_id' => $data->id,
              ]);

            }

    	$getSoal = SoalTemp::with('soal:id,ujian_id')->whereHas('soal', function($q) use ($request){
            $q->where('ujian_id', $request->ujian_id);
         })->where('mahasiswa_id',auth()->user()->mahasiswa->id)->orderBy('id','ASC')->first();
    	echo json_encode(array('response' => TRUE, 
            'ujian_id' => $getSoal->soal->ujian_id,
            'no_soal' => $getSoal['nomor_soal']
        ));
    }

    public function getSoal($ujian,$no_soal)
    {
        if (cekMasihDikerjakan($ujian,auth()->user()->mahasiswa->id) == 1) {
            $soal = Soal::join('soal_temps','soal_temps.soal_id','=','soals.id')
            ->where('soals.ujian_id',$ujian)->where('soal_temps.nomor_soal',$no_soal)->first();
            $daftarSoal = Soal::join('soal_temps','soal_temps.soal_id','=','soals.id')
                ->where('soal_temps.mahasiswa_id',auth()->user()->mahasiswa->id)
                ->where('soals.ujian_id',$ujian)->get();
            $pengerjaan = StartUjian::with('ujian:id,nama')->where('mahasiswa_id',auth()->user()->mahasiswa->id)
                ->where('ujian_id',$ujian)->first();
            return view('mahasiswa.class.exam.cbt',compact('soal','pengerjaan','daftarSoal'));
        }
        else {
            return redirect()->route('mahasiswa');
        }
    	
    }

    public function simpanSoal(Request $request)
    {
        if(cekSdhJawabSoal($request->soal_id,auth()->user()->mahasiswa->id)){
           $getIDhis = HistoryUjian::where('soal_id',$request->soal_id)->where('mahasiswa_id',auth()->user()->mahasiswa->id)->first();
            $hisPengerjaan = HistoryUjian::findOrfail($getIDhis['id']);
        }else{
            $hisPengerjaan = new HistoryUjian();
        } 
        $hisPengerjaan->soal_id = $request->soal_id;
        $hisPengerjaan->mahasiswa_id = auth()->user()->mahasiswa->id;
        $hisPengerjaan->your_answer = $request->answer;
        $hisPengerjaan->betul_or_tidak = cekjawaban($request->soal_id,$request->answer);
        $hisPengerjaan->yakin_or_not = $request->kondisi;
        $hisPengerjaan->save();
        echo json_encode(true);
    }

    public function konfirmasi(Request $request, $id)
    {
        if (cekMasihDikerjakan($id,auth()->user()->mahasiswa->id) == 1) {
            $ragu = HistoryUjian::whereHas('soal', function($q) use ($request,$id){
                $q->where('ujian_id', $id);
             })
            ->where('mahasiswa_id',auth()->user()->mahasiswa->id)->where('yakin_or_not',0)->count();
    
            $yakin = HistoryUjian::whereHas('soal', function($q) use ($request,$id){
                $q->where('ujian_id', $id);
             })
            ->where('mahasiswa_id',auth()->user()->mahasiswa->id)->where('yakin_or_not',1)->count();
            
            $mapel = StartUjian::where('ujian_id',$id)->where('mahasiswa_id',auth()->user()->mahasiswa->id)->first();
            return view('mahasiswa.class.exam.konfirmasi',compact('mapel','ragu','yakin'));
        } else {
            return redirect()->route('mahasiswa');
        }
        
        
    }

    public function finish(Request $request)
    {
        StartUjian::where('ujian_id',$request->ujian_id)
            ->where('mahasiswa_id',auth()->user()->mahasiswa->id)->delete();
        SoalTemp::whereHas('soal', function($q) use ($request){
            $q->where('ujian_id', $request->ujian_id);
         })
            ->where('mahasiswa_id',auth()->user()->mahasiswa->id)->delete();

        $getSkor = HistoryUjian::whereHas('soal', function($q) use ($request){
            $q->where('ujian_id', $request->ujian_id);
         })
            ->where('mahasiswa_id',auth()->user()->mahasiswa->id)
            ->where('betul_or_tidak',1)->get();
        $skorAkhir = 0;
        foreach ($getSkor as $skor) {
            $soalSkor = Soal::findOrfail($skor->soal_id);
            $skorAkhir = $skorAkhir + $soalSkor['skor'];
        }

        $nilai = new Nilai();
        $nilai->mahasiswa_id = auth()->user()->mahasiswa->id;
        $nilai->ujian_id = $request->ujian_id;
        $nilai->jumlah_jawaban_benar = jawaban_benar($request->ujian_id,auth()->user()->mahasiswa->id);
        $nilai->jumlah_jawaban_salah = jawaban_salah($request->ujian_id,auth()->user()->mahasiswa->id);
        $nilai->nilai = $skorAkhir;
        $nilai->save();
        echo json_encode(true);
    }

}
