<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assigments;
use Illuminate\Support\Str;
use App\Models\Kelas;
use App\Models\Enrollment;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $kelas = Kelas::with('asistant.matkul')->get();
        if(request()->ajax())
        {
            return datatables()->of(Assigments::with('kelas.asistant.matkul')->select('assigments.*'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("submisi", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Submisi</a><a href="'.route("assignment.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.assignment", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->editColumn('time', function ($data) use ($now) {
                if ($now->isBefore($data->deadline)) {
                    $mystring = 'Ongoing';
                } else {
                    $mystring = 'Closed';
                }
                return $mystring;
            })
            ->rawColumns(['edit','time'])
            ->make(true);
        }
        return view('admin.assignment.index', compact('kelas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'deskripsi' => 'required',
            'deadline' => 'required',
        ]);

        Assigments::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('assignment.index');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::with('user')->get();
        $kelas = Kelas::with('asistant.matkul')->get();
        $enrollment = Enrollment::find($id);
        return view('admin.enrollment.edit', compact('mahasiswa','kelas','enrollment'));        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'mahasiswa_id' => 'required',
            'kelas_id' => 'required',
        ]);


        $enrollment = Enrollment::find($id);
        $enrollment->update([
            'mahasiswa_id' => $request->mahasiswa_id,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('enrollment.index');
      }
 
    public function destroy($id)
    {
        $enrollment = Enrollment::find($id);
        if (!$enrollment) {
            return redirect()->back();
        }
        
        $enrollment->delete();
        return redirect()->route('enrollment.index');
    }

    public function submisi($id)
    {
        $assignment = Assigments::find($id);
        if(request()->ajax())
        {
            return datatables()->of(Enrollment::with('mahasiswa.user')->where('kelas_id',$assignment->kelas_id)->select('enrollments.*'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->editColumn('status', function ($data) use ($assignment) {
                if (cekTugas($assignment->id,$data->mahasiswa_id)) {
                    $mystring = '<a class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Buka</a>';
                } else {
                    $mystring = 'Belum Unggah';
                }
                return $mystring;
            })
            ->rawColumns(['edit','status'])
            ->make(true);
        }
        return view('admin.assignment.submisi', compact('assignment'));
    }
}
