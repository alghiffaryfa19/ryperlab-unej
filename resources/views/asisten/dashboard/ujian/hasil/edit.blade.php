@extends('layouts.asisten')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Detail Pengerjaan Ujian {{$nilaii->mahasiswa->user->name}}
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                <table>
                    <tbody>
                      <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $nilaii->mahasiswa->user->name }}</td>
                      </tr>
                      
                      <tr>
                        <td>Nilai PG</td>
                        <td>:</td>
                        <td>{{ $nilaii['nilai'] }}</td>
                      </tr>
                      <tr>
                          <td>Nilai Isian</td>
                          <td>:</td>
                          <td>{{ $nilaii['nilai_esay'] }}</td>
                        </tr>
                    </tbody>
                  </table>
                  <h5>Pengerjaan Anda</h5>
                    <ol class="list-decimal">
                    @foreach($pengerjaan as $data)
                    <br>
                        <li>{!! $data->soal !!}
                            @if($data->soal_image != NULL)
                            <img class="mb-3" src="{{ asset('images/gambar_soal/'.$data->soal_image) }}" />
                            @endif
                            @if(
                            $data->option_1 != null && $data->option_2 != null &&  $data->option_3 != null &&  $data->option_4 != null &&  $data->option_5 != null
                            )
                            <ol class="list-disc" class="option_test">
                            <li class="{{ CekPengerjaan('a',$data->your_answer,$data->right_answer) }}">
                                @if(strpbrk($data->option_1, 'jpg') == 'jpg' || strpbrk($data->option_1, 'JPG') == 'JPG' || strpbrk($data->option_1, 'png') == 'png' || strpbrk($data->option_1, 'PNG') == 'PNG' )
                                    <img class="mb-3" style="width: 100px;" src="{{ asset('images/gambar_jawaban/'.$data->option_1) }}" />
                                @else
                                    {!! $data->option_1 !!}
                                @endif
                            </li>
                            <li class="{{ CekPengerjaan('b',$data->your_answer,$data->right_answer) }}">
                                @if(strpbrk($data->option_2, 'jpg') == 'jpg' || strpbrk($data->option_2, 'JPG') == 'JPG' || strpbrk($data->option_2, 'png') == 'png' || strpbrk($data->option_2, 'PNG') == 'PNG' )
                                    <img class="mb-3" style="width: 100px;" src="{{ asset('images/gambar_jawaban/'.$data->option_2) }}" />
                                @else
                                    {!! $data->option_2 !!}
                                @endif
                            </li>
                            <li class="{{ CekPengerjaan('c',$data->your_answer,$data->right_answer) }}">
                                @if(strpbrk($data->option_3, 'jpg') == 'jpg' || strpbrk($data->option_3, 'JPG') == 'JPG' || strpbrk($data->option_3, 'png') == 'png' || strpbrk($data->option_3, 'PNG') == 'PNG' )
                                    <img class="mb-3" style="width: 100px;" src="{{ asset('images/gambar_jawaban/'.$data->option_3) }}" />
                                @else
                                    {!! $data->option_3 !!}
                                @endif
                            </li>
                            <li class="{{ CekPengerjaan('d',$data->your_answer,$data->right_answer) }}">@if(strpbrk($data->option_4, 'jpg') == 'jpg' || strpbrk($data->option_4, 'JPG') == 'JPG' || strpbrk($data->option_4, 'png') == 'png' || strpbrk($data->option_4, 'PNG') == 'PNG' )
                                    <img class="mb-3" style="width: 100px;" src="{{ asset('images/gambar_jawaban/'.$data->option_4) }}" />
                                @else
                                    {!! $data->option_4 !!}
                                @endif
                            </li>
                            <li class="{{ CekPengerjaan('e',$data->your_answer,$data->right_answer) }}">
                                @if(strpbrk($data->option_5, 'jpg') == 'jpg' || strpbrk($data->option_5, 'JPG') == 'JPG' || strpbrk($data->option_5, 'png') == 'png' || strpbrk($data->option_5, 'PNG') == 'PNG' )
                                    <img class="mb-3" style="width: 100px;" src="{{ asset('images/gambar_jawaban/'.$data->option_5) }}" />
                                @else
                                    {!! $data->option_5 !!}
                                @endif
                            </li>
                            </ol>
                            
                            @else
                            <br/>
                            <strong>Jawaban Esay : </strong>
                            <span >{!! $data->your_answer !!}</span>
                            @endif
                            <ol>
                                <li>Kunci Jawaban : {{ $data->right_answer }}</li>
                                <span>Pembahasan:</span><br>
                                <p>{!! $data->pembahasan !!}</p>
                            </ol>
                        </li>
                
                    @endforeach
                    </ol>
                    <hr/>
                    

                <form enctype="multipart/form-data" action="{{route('hasil.ujian.asisten.update', [$nilaii->ujian->kelas->id,$nilaii->ujian->id,$nilaii->id])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-5">
                        <div class="flex flex-col bg-white">
                            <div class="flex flex-col mb-4">
                                <label for="name"
                                    class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                    Nilai Essay
                                </label>
                        
                                <div class="relative">

                                    <input id="name"
                                        name="nilai_esay"
                                        type="number"
                                        placeholder="Nilai Essay"
                                        value="{{$nilaii->nilai_esay}}"
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