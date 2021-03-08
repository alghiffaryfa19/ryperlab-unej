@extends('layouts.mahasiswa')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Ujian
</span>   
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Ujian</th>
                            <th data-priority="2">Tanggal</th>
                            <th data-priority="3">Jam</th>
                            <th data-priority="4">Durasi</th>
                            <th data-priority="5">Tutup pada</th>
                            <th data-priority="6">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
      var id = $(this).attr('id');
     $('#example').DataTable({
      processing: true,
      stateSave: true,
      serverSide: true,
      ajax:{
       url: "{{ route('exam',$kelas->slug) }}",
      },
      columns:[
       {
        data: 'nama',
        name: 'nama'
       },
       {
        data: 'date_ujian',
        name: 'date_ujian',
        searchable: false,
        orderable: false,
       },
       {
        data: 'time_start',
        name: 'time_start',
        searchable: false,
        orderable: false,
       },
       {
        data: 'durasi',
        name: 'durasi',
        searchable: false,
        orderable: false,
       },
       {
        data: 'tutup',
        name: 'tutup',
        searchable: false,
        orderable: false,
       },
       {
        data: 'edit',
        name: 'edit',
        searchable: false,
        orderable: false,
       }
       
      ]
     });
    });
    </script>
@endsection