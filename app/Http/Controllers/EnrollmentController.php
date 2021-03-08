<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Mahasiswa;
use App\Models\Kelas;

class EnrollmentController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('user')->get();
        $kelas = Kelas::with('asistant.matkul')->get();
        if(request()->ajax())
        {
            return datatables()->of(Enrollment::with('mahasiswa.user','kelas.asistant.matkul')->select('enrollments.*'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("enrollment.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.enrollment", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.enrollment.index', compact('mahasiswa','kelas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'mahasiswa_id' => 'required',
            'kelas_id' => 'required',
        ]);

        Enrollment::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('enrollment.index');
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
}
