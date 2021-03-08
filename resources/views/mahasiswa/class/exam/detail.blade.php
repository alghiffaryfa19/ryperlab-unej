@extends('layouts.ujian')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{$exam->nama}}
</span>   
@endsection
<input type="hidden" name="lm_ujian" id="lm_ujian" value="{{ $exam['lama_ujian'] }}" />
<input type="hidden" name="tutup" id="tutup" value="{{ $exam['jam_tutup'] }}" />
<input type="hidden" name="ujian_id" id="ujian_id" value="{{ $exam['id'] }}" />
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-10 mx-auto">
                      <div class="text-center mb-5">
                        <h1 class="sm:text-3xl text-2xl font-medium text-center title-font text-gray-900 mb-4">{{$exam->nama}}</h1>
                        <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto">{{$exam->kelas->name}}</p>
                      </div>
                      <div class="card-body">
                        <span class="text-danger">Waktu tunggu ujian <span class="time_left"></span></span>
                        <div class="warn" style="display: none;"></div>
                        <ol>
                            <li>Berdoa kepada Tuhan Yang Maha Esa sebelum melakukan ujian semoga diberi kemudahan dan kelancaran.</li>
                            <li>Tombol mulai ujian akan dapat di klik apabila waktu tunggu ujian telah selesai.</li>
                            <li>Saat anda menjawab soal ujian setelah memilih jawaban yang anda anggap benar <b>WAJIB</b> menekan tombol <b>SIMPAN</b>, Agar jawaban anda tersimpan dan diproses oleh sistem.
                                Hingga muncul pemberitahuan seperti gambar dibawah ini jawaban telah berhasil disimpan.<br/>
                                <img style="width: 400px;" src="{{ asset('images/petunjuk_pengerjaan/Screenshot_5.png') }}" />
                            </li>
                            <li>Bila anda memiliki keraguan pada jawaban anda silahkan klik tombol <b>RAGU-RAGU</b> untuk memudahkan anda dalam meneliti jawaban anda.
                                Hingga muncul pemberitahuan seperti gambar dibawah ini jawaban telah berhasil disimpan.<br/>
                                <img style="width: 400px;" src="{{ asset('images/petunjuk_pengerjaan/Screenshot_5.png') }}" />
                            </li>
                            <li>
                                Gambar dibawah ini merupakan daftar soal yang akan anda kerjakan dengan keterangan berada dibawah gambar tersebut.<br>
                                <img style="width: 400px;" src="{{ asset('images/petunjuk_pengerjaan/Screenshot_6.png') }}" /><br/>
                                <b>Keterangan :</b>
                                <ul>
                                    <li>Warna biru menandakan anda sedang mengerjakan soal tersebut.</li>
                                    <li>Warna hijau menandakan anda telah menyimpan jawaban anda.</li>
                                    <li>Warna kuning menandakan anda telah menyimpan jawaban anda dengan ragu-ragu.</li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                    <div class="card-footer">
                        <button type="button" id="btn-mulai" disabled onclick="start_ujian('{{ $exam['id'] }}')" class="flex mx-auto mt-16 text-white bg-blue-900 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">Mulai</button>
                    
                    </div>
                    </div>
                  </section>
            </div>
        </div>
    </div>
</div>
@php
	$tipe = 'waktu_tunggu';
@endphp	
@endsection