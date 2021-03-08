@extends('layouts.mahasiswa')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{$project->name}} 
</span>   
@if (cekProject($project->id,auth()->user()->mahasiswa->id))
<span style="float: right">
    <a href="{{route('galeri_project', [$class->slug,$project->id,$assignment->id])}}" class='bg-blue-500 mr-2 text-white p-2 rounded text-l font-bold'>Galeri</a>
    <a href="{{route('member_project', [$class->slug,$project->id,$assignment->id])}}" class='bg-blue-500 text-white p-2 rounded text-l font-bold'>Anggota</a>
</span>
@endif
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font relative">
                    <div class="container px-5 py-24 mx-auto">
                      <div class="flex flex-col text-center w-full mb-12">
                        <h1 class="sm:text-3xl text-2xl font-bold title-font mb-4 text-gray-900">{{$project->name}}</h1>
                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{!!$project->deskripsi!!}</p>
                        <p class="text-center" id="demo"></p>
                      </div>
                      @if (\Carbon\Carbon::now()->isBefore($project->deadline))
                        @if (cekProject($project->id,auth()->user()->mahasiswa->id))
                        <form action="{{route('unggah_ulang_project', [$class->slug,$project->id])}}" enctype="multipart/form-data" method="post">
                            @method('PUT')
                            @csrf
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <div class="flex flex-wrap -m-2">
                                    <img class="lg:block h-20 rounded-full object-cover w-20" src="{{ asset('uploads/'.$assignment->project_logo) }}" alt="Workflow">
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="message" class="leading-7 text-sm text-gray-600">Kategori</label>
                                        <select name="category_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            @foreach ($category as $item)
                                            @if($item->id==$assignment->category_id)
                                            <option value={{$item->id}} selected='selected' >{{$item->name}}</option>
                                            @else
                                            <option value={{$item->id}}>{{$item->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="message" class="leading-7 text-sm text-gray-600">Nama Project</label>
                                        <input type="text" value="{{$assignment->project_name}}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" name="project_name">
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="message" class="leading-7 text-sm text-gray-600">Nama Tim</label>
                                        <input type="text" value="{{$assignment->team_name}}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" name="team_name">
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="message" class="leading-7 text-sm text-gray-600">Deskripsi Project</label>
                                        <textarea id="message" name="description" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{$assignment->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="message" class="leading-7 text-sm text-gray-600">Tautan Project</label>
                                        <input type="url" value="{{$assignment->project_link	}}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" name="project_link">
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="message" class="leading-7 text-sm text-gray-600">Dokumen Project</label>
                                        <input type="file" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" name="project_document">
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="message" class="leading-7 text-sm text-gray-600">Logo Project</label>
                                        <input type="file" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" name="project_logo">
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <button class="flex mx-auto text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">Unggah</button>
                                    </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="message" class="leading-7 text-sm text-gray-600">Dokumen yang telah diunggah</label>
                                        <br>
                                        <a href="{{ asset('uploads/'.$assignment->project_document) }}" class="bg-blue-500 text-white p-2 rounded mr-2">Buka</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @else
                            <form action="{{route('unggah_project', [$class->slug,$project->id])}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                    <div class="flex flex-wrap -m-2">
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                            <label for="message" class="leading-7 text-sm text-gray-600">Kategori</label>
                                            <select name="category_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                @foreach ($category as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                            <label for="message" class="leading-7 text-sm text-gray-600">Nama Project</label>
                                            <input type="text" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" name="project_name">
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                            <label for="message" class="leading-7 text-sm text-gray-600">Nama Tim</label>
                                            <input type="text" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" name="team_name">
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                            <label for="message" class="leading-7 text-sm text-gray-600">Deskripsi Project</label>
                                            <textarea id="message" name="description" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                            <label for="message" class="leading-7 text-sm text-gray-600">Tautan Project</label>
                                            <input type="url" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" name="project_link">
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                            <label for="message" class="leading-7 text-sm text-gray-600">Dokumen Project</label>
                                            <input type="file" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" name="project_document">
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                            <label for="message" class="leading-7 text-sm text-gray-600">Logo Project</label>
                                            <input type="file" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" name="project_logo">
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
        var countDownDate = new Date('{{$project->deadline}}');

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