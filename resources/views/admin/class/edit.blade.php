@extends('layouts.admin')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Edit Kelas {{$class->name}}
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{route('class.update', $class->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col w-full max-w-sm mx-auto p-4 bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Nama Kelas
                                </label>
                        
                                <div class="relative">
                        
                                    <div class="absolute flex border border-transparent left-0 top-0 h-full w-10">
                                        <div class="flex items-center justify-center rounded-tl rounded-bl z-10 bg-gray-100 text-gray-600 text-lg h-full w-full">
                                            <svg viewBox="0 0 24 24"
                                                width="24"
                                                height="24"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                fill="none"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="h-5 w-5">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12"
                                                        cy="7"
                                                        r="4"></circle>
                                            </svg>
                                        </div>
                                    </div>
                        
                                    <input id="name"
                                        name="name"
                                        type="text"
                                        placeholder="Name"
                                        value="{{$class->name}}"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Mata Kuliah
                                </label>
                        
                                <div class="relative">
                        
                                    <select name="matkul_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                        @foreach ($matkul as $item)
                                            @if($item->id==$class->matkul_id)
                                            <option value={{$item->id}} selected='selected' >{{$item->name}}</option>
                                            @else
                                            <option value={{$item->id}}>{{$item->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Asistant
                                </label>
                        
                                <div class="relative">
                        
                                    <select multiple name="values[]" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        @foreach($asistant as $tag)
                                        <option
                                                @foreach($class->asistant as $por_tech)
                                                    {{ $por_tech->id == $tag->id ? 'selected' :'' }}
                                                @endforeach
                                                value="{{ $tag->id }}">{{ $tag->user->name }}</option>
                                        @endforeach
                                    </select>
                        
                                </div>
                            </div>

                            {{-- <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Asistant
                                </label>
                        
                                <div class="relative">
                        
                                    <select name="assitant_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                        @foreach ($asistant as $item)
                                            @if($item->id==$class->assitant_id)
                                            <option value={{$item->id}} selected='selected' >{{$item->user->name}}</option>
                                            @else
                                            <option value={{$item->id}}>{{$item->user->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                        
                                </div>
                            </div> --}}
                            
                            
                            
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