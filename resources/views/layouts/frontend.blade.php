<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="Dakon Digital Studio">
    <meta name="author" content="CV. Energi Teknologi Muda">
    <script src="{{asset('superadmin/js/jquery.min.js')}}"></script>
    <link rel='stylesheet' href='https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.css'>
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <style>
        .modal {
          transition: opacity 0.25s ease;
        }
        body.modal-active {
          overflow-x: hidden;
          overflow-y: visible !important;
        }
      </style>
    <style>
        /*Overrides for Tailwind CSS */
        /*Form fields*/
        
        .dataTables_wrapper select,
        .dataTables_wrapper .dataTables_filter input {
            color: #4a5568;
            /*text-gray-700*/
            padding-left: 1rem;
            /*pl-4*/
            padding-right: 1rem;
            /*pl-4*/
            padding-top: .5rem;
            /*pl-2*/
            padding-bottom: .5rem;
            /*pl-2*/
            line-height: 1.25;
            /*leading-tight*/
            border-width: 2px;
            /*border-2*/
            border-radius: .25rem;
            border-color: #edf2f7;
            /*border-gray-200*/
            background-color: #edf2f7;
            /*bg-gray-200*/
        }
        /*Row Hover*/
        
        table.dataTable.hover tbody tr:hover,
        table.dataTable.display tbody tr:hover {
            background-color: #ebf4ff;
            /*bg-indigo-100*/
        }
        /*Pagination Buttons*/
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }
        /*Pagination Buttons - Current selected */
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #667eea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }
        /*Pagination Buttons - Hover */
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #667eea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }
        /*Add padding to bottom border */
        
        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0;
            /*border-b-1 border-gray-300*/
            margin-top: 0.75em;
            margin-bottom: 0.75em;
        }
        /*Change colour of responsive icon*/
        
        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
            background-color: #667eea !important;
            /*bg-indigo-500*/
        }
    </style>
    <style>
      .demo-gallery > ul {
  margin-bottom: 0;
  padding-left: 15px;
  }

  .demo-gallery > ul > li {
    margin-bottom: 15px;
    width: 180px;
    display: inline-block;
    margin-right: 15px;
    list-style: outside none none;
  }

  .demo-gallery > ul > li a {
    border: 3px solid #FFF;
    border-radius: 3px;
    display: block;
    overflow: hidden;
    position: relative;
    float: left;
  }

  .demo-gallery > ul > li a > img {
    -webkit-transition: -webkit-transform 0.15s ease 0s;
    -moz-transition: -moz-transform 0.15s ease 0s;
    -o-transition: -o-transform 0.15s ease 0s;
    transition: transform 0.15s ease 0s;
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
    height: 100%;
    width: 100%;
  }

  .demo-gallery > ul > li a:hover > img {
    -webkit-transform: scale3d(1.1, 1.1, 1.1);
    transform: scale3d(1.1, 1.1, 1.1);
  }

  .demo-gallery > ul > li a:hover .demo-gallery-poster > img {
    opacity: 1;
  }

  .demo-gallery > ul > li a .demo-gallery-poster {
    background-color: rgba(0, 0, 0, 0.1);
    bottom: 0;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    -webkit-transition: background-color 0.15s ease 0s;
    -o-transition: background-color 0.15s ease 0s;
    transition: background-color 0.15s ease 0s;
  }

  .demo-gallery > ul > li a .demo-gallery-poster > img {
    left: 50%;
    margin-left: -10px;
    margin-top: -10px;
    opacity: 0;
    position: absolute;
    top: 50%;
    -webkit-transition: opacity 0.3s ease 0s;
    -o-transition: opacity 0.3s ease 0s;
    transition: opacity 0.3s ease 0s;
  }

  .demo-gallery > ul > li a:hover .demo-gallery-poster {
    background-color: rgba(0, 0, 0, 0.5);
  }

  .demo-gallery .justified-gallery > a > img {
    -webkit-transition: -webkit-transform 0.15s ease 0s;
    -moz-transition: -moz-transform 0.15s ease 0s;
    -o-transition: -o-transform 0.15s ease 0s;
    transition: transform 0.15s ease 0s;
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
    height: 100%;
    width: 100%;
  }

  .demo-gallery .justified-gallery > a:hover > img {
    -webkit-transform: scale3d(1.1, 1.1, 1.1);
    transform: scale3d(1.1, 1.1, 1.1);
  }

  .demo-gallery .justified-gallery > a:hover .demo-gallery-poster > img {
    opacity: 1;
  }

  .demo-gallery .justified-gallery > a .demo-gallery-poster {
    background-color: rgba(0, 0, 0, 0.1);
    bottom: 0;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    -webkit-transition: background-color 0.15s ease 0s;
    -o-transition: background-color 0.15s ease 0s;
    transition: background-color 0.15s ease 0s;
  }

  .demo-gallery .justified-gallery > a .demo-gallery-poster > img {
    left: 50%;
    margin-left: -10px;
    margin-top: -10px;
    opacity: 0;
    position: absolute;
    top: 50%;
    -webkit-transition: opacity 0.3s ease 0s;
    -o-transition: opacity 0.3s ease 0s;
    transition: opacity 0.3s ease 0s;
  }

  .demo-gallery .justified-gallery > a:hover .demo-gallery-poster {
    background-color: rgba(0, 0, 0, 0.5);
  }

  .demo-gallery .video .demo-gallery-poster img {
    height: 48px;
    margin-left: -24px;
    margin-top: -24px;
    opacity: 0.8;
    width: 48px;
  }

  .demo-gallery.dark > ul > li a {
    border: 3px solid #04070a;
  }
    </style>
    <title>@yield('title') - RyperLab</title>
</head>
<body>
    <nav x-data="{ open: false }" class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
          <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
              <!-- Mobile menu button-->
              <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" x-bind:aria-expanded="open">
                <span class="sr-only">Open main menu</span>
                <!-- Icon when menu is closed. -->
                <svg x-state:on="Menu open" x-state:off="Menu closed" :class="{ 'hidden': open, 'block': !open }" class="block h-6 w-6" x-description="Heroicon name: menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
                          <!-- Icon when menu is open. -->
                          <svg x-state:on="Menu open" x-state:off="Menu closed" :class="{ 'hidden': !open, 'block': open }" class="hidden h-6 w-6" x-description="Heroicon name: x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
              </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
              <div class="flex-shrink-0 flex items-center">
                <a href="/"><img class="block lg:hidden h-10 w-auto" src="{{asset('ryperlab/img/logo.png')}}" alt="Workflow"></a>
                <a href="/"><img class="hidden lg:block h-10 w-auto" src="{{asset('ryperlab/img/logo.png')}}" alt="Workflow"></a>
              </div>
              <div class="hidden sm:block sm:ml-6">
                <div class="flex space-x-4">
                  <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                  <a href="{{route('ryperlabs')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About Us</a>
                  <a href="{{route('staff')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Staff</a>
                  <a href="{{route('blog')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Blog</a>
                  <a href="{{route('projects_frontend')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Projects</a>
                  <a href="{{route('galeries')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Gallery</a>
                  <a href="{{route('contacts')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contacts</a>
                  <a href="{{route('sertifikat')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">E-Certificate</a>
                </div>
              </div>
            </div>
            @auth
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
    
              <a href="{{route('login')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
            </div>
            @else
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
              <a href="{{route('login')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Sign In</a>
            </div>

            @endauth
          </div>
        </div>
    
        <div x-description="Mobile menu, toggle classes based on menu state." x-state:on="Menu open" x-state:off="Menu closed" :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
          <div class="px-2 pt-2 pb-3 space-y-1">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="{{route('ryperlabs')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">About Us</a>
            <a href="{{route('staff')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Staff</a>
            <a href="{{route('blog')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Blog</a>
            <a href="{{route('projects_frontend')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Projects</a>
            <a href="{{route('galeries')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Gallery</a>
            <a href="{{route('contacts')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Contacts</a>
            <a href="{{route('sertifikat')}}" class="text-blue-900 hover:bg-blue-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">E-Certificate</a>
          </div>
        </div>
      </nav>
      @yield('content')
      <footer class="bg-gray-50 text-gray-600 px-6 lg:px-8 py-12">
        <div class="max-w-screen-xl mx-auto grid md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-x-8">
          <div>
            <img class="h-20" src="{{asset('ryperlab/img/logo.png')}}" alt="Workflow">
            <p class="mt-4">Laboratorium Rekayasa Perangkat Lunak, Fakultas Ilmu Komputer, Universitas Jember</p>
          </div>
          <div>
            <h5 class="text-xl font-semibold text-gray-700">Get Started</h5>
            <nav class="mt-4">
              <ul class="space-y-2">
                <li>
                  <a href="{{route('ryperlabs')}}" class="font-normal text-base hover:text-gray-400">About Us</a>
                </li>
                <li>
                  <a href="{{route('staff')}}" class="font-normal text-base hover:text-gray-400">Staff</a>
                </li>
                <li>
                  <a href="{{route('blog')}}" class="font-normal text-base hover:text-gray-400">Blog</a>
                </li>
                <li>
                  <a href="{{route('projects_frontend')}}" class="font-normal text-base hover:text-gray-400">Projects</a>
                </li>
                <li>
                  <a href="{{route('galeries')}}" class="font-normal text-base hover:text-gray-400">Gallery</a>
                </li>
                <li>
                  <a href="{{route('contacts')}}" class="font-normal text-base hover:text-gray-400">Contacts</a>
                </li>
                <li>
                  <a href="{{route('sertifikat')}}" class="font-normal text-base hover:text-gray-400">E-Certificate</a>
                </li>
              </ul>
            </nav>
          </div>
          <div>
            <h5 class="text-xl font-semibold text-gray-700">Contact</h5>
            <div class="space-y-4 md:space-y-6 mt-4">
              <div class="flex items-start space-x-4">
                <div>
                  <svg class="w-6 h-6 mt-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div class="flex-1">
                  <address class="not-italic">
                    Lab RPL<br>
                    Faculty of Computer Science<br>
                    University of Jember
                  </address>
                </div>
              </div>
              <div class="flex items-start space-x-4">
                <div>
                  <svg class="w-6 h-6 mt-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div class="flex-1">
                  <a href="#" class="hover:text-gray-400">ryperdev@gmail.com</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="max-w-screen-xl mx-auto flex flex-col items-center mt-16">
          <div class="text-sm mt-4">
            &copy; 2021 All rights reserved. RyperLab
          </div>
        </div>
      </footer>
      @yield('script')
</body>
</html>