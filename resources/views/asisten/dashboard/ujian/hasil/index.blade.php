@extends('layouts.asisten')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Hasil {{$ujian->nama}}
</span>   

@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">ID</th>
                            <th data-priority="2">Nama</th>
                            <th data-priority="3">Nilai</th>
                            <th data-priority="4">Aksi</th>
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
       url: "{{ route('hasil.ujian.asisten', [$ujian->kelas->id,$ujian->id]) }}",
      },
      columns:[
        {
        data: 'mahasiswa.user.username',
        name: 'mahasiswa.user.username',
       },
        {
        data: 'mahasiswa.user.name',
        name: 'mahasiswa.user.name',
       },

        {
        data: 'total',
        name: 'total',
        searchable: false
       },

       {
        data: 'edit',
        name: 'edit',
        searchable: false
       }
       
      ]
     });
    });
    </script>
@endsection
