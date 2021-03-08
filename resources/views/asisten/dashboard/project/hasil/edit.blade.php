@extends('layouts.asisten')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Detail Project {{$submission->projects->name}}, {{$submission->mahasiswa->user->name}}
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
              <img class="lg:block h-20 rounded-full object-cover w-20" src="{{ asset('uploads/'.$submission->project_logo) }}" alt="Workflow">
                <table>
                    <tbody>
                        <tr>
                            <td>Nama Project</td>
                            <td>:</td>
                            <td>{{ $submission->project_name }}</td>
                          </tr>
                      <tr>
                        <td>Nama Tim</td>
                        <td>:</td>
                        <td>{{ $submission->team_name }}</td>
                      </tr>
                      
                      <tr>
                        <td>Link</td>
                        <td>:</td>
                        <td><a class="text-green-500" href="{{ $submission->project_link }}">Buka</a></td>
                      </tr>

                      <tr>
                        <td>Dokumen</td>
                        <td>:</td>
                        <td><a class="text-green-500" href="{{ asset('uploads/'.$submission->project_document) }}">Buka</a></td>
                      </tr>
                    </tbody>
                  </table>
                  <p>{!!$submission->description!!}</p>
                  <br>
                  <p class="leading-relaxed text-base">Super Team: </p>
                  <div>
                      <ol>
                          <li>
                              {{$submission->mahasiswa->user->name}} ({{$submission->mahasiswa->user->username}}) - Leader
                          </li>
                          @foreach ($submission->member as $item)
                              <li>
                                  {{$item->name}} ({{$item->nim}}) - {{$item->role}}
                              </li>
                          @endforeach
                      </ol>
                      
                  </div>
                  <br>
                  <section class="text-gray-600 body-font">
                    <div class="container px-5 py-24 mx-auto">
                      <h4>Dokumentasi: </h4>
                      <div class="flex flex-wrap -m-4">
                        
                        @foreach ($submission->galeri as $item)
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
            </div>
        </div>
    </div>
</div>
@endsection