@extends('layouts.asisten')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Materi Kelas {{$kelas->name}}
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <form enctype="multipart/form-data" action="{{route('materi.asisten.update', [$kelas->id,$materi->id])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Judul
                                </label>
                        
                                <div class="relative">
                        
                                    <div class="absolute flex border border-transparent left-0 top-0 h-full w-10">
                                        <div class="flex items-center justify-center rounded-tl rounded-bl z-10 bg-gray-100 text-gray-600 text-lg h-full w-full">
                                            <svg viewBox="0 0 24 24"
                                                width="24"
                                                height="24"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                fill="none"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="h-5 w-5">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12"
                                                        cy="7"
                                                        r="4"></circle>
                                            </svg>
                                        </div>
                                    </div>
                        
                                    <input id="name"
                                        name="title"
                                        type="text"
                                        placeholder="Judul"
                                        value="{{$materi->title}}"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Deskripsi
                                </label>
                        
                                <div class="relative">
                        
                                    
                        
                                    <textarea class="summernote text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12"
                                    name="deskripsi">{!!$materi->deskripsi!!}</textarea>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    File Tambahan (Jika Ada)
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="name"
                                    name="file"
                                    type="file"
                                    placeholder="File"
                                    class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                    <div class="absolute flex border border-transparent right-0 top-0 h-full w-10">
                                        <div class="flex items-center justify-center rounded-tl rounded-bl z-10 bg-gray-100 text-gray-600 text-lg h-full w-full">
                                            @if (empty($materi->file))
                                            <a
                                                class="focus:outline-none px-4 bg-indigo-500 p-3 ml-3 rounded-lg text-white hover:bg-indigo-400">Belum ada</a>
                                            @else
                                            <a href="{{ asset('uploads/'.$materi->file) }}"
                                                class="focus:outline-none px-4 bg-indigo-500 p-3 ml-3 rounded-lg text-white hover:bg-indigo-400">File</a>
                                            @endif
                                        </div>
                                    </div>
                        
                                </div>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="flex justify-center pt-2">
                        <button type="submit"
                            class="focus:outline-none px-4 bg-indigo-500 p-3 ml-3 rounded-lg text-white hover:bg-indigo-400">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection