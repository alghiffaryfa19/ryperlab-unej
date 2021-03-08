@extends('layouts.asisten')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Kelas
</span>   
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-10 mx-auto">
                      <div class="flex flex-wrap -m-4">
                          @forelse ($kelas as $item)
                          <div class="p-4 md:w-1/3">
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                              <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('uploads/'.$item->matkul->thumbnail) }}" alt="blog">
                              <div class="p-3">
                                <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">{{$item->matkul->name}}</h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{$item->name}}</h1>
                                <div>
                                    <a href="{{route('materi.asisten', $item->id)}}" type="button" class='bg-blue-900 text-white p-1 mr-1 rounded'>Materi</a>
                                    <a href="{{route('ujian.asisten', $item->id)}}" type="button" class='bg-blue-900 text-white p-1 mr-1 rounded'>Ujian</a>
                                    <a href="{{route('tugas.asisten', $item->id)}}" type="button" class='bg-blue-900 text-white p-1 mr-1 rounded'>Tugas</button>
                                    <a href="{{route('project.asisten', $item->id)}}" type="button" class='bg-blue-900 text-white p-1 mr-1 rounded'>Project</a>
                                    <a href="{{route('formbuilders::form.asisten', $item->id)}}" type="button" class='bg-blue-900 text-white p-1 mr-1 rounded'>Kuesioner</a>
                                    <a href="{{route('enroll.asisten', $item->id)}}" type="button" class='bg-blue-900 text-white p-1 mr-1 rounded'>Enrollment</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          @empty
                          <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Belum Ada Kelas</h1>
                          @endforelse
                        
                
                      </div>
                    </div>
                  </section>
            </div>
        </div>
    </div>
</div>
@endsection