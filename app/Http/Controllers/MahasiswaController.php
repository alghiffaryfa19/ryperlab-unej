<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Kelas;
use App\Models\Enrollment;
use App\Models\WaktuEnroll;
use App\Models\Materi;
use App\Models\Assigments;
use Carbon\Carbon;
use App\Models\Submissions;
use Storage;

class MahasiswaController extends Controller
{
    
    public function enroll()
    {
        $timer = WaktuEnroll::find(1);
        if(request()->ajax())
        {
            return datatables()->of(Kelas::with('matkul')->select('kelas.*'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("detail_kelas", $data->slug).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Detail</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('mahasiswa.enroll.enroll', compact('timer'));
    }

    public function hapus_enroll($id,$kelas)
    {
        $category = Enrollment::where('mahasiswa_id',$id)->where('kelas_id',$kelas)->first();
        if (!$category) {
            return redirect()->back();
        }
       
        $category->delete();
        return redirect()->route('myclass');
    }

    public function detail_kelas($slug)
    {
        $kelas = Kelas::with('asistant.user','matkul')->where('slug',$slug)->select('kelas.*')->first();
        return view('mahasiswa.enroll.detail', compact('kelas'));
    }

    public function myclass()
    {
        $mahasiswa = auth()->user()->mahasiswa->id;
        $enrollment = Enrollment::where('mahasiswa_id', $mahasiswa)->with('kelas.matkul')->get();
        return view('mahasiswa.class.index', compact('enrollment'));
    }

    public function enroll_now($slug)
    {
        $mahasiswa = auth()->user()->mahasiswa->id;
        $kelas = Kelas::where('slug',$slug)->first();
        $ada = Enrollment::where('mahasiswa_id',$mahasiswa)->where('kelas_id',$kelas->id)->exists();
        
        if ($ada) {
            return redirect()->route('detail_kelas', $kelas->slug)->with('gagal','Gagal');
        } else {
            $kelas->enrollment()->create([
                'mahasiswa_id' => $mahasiswa,
            ]);

            return redirect()->route('myclass');
        }
    }

    public function materi($slug,$id)
    {
        $enroll = Enrollment::with('kelas.materi','kelas.matkul')->find($id);
        return view('mahasiswa.class.materi', compact('enroll'));
    }

    public function detail_materi($slug,$id,$materi)
    {
        $materi = Materi::with('kelas.asistant')->where('slug',$materi)->first();
        return view('mahasiswa.class.detail_materi', compact('materi'));
    }

    public function tugas($slug)
    {
        $kelas = Kelas::where('slug',$slug)->first();
        $tugas = Assigments::where('kelas_id',$kelas->id);
        if(request()->ajax())
        {
            return datatables()->of($tugas)
            ->editColumn('waktu', function ($data) {
                if (Carbon::now()->isBefore($data->deadline)) {
                    $mystring = Carbon::parse($data->deadline)->format('d M Y H:m');
                } else {
                    $mystring = 'Waktu Habis';
                }

                return $mystring;
            })
            ->editColumn('status', function ($data) {
                if (cekTugas($data->id,auth()->user()->mahasiswa->id)) {
                    $mystring = 'Sudah Mengumpulkan';
                } else {
                    $mystring = 'Belum Mengumpulkan';
                }
                
                // $mystring = '<a href="s" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Submit</a>';
                return $mystring;
            })

            ->editColumn('edit', function ($data) use ($kelas) {
                if (Carbon::now()->isBefore($data->deadline)) {
                    if (cekTugas($data->id,auth()->user()->mahasiswa->id)) {
                        $mystring = '<a href="'.route("upload_tugas", [$kelas->slug,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Unggah Ulang</a>';
                    } else {
                        $mystring = '<a href="'.route("upload_tugas", [$kelas->slug,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Submit</a>';
                    }
                } else {
                    $mystring = '<a href="#" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Waktu Habis</a>';
                }
                
                // $mystring = '<a href="s" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Submit</a>';
                return $mystring;
            })

            ->rawColumns(['status','waktu','edit'])
            ->make(true);
        }
        
        return view('mahasiswa.class.tugas', compact('tugas','kelas'));
        
    }

    public function upload_tugas($kelas,$id)
    {
        $class = Kelas::where('slug',$kelas)->first();
        $tugas = Assigments::find($id);
        if (cekTugas($tugas->id,auth()->user()->mahasiswa->id)) {
            $submisi = Submissions::where('assigments_id',$tugas->id)->where('mahasiswa_id',auth()->user()->mahasiswa->id)->first();
            return view('mahasiswa.class.upload_tugas', compact('tugas','class','submisi'));
        }

        else
        {
            return view('mahasiswa.class.upload_tugas', compact('tugas','class'));
        }
    }

    public function store(Request $request, $kelas, $id)
    {
        $class = Kelas::where('slug',$kelas)->first();
        $tugas = Assigments::find($id);
        $this->validate($request, [
            'file' => 'required',
        ]);
        $tugas->submission()->create([
            'catatan' => $request->catatan,
            'mahasiswa_id' => auth()->user()->mahasiswa->id,
            'file' => $request->file('file')->store('tugas'), 
        ]);
        return redirect()->route('tugas', $class->slug);
    }

    public function unggah_ulang(Request $request, $kelas, $id)
    {
        $class = Kelas::where('slug',$kelas)->first();
        $tugas = Submissions::where('assigments_id',$id)->where('mahasiswa_id',auth()->user()->mahasiswa->id)->first();

        if (empty($request->file('file'))) {
            $tugas->update([
                'catatan' => $request->catatan,
            ]);
        } else {
            Storage::delete($tugas->file);
            $tugas->update([
                'catatan' => $request->catatan,
                'file' => $request->file('file')->store('tugas'),
            ]);
        }
        return redirect()->route('tugas', $class->slug);
    }
}
