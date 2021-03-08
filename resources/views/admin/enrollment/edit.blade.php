@extends('layouts.admin')
@section('title','Dashboard')
@section('body')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Edit Enrollment {{$enrollment->mahasiswa->user->name}}</h3>



        <div class="mt-8 mb-8">
            
        </div>
        
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
            <form action="{{route('enrollment.update', $enrollment->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="my-5">
                    <div class="flex flex-col w-full max-w-sm mx-auto p-4 bg-white">
                        <div class="flex flex-col mb-4">
                            <label for="name"
                                class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                Mahasiswa
                            </label>
                    
                            <div class="relative">
                    
                                <select name="mahasiswa_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                    @foreach ($mahasiswa as $item)
                                        @if($item->id==$enrollment->mahasiswa_id)
                                        <option value={{$item->id}} selected='selected' >{{$item->user->name}} - {{$item->user->username}}</option>
                                        @else
                                        <option value={{$item->id}}>{{$item->user->name}} - {{$item->user->username}}</option>
                                    @endif
                                    @endforeach
                                </select>
                    
                            </div>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="name"
                                class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                Kelas
                            </label>
                    
                            <div class="relative">
                    
                                <select name="kelas_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                    @foreach ($kelas as $item)
                                        @if($item->id==$enrollment->kelas_id)
                                        <option value={{$item->id}} selected='selected' >{{$item->name}} ({{$item->asistant->matkul->name}})</option>
                                        @else
                                        <option value={{$item->id}}>{{$item->name}} ({{$item->asistant->matkul->name}})</option>
                                    @endif
                                    @endforeach
                                </select>
                    
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
</main>
@endsection