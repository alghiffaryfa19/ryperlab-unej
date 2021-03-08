<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignmentProject;
use Illuminate\Support\Str;
use App\Models\Kelas;
use App\Models\Project;
use Storage;


class HasilProjectController extends Controller
{
    public function index($id,$project)
    {
        $pro = Project::with('kelas')->find($project);
        if(request()->ajax())
        {
            return datatables()->of(AssignmentProject::with('mahasiswa.user','category')->where('project_id',$pro->id)->select('assignment_projects.*'))
            ->editColumn('edit', function ($data) use ($pro) {
                $mystring = '<a href="'.route("hasil.project.asisten.edit", [$pro->kelas->id,$pro->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Detail</a><a href="'.route("hasil.project.asisten.delete", [$pro->kelas->id,$pro->id,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })


            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('asisten.dashboard.project.hasil.index', compact('pro'));
    }

    public function edit($id,$tugas,$pro)
    {
        $submission = AssignmentProject::with('mahasiswa.user','category','galeri','member')->find($pro);
        return view('asisten.dashboard.project.hasil.edit', compact('submission'));
    }

    public function destroy($id,$tugas,$pro)
        {
            $submission = AssignmentProject::with('projects.kelas')->find($pro);
            if (!$submission) {
                return redirect()->back();
            }
            Storage::delete($submission->project_document);
            Storage::delete($submission->project_logo);
            $submission->delete();
            return redirect()->route('hasil.project.asisten', [$submission->projects->kelas->id, $submission->projects->id]);
        }
}
