<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Storage;

class CategoryController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(BlogCategory::query())
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("category.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.category", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.blog.category.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        BlogCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $category = BlogCategory::find($id);
        return view('admin.blog.category.edit', compact('category'));        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $category = BlogCategory::find($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('category.index');
      }
 
    public function destroy($id)
    {
        $category = BlogCategory::find($id);
        if (!$category) {
            return redirect()->back();
        }
       
        $category->delete();
        return redirect()->route('category.index');
    }
}
