@extends('layouts.mahasiswa')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Detail Kelas {{$kelas->name}}
</span>   
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if(session('gagal'))
                    <div class="mt-8 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">Maaf</strong> Kelas yang sudah dipilih tidak bisa dipilih lagi
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
                        </button>
                    </div>
                @endif
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-24 mx-auto">
                      <div class="flex flex-col text-center w-full mb-20">
                        <h2 class="text-xs text-indigo-500 tracking-widest font-medium title-font mb-1">Kelas</h2>
                        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">{{$kelas->name}}</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{{$kelas->matkul->deskripsi}}</p>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Mata Kuliah : {{$kelas->matkul->name}}, Asisten Pengampu : @foreach ($kelas->asistant as $item) {{$item->user->name}}, @endforeach</p>
                        <br>
                        <span class="text-center text-blue-900">Enroll Kelas Untuk :</span>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{{auth()->user()->name}} - {{auth()->user()->username}} - {{auth()->user()->email}}</p>
                      </div>
                      <form action="{{route('enroll_now', $kelas->slug)}}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm(`Yakin memilih kelas ini ?`)" class="flex mx-auto mt-16 text-white bg-blue-900 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">Enroll Now</button>
                      </form>
                    </div>
                  </section>
            </div>
        </div>
    </div>
</div>
@endsection