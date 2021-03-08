@extends('layouts.admin')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Edit Sub Event {{$subevent->nama_sub_event}} , {{$subevent->event->nama_event}}
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{route('subevent.update', [$subevent->event_id,$subevent->id])}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col w-full max-w-sm mx-auto p-4 bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Nama Sub Event
                                </label>
                        
                                <div class="relative">
                        
                                    <input id="name"
                                        name="nama_sub_event"
                                        type="text"
                                        placeholder="Name"
                                        value="{{$subevent->nama_sub_event}}"
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