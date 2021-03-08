<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\BlogCategory;
use App\Models\Tag;
use Storage;

class PostController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Post::with('category')->select('posts.*'))
            ->editColumn('edit', function ($data) {
                $mystring = '<a href="'.route("post.edit", $data->id).'" class="bg-indigo-500 text-white p-2 rounded mr-2 font-bold">Edit</a><a href="'.route("hapus.post", $data->id).'" onclick="return confirm(`Apakah anda ingin menghapus ?`)" class="bg-red-500 text-white p-2 rounded mr-2 font-bold">Hapus</a>';
                return $mystring;
            })
            ->rawColumns(['edit'])
            ->make(true);
        }
        return view('admin.blog.post.index');
    }

    public function create()
    {
        $category = BlogCategory::all();
        $tag = Tag::all();
        return view('admin.blog.post.create', compact('category','tag'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'thumbnail' => 'required',
        ]);

        $post = Post::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'body' => $request->body,
                'thumbnail' => $request->file('thumbnail')->store('post'), 
                'category_id' => $request->category_id,
                'user_id' => auth()->user()->id,
        ]);

        $post->tag()->attach($request->values);

        return redirect()->route('post.index');
    }

    public function edit($id)
    {
        $category = BlogCategory::all();
        $tags = Tag::all();
        $post = Post::find($id);
        return view('admin.blog.post.edit', compact('post','category','tags'));        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
        $post = Post::find($id);
        if (empty($request->file('thumbnail'))) {
            $post->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'body' => $request->body,
                'category_id' => $request->category_id,
            ]);
        } else {
            Storage::delete($post->thumbnail);
            $post->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'body' => $request->body,
                'thumbnail' => $request->file('thumbnail')->store('post'), 
                'category_id' => $request->category_id,
            ]);
        }

        $post->tag()->sync($request->values);

        return redirect()->route('post.index');
      }
 
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back();
        }
        Storage::delete($post->thumbnail);
        $post->delete();
        return redirect()->route('post.index');
    }
}
