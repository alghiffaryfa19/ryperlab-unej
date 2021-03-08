@extends('layouts.frontend')
@section('description','Blog')
@section('title','Blog')
@section('content')
<div class="flex flex-col sm:flex-row w-full">
    <div class="relative sm:w-1/3">
      <span class="text-6xl font-black text-gray-200 absolute top-0 left-0">Gallery</span>
      <div class="mt-8 ml-6 relative z-10 flex flex-col">
          <h4 class="font-bold text-blue-500 uppercase font-xs leading-none">Gallery</h4>
      </div>
    </div>
    
    </div>

    <section id="captions" class="my-5 grid grid-cols-1 md:grid-cols-4 gap-4 p-5">
        
            @foreach ($galeri as $item)
                <a data-sub-html="<h4>{{$item->title}}</h4><p>{{$item->deskripsi}}</p>" href="{{ asset('uploads/'.$item->photo) }}" class="hover:opacity-75 " target="_new"><img class="w-full h-64 object-cover" src="{{ asset('uploads/'.$item->photo) }}" alt="{{$item->title}}" /></a>
            @endforeach
        
    </section>

    <div class="flex mx-auto items-center justify-center">
        <div class="mx-auto mt-16 items-center justify-center px-5 py-3">
          {!! $galeri->links() !!}
        </div>
    </div>
@endsection
@section('script')
  <script src='https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js'></script>
<script src='https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js'></script>
<script src='https://cdn.rawgit.com/sachinchoolur/lg-autoplay.js/master/dist/lg-autoplay.js'></script>
<script src='https://cdn.rawgit.com/sachinchoolur/lg-share.js/master/dist/lg-share.js'></script>
<script src='https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js'></script>
<script src='https://cdn.rawgit.com/sachinchoolur/lg-zoom.js/master/dist/lg-zoom.js'></script>
<script src='https://cdn.rawgit.com/sachinchoolur/lg-hash.js/master/dist/lg-hash.js'></script>
<script src='https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js'></script>
<script>
    lightGallery(document.getElementById('captions')); 
</script>
@endsection