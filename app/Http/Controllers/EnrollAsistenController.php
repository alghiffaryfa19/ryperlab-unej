<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Enrollment;
use App\Models\Kelas;
use Storage;

class EnrollAsistenController extends Controller
{
    public function index($id)
    {
        $kelas = Kelas::find($id);
        if(request()->ajax())
        {
            return datatables()->of(Enrollment::with('mahasiswa.user')->where('kelas_id',$kelas->id)->orderby('status','ASC')->select('enrollments.*'))
            ->editColumn('edit', function ($data) use ($kelas) {
                $mystring = '<a href="'.route("enroll.asisten.edit", [$kelas->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("enroll.asisten.delete", [$kelas->id,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->editColumn('stat', function ($data) use ($kelas) {
                if ($data->status == 0) {
                    $mystring = "Menunggu Persetujuan";
                } else if ($data->status == 1) {
                    $mystring = "Disetujui";
                } else if ($data->status == 2) {
                    $mystring = "Ditolak";
                }
                
                return $mystring;
            })
            ->rawColumns(['edit','stat'])
            ->make(true);
        }
        return view('asisten.dashboard.enroll.index', compact('kelas'));
    }

    public function edit($id,$materi)
    {
        $kelas = Kelas::find($id);
        $enroll = Enrollment::find($materi);
        return view('asisten.dashboard.enroll.edit', compact('kelas','enroll'));
    }

    public function update(Request $request, $id, $enroll)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        $kelas = Kelas::find($id);
        $enroll = Enrollment::find($enroll);
        $enroll->update([
            'status' => $request->status,
        ]);

        return redirect()->route('enroll.asisten',$kelas->id);
      }

      public function destroy($id,$enroll)
        {
            $kelas = Kelas::find($id);
            $enroll = Enrollment::find($enroll);
            if (!$enroll) {
                return redirect()->back();
            }
           
            
            $enroll->delete();
            return redirect()->route('enroll.asisten',$kelas->id);
        }
}
