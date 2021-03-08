@extends('layouts.asisten')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Detail Tugas {{$submission->assigment->title}}, {{$submission->mahasiswa->user->name}}
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <table>
                    <tbody>
                        <tr>
                            <td>NIM</td>
                            <td>:</td>
                            <td>{{ $submission->mahasiswa->user->username }}</td>
                          </tr>
                      <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $submission->mahasiswa->user->name }}</td>
                      </tr>
                      
                      <tr>
                        <td>Tugas</td>
                        <td>:</td>
                        <td>{{$submission->assigment->title}}</td>
                      </tr>
                      <tr>
                          <td>Catatan</td>
                          <td>:</td>
                          <td>{{ $submission->catatan}}</td>
                        </tr>
                        <tr>
                            <td>File</td>
                            <td>:</td>
                            <td><a href="{{ asset('uploads/'.$submission->file) }}" class="text-green-500">Buka</a></td>
                          </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection