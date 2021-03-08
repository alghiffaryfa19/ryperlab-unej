@extends('layouts.admin')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Edit Akun {{$user->name}}
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{route('akun.update', $user->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col w-full max-w-sm mx-auto p-4 bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Name
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
                                        value="{{$user->name}}"
                                        name="name"
                                        type="text"
                                        placeholder="Name"
                                        value=""
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    NIM
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
                                        value="{{$user->username}}"
                                        name="username"
                                        type="number"
                                        placeholder="NIM"
                                        value=""
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Email
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
                                        value="{{$user->email}}"
                                        name="email"
                                        type="email"
                                        placeholder="Email"
                                        value=""
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Role
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
                        
                                    <select name="role" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                        <option @if ($user->role == 1) selected @endif value="1">Admin</option>
                                        <option @if ($user->role == 2) selected @endif value="2">Asisten</option>
                                        <option @if ($user->role == 3) selected @endif value="3">Mahasiswa</option>
                                    </select>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Password
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
                                        name="password"
                                        type="text"
                                        placeholder="Password"
                                        value=""
                                        class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                        
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