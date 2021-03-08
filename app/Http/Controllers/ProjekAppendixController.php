<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignmentProject;
use App\Models\ProjectGallery;
use App\Models\Kelas;
use App\Models\Project;
use App\Models\ProjectMember;
use Storage;

class ProjekAppendixController extends Controller
{
    public function galeri_project($slug,$id,$a)
    {
        $kelas = Kelas::where('slug',$slug)->first();
        $project = Project::find($id);
        $assignment = AssignmentProject::find($a);
        if(request()->ajax())
        {
            return datatables()->of(ProjectGallery::where('assigment_project_id',$assignment->id))
            ->editColumn('edit', function ($data) use ($slug,$id,$a) {
                $mystring = '<a href="'.route("galeri_edit", [$slug,$id,$a,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("galeri_delete", [$slug,$id,$a,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        
        return view('mahasiswa.class.project.gallery.index', compact('assignment','kelas','project'));
        
    }

    public function galeri_store(Request $request, $slug,$id,$a)
    {
        $assignment = AssignmentProject::find($a);
        $assignment->galeri()->create([
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'photo' => $request->file('photo')->store('photo_project'), 
        ]);

        return redirect()->route('galeri_project', [$slug,$id,$a]);
    }

    public function galeri_edit($slug,$id,$a,$g)
    {
        $gallery = ProjectGallery::find($g);
        return view('mahasiswa.class.project.gallery.edit', compact('gallery','slug','id','a'));
    }

    public function galeri_update(Request $request, $slug,$id,$a,$g)
    {
        $gallery = ProjectGallery::find($g);
        if (empty($request->file('photo'))) {
            $gallery->update([
                'title' => $request->title,
                'deskripsi' => $request->deskripsi,
            ]);
        } else {
            Storage::delete($gallery->photo);
            $gallery->update([
                'title' => $request->title,
                'deskripsi' => $request->deskripsi,
                'photo' => $request->file('photo')->store('photo_project'), 
            ]);
        }

        return redirect()->route('galeri_project', [$slug,$id,$a]);

    }
    public function galeri_delete($slug,$id,$a,$g)
    {
        $gallery = ProjectGallery::find($g);
        if (!$gallery) {
            return redirect()->back();
        }
        Storage::delete($gallery->photo);
        $gallery->delete();
        return redirect()->route('galeri_project', [$slug,$id,$a]);
    }

    public function member_project($slug,$id,$a)
    {
        $kelas = Kelas::where('slug',$slug)->first();
        $project = Project::find($id);
        $assignment = AssignmentProject::find($a);
        if(request()->ajax())
        {
            return datatables()->of(ProjectMember::where('assigment_project_id',$assignment->id))
            ->editColumn('edit', function ($data) use ($slug,$id,$a) {
                $mystring = '<a href="'.route("member_edit", [$slug,$id,$a,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("member_delete", [$slug,$id,$a,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        
        return view('mahasiswa.class.project.member.index', compact('assignment','kelas','project'));
        
    }

    public function member_store(Request $request, $slug,$id,$a)
    {
        $assignment = AssignmentProject::find($a);
        $assignment->member()->create([
            'nim' => $request->nim,
            'name' => $request->name,
            'role' => $request->role,
        ]);

        return redirect()->route('member_project', [$slug,$id,$a]);
    }

    public function member_edit($slug,$id,$a,$g)
    {
        $member = ProjectMember::find($g);
        return view('mahasiswa.class.project.member.edit', compact('member','slug','id','a'));
    }

    public function member_update(Request $request, $slug,$id,$a,$g)
    {
        $member = ProjectMember::find($g);
        $member->update([
            'nim' => $request->nim,
            'name' => $request->name,
            'role' => $request->role,
        ]);

        return redirect()->route('member_project', [$slug,$id,$a]);

    }
    public function member_delete($slug,$id,$a,$g)
    {
        $member = ProjectMember::find($g);
        if (!$member) {
            return redirect()->back();
        }
        
        $member->delete();
        return redirect()->route('member_project', [$slug,$id,$a]);
    }
}
