@extends('layouts.mahasiswa')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    My Class
</span>   
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-10 mx-auto">
                      <div class="flex flex-wrap -m-4">
                          @forelse ($enrollment as $item)
                          <div class="p-4 md:w-1/3">
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                              <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('uploads/'.$item->kelas->matkul->thumbnail) }}" alt="blog">
                              <div class="p-3">
                                <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">{{$item->kelas->matkul->name}}</h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{$item->kelas->name}}</h1>
                                <div>
                                    @if ($item->status == 0)
                                    <button class='bg-blue-900 text-white p-2 rounded text-l'>Menunggu Persetujuan</button>
                                    @elseif ($item->status == 1)
                                    <a href="{{route('materi_kelas',[$item->kelas->slug,$item->id])}}" type="button" class='bg-blue-900 text-white p-1 mr-1 rounded'>Materi</a>
                                    <a href="{{route('exam', $item->kelas->slug)}}" type="button" class='bg-blue-900 text-white p-1 mr-1 rounded'>Ujian</a>
                                    <a href="{{route('tugas', $item->kelas->slug)}}" type="button" class='bg-blue-900 text-white p-1 mr-1 rounded'>Tugas</button>
                                    <a href="{{route('projects', $item->kelas->slug)}}" type="button" class='bg-blue-900 text-white p-1 mr-1 rounded'>Project</a>
                                    <a href="{{route('kuesioner', $item->kelas->slug)}}" type="button" class='bg-blue-900 text-white p-1 mr-1 rounded'>Kuesioner</a>
                                    @else
                                    <button class='bg-yellow-500 text-white p-1 rounded'>Maaf Enroll Ditolak</button>
                                    <a href="{{route('hapus_enroll',[auth()->user()->mahasiswa->id,$item->kelas->id])}}" type="button" class='bg-red-500 text-white p-1 mr-1 rounded'>Hapus</a>
                                    @endif
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