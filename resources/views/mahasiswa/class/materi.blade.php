@extends('layouts.mahasiswa')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Materi Kelas {{$enroll->kelas->name}}
</span>   
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font overflow-hidden">
                    <div class="container px-5 py-10 mx-auto">
                      <div class="-my-8 divide-y-2 divide-gray-100">
                        @forelse ($enroll->kelas->materi as $item)
                        @php
                            $body = Str::limit(str_replace("&nbsp;", ' ', strip_tags($item->deskripsi)), 200, ' ....');
                        @endphp
                        <div class="py-8 flex flex-wrap md:flex-nowrap">
                            <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                              <span class="font-semibold title-font text-gray-700">{{$enroll->kelas->name}}</span>
                              <span class="mt-1 text-gray-500 text-sm">{{$enroll->kelas->matkul->name}}</span>
                            </div>
                            <div class="md:flex-grow">
                              <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{$item->title}}</h2>
                              <p class="leading-relaxed">{{$body}}</p>
                              <a href="{{route('detail_materi', [$item->kelas->slug,$item->id,$item->slug])}}" class="text-blue-900 inline-flex items-center mt-4">Learn More
                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M5 12h14"></path>
                                  <path d="M12 5l7 7-7 7"></path>
                                </svg>
                              </a>
                            </div>
                          </div>
                        @empty
                        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-blue-900">Belum Ada Materi</h1>
                        @endforelse
                      </div>
                    </div>
                  </section>
            </div>
        </div>
    </div>
</div>
@endsection