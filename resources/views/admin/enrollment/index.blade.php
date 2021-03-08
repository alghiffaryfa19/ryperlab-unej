@extends('layouts.admin')
@section('title','Enrollment')
@section('body')
<style>
    .animated {
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    .animated.faster {
        -webkit-animation-duration: 500ms;
        animation-duration: 500ms;
    }

    .fadeIn {
        -webkit-animation-name: fadeIn;
        animation-name: fadeIn;
    }

    .fadeOut {
        -webkit-animation-name: fadeOut;
        animation-name: fadeOut;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }
</style>
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Enrollment</h3>



        <div class="mt-8 mb-8">
            <div>
                <button onclick="openModal()" class='bg-indigo-500 text-white p-2 rounded text-l font-bold'>Tambah Enrollment</button>
            </div>
            {{-- @if(session('eror'))
                <div class="mt-8 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                    <strong class="mr-1">Hey</strong> Email sudah ada
                    <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                        <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
                    </button>
                </div>
            @endif --}}
        
            <div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
                style="background: rgba(0,0,0,.7);">
                <div
                    class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    <div class="modal-content py-4 text-left px-6">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl font-bold">Tambah Enrollment</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <!--Body-->
                        <form action="{{route('enrollment.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="my-5">
                                <div class="flex flex-col w-full max-w-sm mx-auto p-4 bg-white">
                                    <div class="flex flex-col mb-4">
                                        <label for="name"
                                            class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                            Mahasiswa
                                        </label>
                                
                                        <div class="relative">
                                
                                            
                                
                                            <select name="mahasiswa_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                                @foreach ($mahasiswa as $item)
                                                    <option value="{{$item->id}}">{{$item->user->name}} - {{$item->user->username}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="flex flex-col mb-4">
                                        <label for="name"
                                            class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                            Kelas
                                        </label>
                                
                                        <div class="relative">
                                
                                            
                                
                                            <select name="kelas_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                                @foreach ($kelas as $item)
                                                    <option value="{{$item->id}}">{{$item->name}} ({{$item->asistant->matkul->name}})</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    
                                    
                                    
                                </div>
                            </div>
                            <!--Footer-->
                            <div class="flex justify-end pt-2">
                                <button
                                    class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300">Cancel</button>
                                <button type="submit"
                                    class="focus:outline-none px-4 bg-indigo-500 p-3 ml-3 rounded-lg text-white hover:bg-indigo-400">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
            

            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1">Nama</th>
                        <th data-priority="2">NIM</th>
                        <th data-priority="3">Kelas</th>
                        <th data-priority="4">Matkul</th>
                        <th data-priority="5">Aksi</th>
                    </tr>
                </thead>
            </table>


        </div>

    </div>
</main>
@section('script')
<script>
    $(document).ready(function(){
      var id = $(this).attr('id');
     $('#example').DataTable({
      processing: true,
      stateSave: true,
      serverSide: true,
      ajax:{
       url: "{{ route('enrollment.index') }}",
      },
      columns:[
       {
        data: 'mahasiswa.user.name',
        name: 'mahasiswa.user.name'
       },
       {
        data: 'mahasiswa.user.username',
        name: 'mahasiswa.user.username'
       },
       {
        data: 'kelas.name',
        name: 'kelas.name'
       },
       {
        data: 'kelas.asistant.matkul.name',
        name: 'kelas.asistant.matkul.name'
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
@endsection