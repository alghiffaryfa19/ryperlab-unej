@extends('layouts.ujian')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Konfirmasi
</span>   
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-10 mx-auto">
                        <div class="card-body">
                            <input type="hidden" id="ujian_idi" value="{{$mapel->ujian_id}}" name="ujian_id">
                            <h5>Periksa kembali pengerjaan anda waktu anda masih tersisa <strong><span class="time_left text-danger"></span></strong></h5>
                            @if(CekRagu($mapel->ujian_id) > 0)
                            <span class="text-danger">Kamu masih memiliki jawaban ragu-ragu sebanyak {{$ragu}}, kembali dan selesaikan</span>
                            @endif
                        </div>
                        <div class="card-footer">
                            <a href="{{ url()->previous() }}" class="text-white bg-red-400 border-0 py-2 px-8 focus:outline-none hover:bg-red-900 rounded text-lg">Kembali mengerjakan</a>
                            @if(CekRagu($mapel->ujian_id) == 0)
                            
                            <button class="text-white bg-blue-400 border-0 py-2 px-8 focus:outline-none hover:bg-blue-900 rounded text-lg" id="selesai_sudah" onclick="finish()">Selesai mengerjakan</button>
                            
                                
                            
                            @endif
                        </div>
                    </div>
                  </section>
            </div>
        </div>
    </div>
</div>
@php
	$tipe = 'konfirmasi';
@endphp	
@endsection