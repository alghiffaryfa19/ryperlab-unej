@extends('layouts.asisten')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Ujian {{$ujian->nama}}
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <form enctype="multipart/form-data" action="{{route('ujian.asisten.update', [$kelas->id,$ujian->id])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Judul
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="name"
                                        name="nama"
                                        type="text"
                                        placeholder="Judul"
                                        value="{{$ujian->nama}}"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Tanggal
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="name"
                                        name="date_ujian"
                                        type="date"
                                        placeholder="Judul"
                                        value="{{$ujian->date_ujian}}"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Jam Mulai (00:00:00)
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="name"
                                        name="time_start"
                                        type="text"
                                        value="{{$ujian->time_start}}"
                                        placeholder="Jam Mulai"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Jam Tutup (00:00:00)
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="name"
                                        name="jam_tutup"
                                        type="text"
                                        value="{{$ujian->jam_tutup}}"
                                        placeholder="Jam Tutup"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Durasi (1 untuk 1 jam)
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="name"
                                        name="lama_ujian"
                                        type="number"
                                        placeholder="Durasi"
                                        value="{{$ujian->lama_ujian/3600}}"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                        
                                </div>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="flex justify-center pt-2">
                        <button type="submit"
                            class="focus:outline-none px-4 bg-indigo-500 p-3 ml-3 rounded-lg text-white hover:bg-indigo-400">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection