@extends('layouts.ujian')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{$pengerjaan->ujian->nama}}
</span>   
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-7 mx-auto flex items-center md:flex-row flex-col">
                      <div class="flex flex-col md:pr-10 md:mb-0 mb-6 pr-0 w-full md:w-auto md:text-left text-center">
                      </div>
                      <div class="flex md:ml-auto md:mr-0 mx-auto items-center flex-shrink-0 space-x-4">
                        <h5 class="ml-auto">Waktu tersisa <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-blue-600 rounded-full time_left"></span></h5>
                      </div>
                    </div>
                    <div style="display: none;" class="simpan_soal mt-8 block text-sm text-green-600 bg-green-200 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                        <strong class="mr-1">Jawaban berhasil disimpan.</strong> Silahkan mengerjakan soal selanjutnya!
                        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
                        </button>
                    </div>
                    <input type="hidden" id="soal_id" name="soal_id" value="{{ $soal->soal_id }}">
                    <input type="hidden" id="ujian_id" name="ujian_id" value="{{ $soal->ujian_id }}">
                    <input type="hidden" id="ujian_idi" value="{{$soal->ujian_id}}" name="ujian_idi">
                    <strong class="text-dark">Soal nomor {{ $soal['nomor_soal'] }} dari {{ getJumlahSoal($soal['ujian_id']) }}</strong>
                    <p>{!! $soal['soal'] !!}</p>
                    @if($soal['option_1'] != null && $soal['option_2'] != null && $soal['option_3'] != null && $soal['option_4'] != null && $soal['option_5'] != null)
                    <strong class="text-dark mt-5">Pilih salah satu jawaban</strong>
                        <ol type="a" class="option_test">
                            <li>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="radio1"  class="custom-control-input" name="answer" value="a"
                                    @if (tess($soal->soal_id,auth()->user()->mahasiswa->id))
                                        @if(tes($soal->soal_id,auth()->user()->mahasiswa->id) == 'a')
                                            {{ 'checked' }}
                                        @endif
                                    @endif
                                    
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
                                                        @if (tess($soal->soal_id,auth()->user()->mahasiswa->id))
                                                            @if(tes($soal->soal_id,auth()->user()->mahasiswa->id) == 'b')
                                                                {{ 'checked' }}
                                                            @endif
                                                        @endif
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
                                                        @if (tess($soal->soal_id,auth()->user()->mahasiswa->id))
                                                            @if(tes($soal->soal_id,auth()->user()->mahasiswa->id) == 'c')
                                                                {{ 'checked' }}
                                                            @endif
                                                        @endif
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
                                                        @if (tess($soal->soal_id,auth()->user()->mahasiswa->id))
                                                            @if(tes($soal->soal_id,auth()->user()->mahasiswa->id) == 'd')
                                                                {{ 'checked' }}
                                                            @endif
                                                        @endif
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
                                                        @if (tess($soal->soal_id,auth()->user()->mahasiswa->id))
                                                            @if(tes($soal->soal_id,auth()->user()->mahasiswa->id) == 'e')
                                                                {{ 'checked' }}
                                                            @endif
                                                        @endif
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
                                                <textarea name="answer" id="esay_answer" class="form-control" placeholder="Jawab disini">{{ CekYourAnswer($soal['soal_id']) }}</textarea>	
                                            @endif
                                            <div class="text-center">
                                                <button type="button" class="text-white bg-green-600 border-0 py-2 px-8 focus:outline-none hover:bg-green-900 rounded text-lg" onclick="simpan_soal('1','{{ $soal['ujian_id'] }}','{{ $soal['id'] }}')">Simpan</button>
                                                <button type="button" class="text-white bg-yellow-600 border-0 py-2 px-8 focus:outline-none hover:bg-yellow-900 rounded text-lg" onclick="simpan_soal('0','{{ $soal['ujian_id'] }}','{{ $soal['id'] }}')">Ragu-Ragu</button>
                                                @if ($soal['nomor_soal'] != 1)
                                                    <a type="button" href="{{ url('mahasiswa/test/soal/'.$soal['ujian_id'].'/'.($soal['nomor_soal']-1)) }}" class="text-white bg-blue-600 border-0 py-2 px-8 focus:outline-none hover:bg-blue-900 rounded text-lg">Sebelumnya</a>
                                                @endif
                                                @if ($soal['nomor_soal'] == getJumlahSoal($soal['ujian_id']))
                                                    <a type="button" href="{{ url('mahasiswa/test/konfirmasi/'.$soal['ujian_id']) }}" class="text-white bg-green-600 border-0 py-2 px-8 focus:outline-none hover:bg-green-900 rounded text-lg">Selesai</a>
                                                @else
                                                    <a type="button" href="{{ url('mahasiswa/test/soal/'.$soal['ujian_id'].'/'.($soal['nomor_soal']+1)) }}" class="text-white bg-blue-600 border-0 py-2 px-8 focus:outline-none hover:bg-blue-900 rounded text-lg">Selanjutnya</a>
                                                @endif
                                            </div>
                  </section>
            </div>
            <div class="p-6 mt-5 bg-white border-b border-gray-200">
                <section class="text-gray-600 body-font">
                    @foreach($daftarSoal as $data) 
                        @php $status = 'bg-gray-500'; @endphp
                            @if($data->nomor_soal == $soal['nomor_soal'])
                                @php $status = 'bg-blue-500'; @endphp
                            @elseif($data->nomor_soal != $soal['nomor_soal'])
                                @if(CekYakin($data->soal_id) == 1)
                                    @php $status = 'bg-green-500'; @endphp
                                @endif
                                @if(CekRagu2($data->soal_id) == 1)
                                    @php $status = 'bg-yellow-500'; @endphp	
                                @endif	
                            @endif
                                <a type="button" href="{{ url('mahasiswa/test/soal/'.$data->ujian_id.'/'.$data->nomor_soal) }}" class="text-white {{ $status }} border-0 py-2 px-8 focus:outline-non rounded text-lg">{{ $data->nomor_soal }}</a>
                    @endforeach    
                </section>
            </div>
        </div>
    </div>
</div>
@php
    $tipe = 'kerjakan_soal';
@endphp	
@endsection