@extends('layouts.admin')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Asisten') }}
</span>   
<button style="float: right" onclick="openModal()" class='bg-blue-500 text-white p-2 rounded text-l font-bold'>Add Asisten</button>
@if(session('eror'))
    <div class="mt-8 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
        <strong class="mr-1">Hey</strong> Email sudah ada
        <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
            <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
        </button>
    </div>
@endif

<div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
    style="background: rgba(0,0,0,.7);">
    <div
        class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Add User</p>
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
            <form action="{{route('asistant.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="my-5">
                    <div class="flex flex-col w-full max-w-sm mx-auto p-4 bg-white">
                        <div class="flex flex-col mb-4">
                            <label for="name"
                                class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                Akun
                            </label>
                    
                            <div class="relative">
                    
                                
                    
                                <select name="user_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                    @foreach ($user as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        {{-- <div class="flex flex-col mb-4">
                            <label for="name"
                                class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                Mata Kuliah
                            </label>
                    
                            <div class="relative">
                    
                                

                                <select name="matkul_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                    @foreach ($matkul as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                    
                            </div>
                        </div> --}}
                        <div class="flex flex-col mb-4">
                            <label for="name"
                                class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                Divisi
                            </label>
                    
                            <div class="relative">
                    
                                

                                <select name="divisi_id" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                    @foreach ($divisi as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                    
                            </div>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="name"
                                class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                Foto (Required)
                            </label>
                    
                            <div class="relative">
                    
                    
                                <input id="name"
                                    name="foto"
                                    type="file"
                                    placeholder="Email"
                                    value=""
                                    class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                    
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
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Asistant</th>
                            <th data-priority="2">Divisi</th>
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
       url: "{{ route('asistant.index') }}",
      },
      columns:[
       {
        data: 'user.name',
        name: 'user.name'
       },
       {
        data: 'divisi.name',
        name: 'divisi.name'
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