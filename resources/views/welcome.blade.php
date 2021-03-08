@extends('layouts.frontend')
@section('description','Bring Technology to You')
@section('title','Home')
@section('content')
<div class="container mx-auto px-8 bg-blue-50">
  <main class="flex flex-col-reverse sm:flex-row jusitfy-between items-center py-12">
      <div class="sm:w-2/5 flex flex-col items-center sm:items-start text-center sm:text-left">
          <h1 class="uppercase text-6xl text-blue-900 font-bold leading-none tracking-wide mb-2">RyperLab</h1>
          <h6 class="uppercase text-2xl text-orange-500 text-secondary tracking-widest mb-6">Faculty of Computer Science, University of Jember</h6>
          <a href="{{route('ryperlabs')}}" class="flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-900 hover:bg-blue-600">Here We Go!</a>
      </div>
      @include('layouts.landing')
  </main>
</div>
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="py-12 bg-white">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="container mx-auto px-6 pt-8 sm:pt-16 pb-20">
        <div class="sm:px-12 flex flex-col sm:flex-row">
            <div class="sm:w-1/2 sm:pr-16">
                <img src="{{asset('assets/img/christopher-gower-m_HRfLhgABo-unsplash.jpg')}}" class="rounded-lg">
            </div>
            <div class="sm:w-1/2 pt-4">
                <h3 class="text-2xl text-gray-800 mb-4">
                    Closer to Us
                </h3>
                <p class="text-gray-600 leading-relaxed text-lg mb-4">
                    Laboratorium Rekayasa Perangkat Lunak, Fakultas Ilmu Komputer, Universitas Jember
                </p>
                <a href="{{route('ryperlabs')}}" type="button" class="mx-auto bg-blue-900 hover:bg-blue-600 text-white rounded py-2 px-8 shadow-lg">
                    Find Out Here!
                </a>
            </div>
        </div>
    </div>
</div>
</div>
<div class="flex flex-col sm:flex-row w-full">
<div class="relative sm:w-1/3">
  <span class="text-6xl font-black text-gray-200 absolute top-0 left-0">Blog</span>
  <div class="mt-8 ml-6 relative z-10 flex flex-col">
      <h4 class="font-bold text-blue-500 uppercase font-xs leading-none">Latest Article</h4>
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
        <a type="button" href="{{route('blog')}}" class="mx-auto mt-16 items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-900 hover:bg-blue-600">Read More</a>
      </div>
    </div>
  </section>
<div class="bg-blue-50">
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
<h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
  <span class="block">Ready to dive in?</span>
  <span class="block text-blue-900">Keep In Touch With Us</span>
</h2>
<div class="mt-8 lex lg:mt-0 lg:flex-shrink-0">
  <div class="inline-flex rounded-md shadow">
    <a href="{{route('register')}}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-900 hover:bg-blue-600">
      Get started
    </a>
  </div>
</div>
</div>
</div>
@endsection