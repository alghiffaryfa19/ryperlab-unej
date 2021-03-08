@extends('layouts.mahasiswa')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Daftar Kelas') }}
</span>   
<span style="float: right">
    <p id="demo"></p>
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if (\Carbon\Carbon::now()->isBefore($timer->waktu))
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Nama</th>
                            <th data-priority="2">Matkul</th>
                            <th data-priority="3">Detail</th>
                        </tr>
                    </thead>
                </table>
                @else
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-red-900">Waktu Habis</h1>
                @endif
                
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
       url: "{{ route('enroll') }}",
      },
      columns:[
       {
        data: 'name',
        name: 'name'
       },
       {
        data: 'matkul.name',
        name: 'matkul.name'
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
    <script>
        var countDownDate = new Date('{{$timer->waktu}}');

        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = days + " Hari " + hours + " Jam "
        + minutes + " Menit " + seconds + " Detik ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
        }, 1000);
    </script>
@endsection