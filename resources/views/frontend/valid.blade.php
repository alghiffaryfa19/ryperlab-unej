@extends('layouts.frontend')
@section('description','E-Certificate')
@section('title','E-Certificate')
@section('content')
<section class="blog text-gray-700 body-font">
    <div class="container px-5 py-24 mx-auto">

        <div id='recipients' class="p-8 mt-1 lg:mt-0 rounded shadow bg-white">
            <div class="mt-8 mb-8 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                <strong class="mr-1">Hey</strong> Sertifikat Valid
                <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                    <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-green-900" aria-hidden="true" >×</span>
                </button>
            </div>


            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th>No. HP</th>
                        <th>Nama</th>
                        <th>Instansi</th>
                        <th>E-Mail</th>
                        <th>Event</th>
                        <th>Status</th>
                      </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$user->identity}}</td>
                        <td>{{$user->nama}}</td>
                        <td>{{$user->instansi}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->sub_event->event->nama_event}}</td>
                        <td>{{$user->sub_event->nama_sub_event}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr></tr>
                </tfoot>

            </table>


        </div>
    </div>
</section>
@endsection