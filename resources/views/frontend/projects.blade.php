@extends('layouts.frontend')
@section('description','Projects')
@section('title','Projects')
@section('content')
<div class="flex flex-col sm:flex-row w-full">
    <div class="relative sm:w-1/3">
      <span class="text-6xl font-black text-gray-200 absolute top-0 left-0">Project</span>
      <div class="mt-8 ml-6 relative z-10 flex flex-col">
          <h4 class="font-bold text-blue-500 uppercase font-xs leading-none">Project Mahasiswa Tahun @php
            echo date("Y");
        @endphp</h4>
      </div>
    </div>
    
    </div>
  <section class="text-gray-600 body-font">
    <div class="flex flex-col m-5">
      <label for="name"
          class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
          Kelas
      </label>

      <div class="relative">
        <form action="{{route('searching')}}" method="GET">
          <select name="kelas_id" id="search" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none pr-2 pl-6">
              <option value=""></option>
            @foreach ($kelas as $item)
                <option value="{{$item->id}}">{{$item->name}} ({{$item->matkul->name}})</option>
            @endforeach
          </select>
          <button type="submit" class="mt-2 mx-auto bg-blue-900 hover:bg-blue-600 text-white rounded py-2 px-8 shadow-lg">
            Filter
        </button>
        </form>
      </div>
  </div>
    <div class="container px-5 mx-auto">
      <div id="konten" class="flex flex-wrap -m-4">
          @foreach ($project as $item)
                <div class="p-4 md:w-1/3">
                <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                    <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                    @if (cekFoto($item->id) == 0)
                    src="{{asset('ryperlab/img/logo.png')}}"    
                    @else
                    src="{{ asset('uploads/'.$item->galeri[0]->photo) }}"
                    @endif
                      alt="blog">
                    <div class="p-6">
                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">{{$item->category->name}} - {{$item->projects->kelas->name}}</h2>
                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{$item->project_name}}</h1>
                    @php
                        $body = Str::limit(str_replace("&nbsp;", ' ', strip_tags($item->description)), 50, ' ....');
                    @endphp
                    <p class="leading-relaxed mb-3">{{$body}}</p>
                    <div class="flex items-center flex-wrap ">
                        <a href="{{route('detail_projectss', $item->slug)}}" class="text-blue-900 inline-flex items-center md:mb-2 lg:mb-0">Find out
                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5l7 7-7 7"></path>
                        </svg>
                        </a>
                    </div>
                    </div>
                </div>
                </div>
            @endforeach
      </div>
      {{ $project->links() }}
    </div>
  </section>
@endsection