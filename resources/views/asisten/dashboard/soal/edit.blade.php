@extends('layouts.asisten')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Soal
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <form enctype="multipart/form-data" action="{{route('soal.asisten.update', [$soal->ujian->kelas->id,$soal->ujian->id,$soal->id])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Soal
                                </label>
                        
                                <div class="relative">
                        
                                    
                        
                                    <textarea class="summernote text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6"
                                    name="soal">{!!$soal->soal!!}</textarea>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Jawaban A
                                </label>
                        
                                <div class="relative">

                                    <textarea class="summernote text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6"
                                    name="option_1">{!!$soal->option_1!!}</textarea>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Jawaban B
                                </label>
                        
                                <div class="relative">

                                    <textarea class="summernote text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6"
                                    name="option_2">{!!$soal->option_2!!}</textarea>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Jawaban C
                                </label>
                        
                                <div class="relative">

                                    <textarea class="summernote text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6"
                                    name="option_3">{!!$soal->option_3!!}</textarea>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Jawaban D
                                </label>
                        
                                <div class="relative">

                                    <textarea class="summernote text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6"
                                    name="option_4">{!!$soal->option_4!!}</textarea>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Jawaban E
                                </label>
                        
                                <div class="relative">

                                    <textarea class="summernote text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6"
                                    name="option_5">{!!$soal->option_5!!}</textarea>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Jawaban Benar
                                </label>
                        
                                <div class="relative">

                                    <select name="right_answer" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                                        <option @if($soal->right_answer == '') selected @endif value=""></option>
                                        <option @if($soal->right_answer == 'a') selected @endif value="a">A</option>
                                        <option @if($soal->right_answer == 'b') selected @endif value="b">B</option>
                                        <option @if($soal->right_answer == 'c') selected @endif value="c">C</option>
                                        <option @if($soal->right_answer == 'd') selected @endif value="d">D</option>
                                        <option @if($soal->right_answer == 'e') selected @endif value="e">E</option>
                                    </select>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Pembahasan
                                </label>
                        
                                <div class="relative">

                                    <textarea class="summernote text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6"
                                    name="pembahasan">{!!$soal->pembahasan!!}</textarea>
                        
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Skor
                                </label>
                        
                                <div class="relative">

                                    <input id="name"
                                        name="skor"
                                        type="number"
                                        placeholder="Skor"
                                        value="{{$soal->skor}}"
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