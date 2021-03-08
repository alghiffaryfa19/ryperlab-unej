<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use jazmy\FormBuilder\Models\Form;

class KuesionerMahasiswaController extends Controller
{
    public function kuesioner($slug)
    {
        $kelas = Kelas::where('slug',$slug)->first();
       
        if(request()->ajax())
        {
            return datatables()->of(Form::where('kelas_id',$kelas->id))
            ->editColumn('edit', function ($data) {
                if (cekForm()) {
                    $mystring = '<a href="#" class="bg-green-500 text-white p-2 rounded mr-2 font-bold">Sudah Mengisi</a>';
                } else {
                    
                    $mystring = '<a href="'.route('formbuilder::form.render', $data->identifier).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Isi</a>';
                }
                
                
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        
        return view('mahasiswa.class.form.index', compact('kelas'));
        
    }
}
