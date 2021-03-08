@extends('layouts.mahasiswa')
@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Member Project
</span> 
@if (\Carbon\Carbon::now()->isBefore($project->deadline))  
<button style="float: right" onclick="openModal()" class='bg-blue-500 text-white p-2 rounded text-l font-bold'>Add Member</button>

<div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
    style="background: rgba(0,0,0,.7);">
    <div
        class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Add Member</p>
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
            <form action="{{ route('member_store', [$kelas->slug,$project->id,$assignment->id]) }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="my-5">
                    <div class="flex flex-col w-full max-w-sm mx-auto p-4 bg-white">
                        <div class="flex flex-col mb-4">
                            <label for="name"
                                class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                               NIM
                            </label>
                    
                            <div class="relative">
                
                    
                                <input id="name"
                                    name="nim"
                                    type="number"
                                    placeholder="NIM"
                                    value=""
                                    class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                    
                            </div>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="name"
                                class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                               Nama
                            </label>
                    
                            <div class="relative">
                
                    
                                <input id="name"
                                    name="name"
                                    type="text"
                                    placeholder="Nama"
                                    value=""
                                    class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                    
                            </div>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="name"
                                class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                               Role
                            </label>
                    
                            <div class="relative">
                                {{-- <select name="role" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                    <option @if ($user->role == 1) selected @endif value="1">Admin</option>
                                    <option @if ($user->role == 2) selected @endif value="2">Asisten</option>
                                    <option @if ($user->role == 3) selected @endif value="3">Mahasiswa</option>
                                </select> --}}
                                <select name="role" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                    <option value="Project Manager">Project Manager</option>
                                    <option value="System Analyst">System Analyst</option>
                                    <option value="Designer">Designer</option>
                                    <option value="Developer">Developer</option>
                                    <option value="Tester">Tester</option>
                                    <option value="Other">Other</option>
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
@endif
@endsection
@if (\Carbon\Carbon::now()->isBefore($project->deadline))  
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">NIM</th>
                            <th data-priority="2">Name</th>
                            <th data-priority="3">Role</th>
                            <th data-priority="4">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@else
<h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-red-500">Waktu Habis</h1>
@endif
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
       url: "{{ route('member_project', [$kelas->slug,$project->id,$assignment->id]) }}",
      },
      columns:[
       {
        data: 'nim',
        name: 'nim'
       },
       {
        data: 'name',
        name: 'name'
       },
       {
        data: 'role',
        name: 'role'
       },
       {
        data: 'edit',
        name: 'edit',
        searchable: false,
        orderable: false
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