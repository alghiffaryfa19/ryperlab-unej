@extends('layouts.ujian')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{$pengerjaan->ujian->nama}}
</span>   
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-10 mx-auto">
                        
                        <div class="container">
                            <div class="mt-5 row justify-content-end">
                                <div class="col-md-4">
                                    <div class="row">
                                        <h5 class="ml-auto">Waktu tersisa <span class="shadow badge badge-info time_left"></span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5 justify-content-center">
                                <div class="col-md-8">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Soal No {{ $soal['nomor_soal'] }}  dari {{ getJumlahSoal($soal['ujian_id']) }}</h6>
                                        </div>
                                        <div class="card-body">
                                            <div style="display: none;" class="simpan_soal alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Jawaban berhasil disimpan.</strong> Silahkan mengerjakan soal selanjutnya!
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <input type="hidden" id="soal_id" name="soal_id" value="{{ $soal->soal_id }}">
                                            <input type="hidden" id="ujian_id" name="ujian_id" value="{{ $soal->ujian_id }}">
                                            <strong class="text-dark">Soal nomor {{ $soal['no_soal'] }}</strong>
                                            <h6>{!! $soal['soal'] !!}</h6>
                                            @if($soal['option_1'] != null && $soal['option_2'] != null && $soal['option_3'] != null && $soal['option_4'] != null && $soal['option_5'] != null)
                                            <strong class="text-dark mt-5">Pilih salah satu jawaban</strong>
                                            <ol type="a" class="option_test">
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="radio1"  class="custom-control-input" name="answer" value="a" 
                                                         
                                                        />
                                                        <label class="custom-control-label" for="radio1">
                                                            @if(strpbrk($soal['option_1'], 'jpg') == 'jpg' || strpbrk($soal['option_1'], 'JPG') == 'JPG' || strpbrk($soal['option_1'], 'png') == 'png' || strpbrk($soal['option_1'], 'PNG') == 'PNG' )
                                                                <img  class="mb-2" style="width: 100px;" src="{{ asset('images/gambar_jawaban/'.$soal['option_1']) }}" />
                                                            @else
                                                               {!! $soal['option_1'] !!}
                                                            @endif
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="radio2" class="custom-control-input" name="answer" value="b" 
                                                        
                                                        />
                                                        <label class="custom-control-label" for="radio2">
                                                            @if(strpbrk($soal['option_2'], 'jpg') == 'jpg' || strpbrk($soal['option_2'], 'JPG') == 'JPG' || strpbrk($soal['option_2'], 'png') == 'png' || strpbrk($soal['option_2'], 'PNG') == 'PNG' )
                                                                <img class="mb-2" style="width: 100px;" src="{{ asset('images/gambar_jawaban/'.$soal['option_2']) }}" />
                                                            @else
                                                            {!! $soal['option_2'] !!}
                                                            @endif
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="radio3" class="custom-control-input" name="answer" value="c" 

                                                        />
                                                        <label class="custom-control-label" for="radio3">
                                                            @if(strpbrk($soal['option_3'], 'jpg') == 'jpg' || strpbrk($soal['option_3'], 'JPG') == 'JPG' || strpbrk($soal['option_3'], 'png') == 'png' || strpbrk($soal['option_3'], 'PNG') == 'PNG' )
                                                                <img class="mb-2" style="width: 100px;" src="{{ asset('images/gambar_jawaban/'.$soal['option_3']) }}" />
                                                            @else
                                                            {!! $soal['option_3'] !!}
                                                            @endif
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="radio4" class="custom-control-input" name="answer" value="d" 
                                                        
                                                        />
                                                        <label class="custom-control-label" for="radio4">
                                                            @if(strpbrk($soal['option_4'], 'jpg') == 'jpg' || strpbrk($soal['option_4'], 'JPG') == 'JPG' || strpbrk($soal['option_4'], 'png') == 'png' || strpbrk($soal['option_4'], 'PNG') == 'PNG' )
                                                                <img class="mb-2" style="width: 100px;" src="{{ asset('images/gambar_jawaban/'.$soal['option_4']) }}" />
                                                            @else
                                                            {!! $soal['option_4'] !!}
                                                            @endif
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="radio5" class="custom-control-input" name="answer" value="e" 
                                                        
                                                        />
                                                        <label class="custom-control-label" for="radio5">
                                                            @if(strpbrk($soal['option_5'], 'jpg') == 'jpg' || strpbrk($soal['option_5'], 'JPG') == 'JPG' || strpbrk($soal['option_5'], 'png') == 'png' || strpbrk($soal['option_5'], 'PNG') == 'PNG' )
                                                                <img class="mb-2" style="width: 100px;" src="{{ asset('images/gambar_jawaban/'.$soal['option_5']) }}" />
                                                            @else
                                                            {!! $soal['option_5'] !!}
                                                            @endif
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>	
                                            @else
                                                <strong class="text-dark mt-5">Masukan jawaban anda</strong>
                                                <textarea name="answer" id="esay_answer" class="form-control" placeholder="Jawab disini">{{ CekYourAnswer($soal['soal_id'],Auth::user()->id) }}</textarea>	
                                            @endif
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-success btn-sm mb-2" 
                                            onclick="simpan_soal('1','{{ $soal['ujian_id'] }}','{{ $soal['id'] }}')">Simpan</button>
                                            <button type="button" class="btn btn-warning btn-sm mb-2" 
                                            onclick="simpan_soal('0','{{ $soal['ujian_id'] }}','{{ $soal['id'] }}')">Ragu-Ragu</button>
                                            @if($soal['nomor_soal'] != 1)
                                            <a href="{{ url('test/soal/'.$soal['ujian_id'].'/'.($soal['nomor_soal']-1)) }}" class="btn btn-secondary btn-sm mb-2">Sebelumnya</a>
                                            @endif
                                            @if($soal['nomor_soal'] == getJumlahSoal($soal['ujian_id']))
                                            <a href="{{ url('test/konfirmasi/'.$soal['ujian_id']) }}" class="btn btn-danger btn-sm mb-2">Selesai</a>
                                            @else
                                            <a href="{{ url('test/soal/'.$soal['ujian_id'].'/'.($soal['nomor_soal']+1)) }}" class="btn btn-secondary btn-sm mb-2">Selanjutnya</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Daftar Soal</h6>
                                        </div>
                                        <div class="card-body">
                                            @foreach($daftarSoal as $data) 
                                                @php $status = 'btn-secondary'; @endphp
                                                @if($data->nomor_soal == $soal['nomor_soal'])
                                                    @php $status = 'btn-info'; @endphp
                                                @elseif($data->nomor_soal != $soal['nomor_soal'])
                                                @if(CekYakin($data->soal_id) == 1)
                                                            @php $status = 'btn-success'; @endphp
                                                        @endif
                                                        @if(CekRagu2($data->soal_id) == 1)
                                                            @php $status = 'btn-warning'; @endphp	
                                                        @endif	
                                                @endif
                                                <a href="{{ url('test/soal/'.$data->ujian_id.'/'.$data->nomor_soal) }}" class="btn {{ $status }} btn-lg mb-2">{{ $data->nomor_soal }}</a>
                                            @endforeach
                                        </div>	
                                    </div>
                                </div>
                            </div>
                            </div>
                            
                      

                    </div>
                  </section>
            </div>
        </div>
    </div>
</div>
@php
    $tipe = 'kerjakan_soal';
@endphp	
@endsection