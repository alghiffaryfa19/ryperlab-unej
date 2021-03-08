@extends('layouts.asisten')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Ujian {{$kelas->name}}
</span>   
<a style="float: right" href="{{route('ujian.asisten.create', $kelas->id)}}" class='bg-indigo-500 text-white p-2 rounded text-l font-bold'>Tambah Ujian</a>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Judul</th>
                            <th data-priority="2">Tgl</th>
                            <th data-priority="3">Start</th>
                            <th data-priority="4">Durasi</th>
                            <th data-priority="5">End</th>
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
       url: "{{ route('ujian.asisten', $kelas->id) }}",
      },
      columns:[
       {
        data: 'nama',
        name: 'nama'
       },
       {
        data: 'date_ujian',
        name: 'date_ujian'
       },
       {
        data: 'time_start',
        name: 'time_start'
       },
       {
        data: 'durasi',
        name: 'durasi'
       },
       {
        data: 'jam_tutup',
        name: 'jam_tutup'
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
    <script>
		const modal = document.querySelector('.main-modal');
		const closeButton = document.querySelectorAll('.modal-close');

		const modalClose = () => {
			modal.classList.remove('fadeIn');
			modal.classList.add('fadeOut');
			setTimeout(() => {
				modal.style.display = 'none';
			}, 500);
		}

		const openModal = () => {
			modal.classList.remove('fadeOut');
			modal.classList.add('fadeIn');
			modal.style.display = 'flex';
		}

		for (let i = 0; i < closeButton.length; i++) {

			const elements = closeButton[i];

			elements.onclick = (e) => modalClose();

			modal.style.display = 'none';

			window.onclick = function (event) {
				if (event.target == modal) modalClose();
			}
		}
	</script>
@endsection
