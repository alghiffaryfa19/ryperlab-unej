@extends('layouts.mahasiswa')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Edit Member {{$member->title}}
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{route('member_update', [$slug,$id,$a,$member->id])}}" enctype="multipart/form-data" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col w-full max-w-sm mx-auto p-4 bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                   NIM
                                </label>
                        
                                <div class="relative">
                    
                        
                                    <input id="name"
                                        name="nim"
                                        type="number"
                                        placeholder="NIM"
                                        value="{{$member->nim}}"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                   Nama
                                </label>
                        
                                <div class="relative">
                    
                        
                                    <input id="name"
                                        name="name"
                                        type="text"
                                        placeholder="Nama"
                                        value="{{$member->name}}"
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                   Role
                                </label>
                        
                                <div class="relative">
                                    <select name="role" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                        <option @if ($member->role == "Project Manager") selected @endif value="Project Manager">Project Manager</option>
                                        <option @if ($member->role == "System Analyst") selected @endif value="System Analyst">System Analyst</option>
                                        <option @if ($member->role == "Designer") selected @endif value="Designer">Designer</option>
                                        <option @if ($member->role == "Developer") selected @endif value="Developer">Developer</option>
                                        <option @if ($member->role == "Tester") selected @endif value="Tester">Tester</option>
                                        <option @if ($member->role == "Other") selected @endif value="Other">Other</option>
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
    </div>
</div>
@endsection