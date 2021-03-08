@extends('layouts.mahasiswa')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{$tugas->title}} 
</span>   
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font relative">
                    <div class="container px-5 py-24 mx-auto">
                      <div class="flex flex-col text-center w-full mb-12">
                        <h1 class="sm:text-3xl text-2xl font-bold title-font mb-4 text-gray-900">{{$tugas->title}}</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{!!$tugas->deskripsi!!}</p>
                        <p class="text-center" id="demo"></p>
                      </div>
                      @if (\Carbon\Carbon::now()->isBefore($tugas->deadline))
                        @if (cekTugas($tugas->id,auth()->user()->mahasiswa->id))
                        <form action="{{route('unggah_ulang', [$class->slug,$tugas->id])}}" enctype="multipart/form-data" method="post">
                            @method('PUT')
                            @csrf
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <div class="flex flex-wrap -m-2">
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="message" class="leading-7 text-sm text-gray-600">Tugas yang telah diunggah</label>
                                        <br>
                                        <a href="{{ asset('uploads/'.$submisi->file) }}" class="bg-blue-500 text-white p-2 rounded mr-2">Buka</a>
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="message" class="leading-7 text-sm text-gray-600">Unggah</label>
                                        <input type="file" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" name="file">
                                        </div>
                                    </div>
                                <div class="p-2 w-full">
                                    <div class="relative">
                                    <label for="message" class="leading-7 text-sm text-gray-600">Catatan (Jika Ada)</label>
                                    <textarea id="message" name="catatan" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{$submisi->catatan}}</textarea>
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <button class="flex mx-auto text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">Unggah</button>
                                </div>
                                </div>
                            </div>
                        </form>
                        @else
                            <form action="{{route('unggah', [$class->slug,$tugas->id])}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                    <div class="flex flex-wrap -m-2">
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                            <label for="message" class="leading-7 text-sm text-gray-600">Unggah</label>
                                            <input type="file" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" name="file">
                                            </div>
                                        </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="message" class="leading-7 text-sm text-gray-600">Catatan (Jika Ada)</label>
                                        <textarea id="message" name="catatan" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <button class="flex mx-auto text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">Unggah</button>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                      @else
                      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-red-500">Waktu Habis</h1>
                      @endif
                    </div>
                  </section>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        var countDownDate = new Date('{{$tugas->deadline}}');

        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = days + " Hari " + hours + " Jam "
        + minutes + " Menit " + seconds + " Detik ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
        }, 1000);
    </script>
@endsection