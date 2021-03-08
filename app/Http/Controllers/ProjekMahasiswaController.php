<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\AppCategory;
use App\Models\AssignmentProject;
use Storage;
use Carbon\Carbon;

class ProjekMahasiswaController extends Controller
{
    public function projects($slug)
    {
        $kelas = Kelas::where('slug',$slug)->first();
        $project = Project::where('kelas_id',$kelas->id);
        if(request()->ajax())
        {
            return datatables()->of($project)
            ->editColumn('deadline', function ($data) {
                if (Carbon::now()->isBefore($data->deadline)) {
                    $mystring = Carbon::parse($data->deadline)->format('d M Y H:m');
                } else {
                    $mystring = 'Waktu Habis';
                }

                return $mystring;
            })

            ->editColumn('edit', function ($data) use ($kelas) {
                if (Carbon::now()->isBefore($data->deadline)) {
                    if (cekProject($data->id,auth()->user()->mahasiswa->id)) {
                        $mystring = '<a href="'.route("detail_projects", [$kelas->slug,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Unggah Ulang</a>';
                    } else {
                        $mystring = '<a href="'.route("detail_projects", [$kelas->slug,$data->id]).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Submit</a>';
                    }
                } else {
                    $mystring = '<a href="#" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Waktu Habis</a>';
                }
                
                // $mystring = '<a href="s" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Submit</a>';
                return $mystring;
            })

            ->rawColumns(['deadline','edit'])
            ->make(true);
        }
        
        return view('mahasiswa.class.project.index', compact('project','kelas'));
        
    }

    public function detail_projects($kelas,$id)
    {
        $class = Kelas::where('slug',$kelas)->first();
        $category = AppCategory::all();
        $project = Project::find($id);
        
        if (cekProject($project->id,auth()->user()->mahasiswa->id)) {
            $assignment = AssignmentProject::where('project_id',$project->id)->where('mahasiswa_id',auth()->user()->mahasiswa->id)->first();
            return view('mahasiswa.class.project.upload', compact('project','class','assignment','category'));
        }

        else
        {
            return view('mahasiswa.class.project.upload', compact('project','class','category'));
        }
    }

    public function store(Request $request, $kelas, $id)
    {
        $class = Kelas::where('slug',$kelas)->first();
        $project = Project::find($id);
        $this->validate($request, [
            'category_id' => 'required',
            'project_name' => 'required',
            'team_name' => 'required',
            'description' => 'required',
            'project_link' => 'required',
            'project_document' => 'required',
            'project_logo' => 'required',
        ]);
        $project->assignments()->create([
            'category_id' => $request->category_id,
            'mahasiswa_id' => auth()->user()->mahasiswa->id,
            'project_name' => $request->project_name,
            'team_name' => $request->team_name,
            'slug' => Str::slug($request->project_name),
            'description' => $request->description,
            'project_link' => $request->project_link,
            'project_document' => $request->file('project_document')->store('project_document'), 
            'project_logo' => $request->file('project_logo')->store('project_logo'), 
        ]);
        return redirect()->route('projects', $class->slug);
    }

    public function unggah_ulang(Request $request, $kelas, $id)
    {
        $class = Kelas::where('slug',$kelas)->first();
        $tugas = AssignmentProject::where('project_id',$id)->where('mahasiswa_id',auth()->user()->mahasiswa->id)->first();

        $this->validate($request, [
            'category_id' => 'required',
            'project_name' => 'required',
            'team_name' => 'required',
            'description' => 'required',
            'project_link' => 'required',
        ]);
        if (empty($request->file('project_document'))) {
            if (empty($request->file('project_logo'))) {
                $tugas->update([
                    'category_id' => $request->category_id,
                    'project_name' => $request->project_name,
                    'team_name' => $request->team_name,
                    'description' => $request->description,
                    'slug' => Str::slug($request->project_name),
                    'project_link' => $request->project_link,
                ]);
            }

            else {
                Storage::delete($tugas->project_logo);
                $tugas->update([
                    'category_id' => $request->category_id,
                    'project_name' => $request->project_name,
                    'team_name' => $request->team_name,
                    'description' => $request->description,
                    'slug' => Str::slug($request->project_name),
                    'project_link' => $request->project_link,
                    'project_logo' => $request->file('project_logo')->store('project_logo'), 
                ]);

            }
        }

        else {
            Storage::delete($tugas->project_document);
            if (empty($request->file('project_logo'))) {
                $tugas->update([
                    'category_id' => $request->category_id,
                    'slug' => Str::slug($request->project_name),
                    'project_name' => $request->project_name,
                    'team_name' => $request->team_name,
                    'description' => $request->description,
                    'project_link' => $request->project_link,
                    'project_document' => $request->file('project_document')->store('project_document'), 
                ]);
            }

            else {
                Storage::delete($tugas->project_logo);
                $tugas->update([
                    'category_id' => $request->category_id,
                    'project_name' => $request->project_name,
                    'slug' => Str::slug($request->project_name),
                    'team_name' => $request->team_name,
                    'description' => $request->description,
                    'project_link' => $request->project_link,
                    'project_document' => $request->file('project_document')->store('project_document'), 
                    'project_logo' => $request->file('project_logo')->store('project_logo'), 
                ]);

            }
        }

        return redirect()->route('projects', $class->slug);
    }

}
