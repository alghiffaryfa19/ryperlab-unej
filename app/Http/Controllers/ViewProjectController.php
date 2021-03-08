<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignmentProject;
use App\Models\Gallery;
use App\Models\Kelas;

class ViewProjectController extends Controller
{
    public function projects()
    {
        $kelas = Kelas::latest()->get();
        $project = AssignmentProject::
        with(['projects.kelas:id,name','mahasiswa.user:id,name,username','category:id,name','galeri'=>function ($q) {
            $q->select('id','assigment_project_id','photo')->first();
        }])->whereYear('created_at',date("Y"))
        ->select('id','category_id','mahasiswa_id','project_name',
        'mahasiswa_id','project_name','description','team_name','slug','project_logo','project_id')->paginate(6);
        return view('frontend.projects', compact('project','kelas'));
    }

    public function search(Request $request)
    {
        $kelas = Kelas::latest()->get();
        $project=AssignmentProject::
            with(['projects.kelas:id,name','mahasiswa.user:id,name,username','category:id,name','galeri'=>function ($q) {
                $q->select('id','assigment_project_id','photo')->first();
            }])->whereYear('created_at',date("Y"))
            ->whereHas('projects', function($q) use ($request){
                $q->where('kelas_id', $request->kelas_id);
             })
            ->select('id','category_id','mahasiswa_id','project_name',
            'mahasiswa_id','project_name','description','team_name','slug','project_logo','project_id')->paginate(6);

        return view('frontend.projects', compact('project','kelas'));
    }


    public function detail_projects($project)
    {
        $detail = AssignmentProject::where('slug',$project)->with('projects.kelas:id,name','mahasiswa.user:id,name,username','category:id,name','galeri','member')
        ->first();
        return view('frontend.detail_projects', compact('detail'));
    }

    public function gallery()
    {
        $galeri = Gallery::latest()->paginate(10);
        return view('frontend.galeri', compact('galeri'));
    }
}
