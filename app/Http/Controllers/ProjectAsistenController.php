<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Kelas;
use Storage;

class ProjectAsistenController extends Controller
{
    public function index($id)
    {
        $kelas = Kelas::find($id);
        if(request()->ajax())
        {
            return datatables()->of(Project::where('kelas_id',$kelas->id))
            ->editColumn('edit', function ($data) use ($kelas) {
                $mystring = '<a href="'.route("hasil.project.asisten", [$kelas->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Submission</a><a href="'.route("project.asisten.edit", [$kelas->id,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("project.asisten.delete", [$kelas->id,$data->id]).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('asisten.dashboard.project.index', compact('kelas'));
    }

    public function create($id)
    {
        $kelas = Kelas::find($id);
        return view('asisten.dashboard.project.create', compact('kelas'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'deskripsi' => 'required',
            'deadline' => 'required',
        ]);

        $kelas = Kelas::find($id);

        $kelas->projects()->create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('project.asisten', $kelas->id);
    }

    public function edit($id,$project)
    {
        $project = Project::with('kelas')->find($project);
        return view('asisten.dashboard.project.edit', compact('project'));
    }

    public function update(Request $request, $id, $project)
    {
        $this->validate($request, [
            'name' => 'required',
            'deskripsi' => 'required',
        ]);

        $project = Project::with('kelas')->find($project);
        $project->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('project.asisten',$project->kelas->id);
      }

      public function destroy($id,$project)
        {
            $project = Project::with('kelas')->find($project);
            if (!$project) {
                return redirect()->back();
            }
            
            $project->delete();
            return redirect()->route('project.asisten',$project->kelas->id);
        }
}
