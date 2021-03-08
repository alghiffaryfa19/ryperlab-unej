@extends('layouts.frontend')
@section('description',$post->title)
@section('title',$post->title)
@section('content')
<div class="mt-10">
  <div class="mb-4 md:mb-0 w-full max-w-screen-md mx-auto relative" style="height: 24em;">
    <div class="absolute left-0 bottom-0 w-full h-full z-10"
      style="background-image: linear-gradient(180deg,transparent,rgba(0,0,0,.7));"></div>
    <img src="{{ asset('uploads/'.$post->thumbnail) }}" class="absolute left-0 top-0 w-full h-full z-0 object-cover" />
    <div class="p-4 absolute bottom-0 left-0 z-20">
      <a href="#"
        class="px-4 py-1 bg-blue-900 text-white inline-flex items-center justify-center mb-2">{{$post->category->name}}</a>
      <h3 class="text-3xl font-semibold text-gray-100 leading-tight">
        {{$post->title}}
      </h3>
      <div class="flex mt-3">
        <div>
          <p class="font-semibold text-white text-sm"> {{$post->user->name}} </p>
          <p class="font-semibold text-white text-xs"> {{\Carbon\Carbon::parse($post->updated_at)->format('d M Y')}} </p>
        </div>
      </div>
    </div>
  </div>

  <div class="px-4 lg:px-0 mt-12 text-gray-700 max-w-screen-md mx-auto text-lg leading-relaxed">
    <p class="pb-6">{!!$post->body!!}</p>
    <div class="mt-10 mb-10">
      Tags
      <br>
      @foreach ($post->tag as $item)
      <a href="#"
        class="px-4 py-1 text-sm bg-blue-900 text-white inline-flex items-center justify-center">{{$item->name}}</a>
      @endforeach
    </div>
  </div>
  
</div>
@endsection