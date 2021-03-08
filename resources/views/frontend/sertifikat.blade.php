@extends('layouts.frontend')
@section('description','E-Certificate')
@section('title','E-Certificate')
@section('content')
<div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
    style="background: rgba(0,0,0,.7);">
    <div
        class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Validasi</p>
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
            <form action="{{route('validation')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="my-5">
                    <div class="flex flex-col w-full max-w-sm mx-auto p-4 bg-white">
                        <div class="flex flex-col mb-4">
                            <label for="name"
                                class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                Nomor Unik Sertifikat (Lihat Pojok Kiri Atas Pada Sertifikat)
                            </label>
                    
                            <div class="relative">
                    
                                <input id="name"
                                    name="nomor"
                                    type="text"
                                    placeholder="Nomor"
                                    value=""
                                    class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                    
                            </div>
                        </div>
                    </div>
                </div>
                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button
                        class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-lg text-black hover:bg-gray-300">Cancel</button>
                    <button type="submit"
                        class="focus:outline-none px-4 bg-indigo-500 p-3 ml-3 rounded-lg text-white hover:bg-indigo-400">Cari</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- BODY -->
    <section class="blog text-gray-700 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap w-full mb-10 flex-col items-center text-center">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">E-Certificate System</h1>
                <p class="lg:w-1/2 w-full leading-relaxed text-base">
                    Laboratorium Rekayasa Perangkat Lunak Fakultas Ilmu Komputer Universitas Jember
                </p>
            </div>
            <div id='recipients' class="p-8 mt-1 lg:mt-0 rounded shadow bg-white">
              @if(session('biasalah'))
                  <div class="mt-8 mb-8 block text-sm text-red-600 bg-red-200 border border-red-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                      <strong class="mr-1">Hey</strong> Validasi tidak cocok
                      <button type="button" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.remove();">
                          <span class="absolute top-0 bottom-0 right-0 text-2xl px-3 py-1 hover:text-red-900" aria-hidden="true" >×</span>
                      </button>
                  </div>
              @endif


                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th>No. HP</th>
                            <th>Nama</th>
                            <th>Instansi</th>
                            <th>E-Mail</th>
                            <th>Event</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                    </thead>
                    <tfoot>
                        <tr></tr>
                    </tfoot>

                </table>

              <button class="px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-gray-200 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                onclick="openModal()">Validasi</button>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function(){
      var id = $(this).attr('id');
     $('#example').DataTable({
      processing: true,
      serverSide: true,
      stateSave: true,
      ajax:{
       url: "{{ route('sertifikat') }}",
      },
      columns:[
        {
        data: 'identity',
        name: 'identity'
       },
       {
        data: 'nama',
        name: 'nama'
       },
       {
        data: 'instansi',
        name: 'instansi'
       },
       {
        data: 'email',
        name: 'email'
       },
       {
        data: 'sub_event.event.nama_event',
        name: 'sub_event.event.nama_event'
       },
       {
        data: 'sub_event.nama_sub_event',
        name: 'sub_event.nama_sub_event'
       },
       {
        data: 'unduh',
        name: 'unduh'
       }
       
      ]
     });
    });
    </script>
    <script>
        var openmodal = document.querySelectorAll('.modal-open')
        for (var i = 0; i < openmodal.length; i++) {
          openmodal[i].addEventListener('click', function(event){
            event.preventDefault()
            toggleModal()
          })
        }
        
        const overlay = document.querySelector('.modal-overlay')
       
        
        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
          closemodal[i].addEventListener('click', toggleModal)
        }
        
        document.onkeydown = function(evt) {
          evt = evt || window.event
          var isEscape = false
          if ("key" in evt) {
            isEscape = (evt.key === "Escape" || evt.key === "Esc")
          } else {
            isEscape = (evt.keyCode === 27)
          }
          if (isEscape && document.body.classList.contains('modal-active')) {
            toggleModal()
          }
        };
        
        
        function toggleModal () {
          const body = document.querySelector('body')
          const modal = document.querySelector('.modal')
          modal.classList.toggle('opacity-0')
          modal.classList.toggle('pointer-events-none')
          body.classList.toggle('modal-active')
        }
        
         
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