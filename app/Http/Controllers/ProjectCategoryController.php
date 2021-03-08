<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\AppCategory;
use Storage;

class ProjectCategoryController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(AppCategory::query())
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("project-category.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.project-category", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.project.category.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        AppCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('project-category.index');
    }

    public function edit($id)
    {
        $category = AppCategory::find($id);
        return view('admin.project.category.edit', compact('category'));        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $category = AppCategory::find($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('project-category.index');
      }
 
    public function destroy($id)
    {
        $category = AppCategory::find($id);
        if (!$category) {
            return redirect()->back();
        }
       
        $category->delete();
        return redirect()->route('project-category.index');
    }
}
