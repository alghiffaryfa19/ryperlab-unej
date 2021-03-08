@extends('formbuilder::mahasiswa')
@section('title',$form->name)

@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{ $form->name }}
</span> 
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if (cekForm())
                    Sudah Mengisi
                @else
                <form action="{{ route('formbuilder::form.submit', $form->identifier) }}" method="POST" id="submitForm" enctype="multipart/form-data">
                    @csrf
                    
                    <div id="fb-render"></div>
                    <div class="flex justify-center pt-2">
                        <button data-form="submitForm" data-message="Submit your entry for '{{ $form->name }}'?" type="submit"
                            class="confirm-form focus:outline-none px-4 bg-indigo-500 p-3 ml-3 rounded-lg text-white hover:bg-indigo-400">Save</button>
                    </div>
                </form>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection
@push(config('formbuilder.layout_js_stack', 'scripts'))
    <script type="text/javascript">
        window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
    </script>
    <script src="{{ asset('vendor/formbuilder/js/render-form.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}" defer></script>
@endpush
