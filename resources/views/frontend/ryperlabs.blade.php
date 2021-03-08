@extends('layouts.frontend')
@section('description','Contacts')
@section('title','Contacts')
@section('content')
<!-- component -->
<!-- Root element for center items -->
<div class="flex flex-col h-screen bg-gray-100">
    <!-- Auth Card Container -->
    <div class="grid place-items-center mx-2 my-20 sm:my-auto">
        <!-- Auth Card -->
        <div class="w-11/12 p-12 sm:w-8/12 md:w-6/12 lg:w-5/12 2xl:w-4/12 
            px-6 py-10 sm:px-10 sm:py-6 
            bg-white rounded-lg shadow-md lg:shadow-lg">

            <!-- Card Title -->
            <div class="p-6 mr-2 sm:rounded-lg">
                <div class="flex flex-wrap justify-center">
                    <img class="h-20 w-auto mr-2" src="{{asset('ryperlab/img/unej.png')}}" alt="Workflow">
                    <img class="h-20 w-auto" src="{{asset('ryperlab/img/logo.png')}}" alt="Workflow">
                </div>
                
                

                <p class="mt-4 text-center">Laboratorium Rekayasa Perangkat Lunak, Fakultas Ilmu Komputer, Universitas Jember</p>
                
            </div>
        </div>
    </div>
</div>
@endsection