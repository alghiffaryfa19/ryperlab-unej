<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tag;
use Storage;

class TagController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Tag::query())
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("tag.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.tag", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.blog.tag.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('tag.index');
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.blog.tag.edit', compact('tag'));        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $tag = Tag::find($id);
        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('tag.index');
      }
 
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return redirect()->back();
        }
       
        $tag->delete();
        return redirect()->route('tag.index');
    }
}
