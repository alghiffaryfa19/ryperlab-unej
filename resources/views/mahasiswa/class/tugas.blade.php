@extends('layouts.mahasiswa')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Tugas
</span>   
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Judul</th>
                            <th data-priority="2">Deadline</th>
                            <th data-priority="3">Status</th>
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
       url: "{{ route('tugas',$kelas->slug) }}",
      },
      columns:[
       {
        data: 'title',
        name: 'title'
       },
       {
        data: 'waktu',
        name: 'waktu',
        searchable: false,
        orderable: false,
       },
       {
        data: 'status',
        name: 'status',
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