@extends('layouts.mahasiswa')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{$materi->title}}
</span>   
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-10 mx-auto">
                      <div class="text-center mb-5">
                        <h1 class="sm:text-3xl text-2xl font-medium text-center title-font text-gray-900 mb-4">{{$materi->title}}</h1>
                        <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto">{{$materi->kelas->name}}</p>
                      </div>
                      <p class="pb-6">{!!$materi->deskripsi!!}</p>
                      <div class="mt-10 mb-10">
                        File Materi
                        <br>
                        @if (empty($materi->file))
                        <a href="#"
                        class="px-4 py-1 text-sm bg-red-500 text-white inline-flex items-center justify-center">Tidak Ada File Materi</a>
                        @else
                        <a href="{{ asset('uploads/'.$materi->file) }}"
                        class="px-4 py-1 text-sm bg-blue-900 text-white inline-flex items-center justify-center">Buka File</a>
                        @endif
                      </div>
                    </div>
                  </section>
            </div>
        </div>
    </div>
</div>
@endsection