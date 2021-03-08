<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\SubEvent;
use App\Imports\ParticipantImport;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class ParticipantController extends Controller
{
    public function index()
    {
        $subevent = SubEvent::with('event')->get();
        if(request()->ajax())
        {
            return datatables()->of(Participant::with('sub_event.event'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("participant.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.participant", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.participant.index', compact('subevent'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'instansi' => 'required',
            'email' => 'required',
            'identity' => 'required',
        ]);

        $words = explode(" ", $request->nama);
        $acronym = "";
        foreach ($words as $w) {
            $acronym .= $w[0];
        }

        $number = str_shuffle($request->identity);

        Participant::create([
            'nama' => $request->nama,
            'instansi' => $request->instansi,
            'email' => $request->email,
            'identity' => $request->identity,
            'code' => $acronym.substr($number,2).rand(),
            'sub_event_id' => $request->sub_event_id,
        ]);

        return redirect()->route('participant.index');
    }

    public function edit($id)
    {
        $subevent = SubEvent::with('event')->get();
        $participant = Participant::find($id);
        return view('admin.participant.edit', compact('participant','subevent'));        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'instansi' => 'required',
            'email' => 'required',
            'identity' => 'required',
        ]);
        $participant = Participant::find($id);
        $participant->update([
            'nama' => $request->nama,
            'instansi' => $request->instansi,
            'email' => $request->email,
            'identity' => $request->identity,
            'sub_event_id' => $request->sub_event_id,
        ]);

        return redirect()->route('participant.index');
      }
 
    public function destroy($id)
    {
        $participant = Participant::find($id);
        if (!$participant) {
            return redirect()->back();
        }
        
        $participant->delete();
        return redirect()->route('participant.index');
    }

    public function import(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_import',$nama_file);
 
		// import data
		Excel::import(new ParticipantImport, public_path('/file_import/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect()->route('participant.index');
	}
}
