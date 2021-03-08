@extends('formbuilder::layout')
@section('title','Kuesioner')

@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Edit Kuesioner
</span> 
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('formbuilder::forms.update', $form) }}" method="POST" id="createFormForm" data-form-method="PUT">
                    @csrf 
                    @method('PUT')
                    <div class="flex flex-col mb-4">
                        <label for="name"
                            class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                            Name
                        </label>
                
                        <div class="relative">
                
                            <input id="name"
                                type="text"
                                placeholder="Nama" name="name" value="{{ old('name') ?? $form->name }}" required autofocus
                                class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6">
                            
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="name"
                            class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                            Visibility
                        </label>
                
                        <div class="relative">
                
                            <select name="visibility" id="visibility" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6" required="required">
                                <option value="">Select Form Visibility</option>
                                @foreach(jazmy\FormBuilder\Models\Form::$visibility_options as $option)
                                            <option value="{{ $option['id'] }}" @if($form->visibility == $option['id']) selected @endif>
                                                {{ $option['name'] }}
                                            </option>
                                        @endforeach
                            </select>

                            @if ($errors->has('visibility'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('visibility') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col mb-4" style="display: none;" id="allows_edit_DIV">
                        <label for="name"
                            class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                            Allow Submission Edit
                        </label>
                
                        <div class="relative">
                
                            <select name="allows_edit" id="allows_edit" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-6" required="required">
                                <option value="0" @if($form->allows_edit == 0) selected @endif>
                                    NO (submissions are final)
                                </option>
                                <option value="1" @if($form->allows_edit == 1) selected @endif>
                                    YES (allow users to edit their submissions)
                                </option>
                            </select>

                            @if ($errors->has('allows_edit'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('allows_edit') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <label for="name"
                            class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                            Kelas
                        </label>
                
                        <div class="relative">
                
                            
                
                            <select name="kelas_id" id="kelas" class="text-sm sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400 focus:outline-none py-2 pr-2 pl-12">
                                @foreach ($kelas as $item)
                                        @if($item->id==$form->kelas_id)
                                        <option value={{$item->id}} selected='selected' >{{$item->name}} ({{$item->asistant->matkul->name}})</option>
                                        @else
                                        <option value={{$item->id}}>{{$item->name}} ({{$item->asistant->matkul->name}})</option>
                                    @endif
                                    @endforeach
                            </select>

                        </div>
                    </div>
                    <div id="fb-editor" class="fb-editor"></div>

                    
                    
                    <div class="flex justify-center pt-2">
                        <button type="button"
                            class="fb-clear-btn focus:outline-none px-4 bg-red-500 p-3 ml-3 rounded-lg text-white hover:bg-red-400">Clear</button>
                        <button type="submit"
                            class="fb-save-btn focus:outline-none px-4 bg-blue-500 p-3 ml-3 rounded-lg text-white hover:bg-indigo-400">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push(config('formbuilder.layout_js_stack', 'scripts'))
    <script type="text/javascript">
        window.FormBuilder = window.FormBuilder || {}
        window.FormBuilder.form_roles = @json($form_roles);
        
        window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
    </script>
    <script src="{{ asset('vendor/formbuilder/js/create-form.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}" defer></script>
@endpush
