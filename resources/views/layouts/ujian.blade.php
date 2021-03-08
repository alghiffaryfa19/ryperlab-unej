<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @stack('scripts')
        <script src="{{asset('superadmin/js/jquery.min.js')}}"></script>
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
        <!--Responsive Extension Datatables CSS-->
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
        <link href="//cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="//cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <style>
            /*Overrides for Tailwind CSS */
            /*Form fields*/
            
            .dataTables_wrapper select,
            .dataTables_wrapper .dataTables_filter input {
                color: #4a5568;
                /*text-gray-700*/
                padding-left: 1rem;
                /*pl-4*/
                padding-right: 1rem;
                /*pl-4*/
                padding-top: .5rem;
                /*pl-2*/
                padding-bottom: .5rem;
                /*pl-2*/
                line-height: 1.25;
                /*leading-tight*/
                border-width: 2px;
                /*border-2*/
                border-radius: .25rem;
                border-color: #edf2f7;
                /*border-gray-200*/
                background-color: #edf2f7;
                /*bg-gray-200*/
            }
            /*Row Hover*/
            
            table.dataTable.hover tbody tr:hover,
            table.dataTable.display tbody tr:hover {
                background-color: #ebf4ff;
                /*bg-indigo-100*/
            }
            /*Pagination Buttons*/
            
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                font-weight: 700;
                /*font-bold*/
                border-radius: .25rem;
                /*rounded*/
                border: 1px solid transparent;
                /*border border-transparent*/
            }
            /*Pagination Buttons - Current selected */
            
            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                color: #fff !important;
                /*text-white*/
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
                /*shadow*/
                font-weight: 700;
                /*font-bold*/
                border-radius: .25rem;
                /*rounded*/
                background: #667eea !important;
                /*bg-indigo-500*/
                border: 1px solid transparent;
                /*border border-transparent*/
            }
            /*Pagination Buttons - Hover */
            
            .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                color: #fff !important;
                /*text-white*/
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
                /*shadow*/
                font-weight: 700;
                /*font-bold*/
                border-radius: .25rem;
                /*rounded*/
                background: #667eea !important;
                /*bg-indigo-500*/
                border: 1px solid transparent;
                /*border border-transparent*/
            }
            /*Add padding to bottom border */
            
            table.dataTable.no-footer {
                border-bottom: 1px solid #e2e8f0;
                /*border-b-1 border-gray-300*/
                margin-top: 0.75em;
                margin-bottom: 0.75em;
            }
            /*Change colour of responsive icon*/
            
            table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
            table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
                background-color: #667eea !important;
                /*bg-indigo-500*/
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.nav_mahasiswa')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
            });
        });
        </script>
        <script>
            @php 
            if($tipe == 'kerjakan_soal'){
                $akhir = strtotime($pengerjaan['time_end']);
            }
            if($tipe == 'waktu_tunggu'){
                $akhir = strtotime($exam['time_start']);
            }
            if($tipe == 'konfirmasi'){
                $akhir = strtotime($mapel['time_end']);
            }
            $waktu = $akhir - time();
            $jam = floor($waktu/3600);
            $menit = floor($waktu/60);
            $detik = floor($waktu%60);
            if ($menit < 60) {
                $jam = 0;
                $menit = $menit;
                $detik = $detik;
            }else {
                $jam = (int)($menit/60);
                $menit = $menit%60;
                $detik = $detik;
            }
            @endphp	
            $(document).ready(function() {
                var tipe = '{{ $tipe }}' ;
                var detik   = {{$detik }} ;
                var menit   = {{ $menit }};
                var jam     = {{ $jam }};
                function timeLeft() {
                    setTimeout(timeLeft,1000);
                    $('.time_left').html(
                        jam + ' : ' + menit + ' : ' + detik 
                        );
                    detik --;
                    if(detik < 0) {
                        detik = 59;
                        menit --;
                        if(menit < 0) {
                            menit = 59;
                            jam --;      
                            if(jam < 0) { 
                                if(tipe == 'waktu_tunggu'){
                                    $('.time_left').hide();
                                    $('.warn').show();
                                    $('.warn').html('<strong><span class="text-danger">Silahkan Klik Button Mulai, Ujian Telah Dapat Dimulai</span></strong>')
                                    $('#btn-mulai').removeAttr('disabled');
                                }
                                if(tipe == 'kerjakan_soal'){
                                    finish();
                                }
                            } 
                        } 
                    } 
                }           
                timeLeft();   
            });
    
            function start_ujian(id){
                var lm_ujian = $('#lm_ujian').val();
                var tutup = $('#tutup').val();
                var ujian_id = $('#ujian_id').val();
                var _token = "{{ csrf_token() }}";
                $.ajax({
                    url: '{{ route('attemp') }}',
                    type : 'POST',
                    dataType : 'JSON',
                    data : {_token:_token,ujian_id:ujian_id,lm_ujian:lm_ujian,tutup:tutup},
                    success: function(data) {
                        console.log(data);
                        window.location.href = '{{ url('mahasiswa/test/soal') }}'+'/'+data.ujian_id+'/'+data.no_soal;
                    }
                })
            } 
    
            function simpan_soal(kondisi,kd_soal) {
                var answer = '';
                var ujian_id = $('#ujian_id').val();
                var soal_id = $('#soal_id').val();
                var _token = "{{ csrf_token() }}";
                if($('#esay_answer').val() != null) {
                    answer = $('#esay_answer').val();
                }
                else if(document.getElementById('radio1').checked) {
                    answer = document.getElementById('radio1').value;
                }
                else if(document.getElementById('radio2').checked) {
                    answer = document.getElementById('radio2').value;
                }
                else if(document.getElementById('radio3').checked) {
                    answer = document.getElementById('radio3').value;
                }
                else if(document.getElementById('radio4').checked) {
                    answer = document.getElementById('radio4').value;
                }
                else if(document.getElementById('radio5').checked) {
                    answer = document.getElementById('radio5').value;
                }
                console.log(answer)
                $.ajax({
                    url : '{{ url('mahasiswa/test/simpan') }}',
                    type : 'POST',
                    dataType : 'JSON',
                    data : {_token:_token,ujian_id:ujian_id,soal_id:soal_id,answer:answer,kondisi:kondisi},
                    success : function(response) {
                        console.log('OK');
                        $('.simpan_soal').show();
                    }
                });
            }
    
            function finish(){
                    var ujian_id = $('#ujian_idi').val();
                    
                    var _token = "{{ csrf_token() }}";
                    $.ajax({
                        url : '{{route('finish')}}',
                        type : 'POST',
                        data : {_token:_token,ujian_id:ujian_id},
                        success : function(response){
                            window.location.href = '{{route('mahasiswa')}}'
                        }
                    })
                }   
    
        </script>
        @yield('script')
        
    </body>
    
</html>
