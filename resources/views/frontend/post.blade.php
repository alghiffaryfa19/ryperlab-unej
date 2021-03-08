@extends('layouts.frontend')
@section('description','Blog')
@section('title','Blog')
@section('content')
<div class="flex flex-col sm:flex-row w-full">
    <div class="relative sm:w-1/3">
      <span class="text-6xl font-black text-gray-200 absolute top-0 left-0">Blog</span>
      <div class="mt-8 ml-6 relative z-10 flex flex-col">
          <h4 class="font-bold text-blue-500 uppercase font-xs leading-none">Article</h4>
      </div>
    </div>
    
    </div>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-10 mx-auto">
          <div class="flex flex-wrap -m-4">
            @foreach ($post as $item)
            @php
              $body = Str::limit(str_replace("&nbsp;", ' ', strip_tags($item->body)), 50, ' ....');
            @endphp
              <div class="p-4 md:w-1/3">
                <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                  <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('uploads/'.$item->thumbnail) }}" alt="{{$item->title}}">
                  <div class="p-6">
                    <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">{{$item->category->name}}</h2>
                    <h1 class="title-font text-lg font-medium text-blue-900 hover:text-blue-500 mb-3">{{$item->title}}</h1>
                    <p class="leading-relaxed mb-3">{{$body}}</p>
                    <small>by {{$item->user->name}} - {{\Carbon\Carbon::parse($item->updated_at)->format('d M Y')}}</small>
                    <div class="flex items-center flex-wrap mt-5">
                      <a href="{{route('read', $item->slug)}}" class="text-blue-900 inline-flex items-center md:mb-2 lg:mb-0">Learn More
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
          <div class="flex mx-auto items-center justify-center">
              <div class="mx-auto mt-16 items-center justify-center px-5 py-3">
                {!! $post->links() !!}
              </div>
          </div>
        </div>
      </section>
@endsection