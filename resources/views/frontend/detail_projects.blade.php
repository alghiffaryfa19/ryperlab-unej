@extends('layouts.frontend')
@section('description',$detail->project_name)
@section('title',$detail->project_name)
@section('content')
<div class="flex items-center lg:w-3/5 mx-auto border-b pb-10 mt-10 border-gray-200 sm:flex-row flex-col">
    <div class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-10 inline-flex items-center justify-center rounded-full bg-indigo-100 text-blue-900 flex-shrink-0">
        <img alt="{{$detail->project_name}}" class="object-cover object-center w-full h-full rounded-full block" src="{{ asset('uploads/'.$detail->project_logo) }}">
    </div>
    <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
      <h2 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-blue-500 sm:text-4xl">/{{$detail->slug}}</h2>
      <p class="leading-relaxed text-base">{{$detail->description}}</p>
      <br>
      @if (!empty($detail->project_link))
      <a class="text-blue-500 text-l" href="{{$detail->project_link}}">Visit</a>
      @endif
      <br>
      <br>
      <p class="leading-relaxed text-base">Super Team: </p>
        <div>
            <ol>
                <li>
                    {{$detail->mahasiswa->user->name}} ({{$detail->mahasiswa->user->username}}) - Leader
                </li>
                @foreach ($detail->member as $item)
                    <li>
                        {{$item->name}} ({{$item->nim}}) - {{$item->role}}
                    </li>
                @endforeach
            </ol>
            
        </div>
    </div>
  </div>

  <section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-wrap -m-4">
        @foreach ($detail->galeri as $item)
            <div class="p-4 md:w-1/3">
            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                <a target="_blank" href="{{ asset('uploads/'.$item->photo) }}">
                    <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('uploads/'.$item->photo) }}" alt="blog">
                </a>
                <div class="p-6">
                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{$item->title}}</h1>
                <p class="leading-relaxed mb-3">{{$item->deskripsi}}</p>
                </div>
            </div>
            </div>
        @endforeach
      </div>
    </div>
  </section>                                    
@endsection