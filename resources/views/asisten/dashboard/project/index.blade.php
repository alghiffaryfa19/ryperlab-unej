@extends('layouts.asisten')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Project {{$kelas->name}}
</span>   
<a style="float: right" href="{{route('project.asisten.create', $kelas->id)}}" class='bg-indigo-500 text-white p-2 rounded text-l font-bold'>Tambah Project</a>
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
                            <th data-priority="3">Aksi</th>
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
       url: "{{ route('project.asisten', $kelas->id) }}",
      },
      columns:[
       {
        data: 'name',
        name: 'name'
       },
       {
        data: 'deadline',
        name: 'deadline'
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
