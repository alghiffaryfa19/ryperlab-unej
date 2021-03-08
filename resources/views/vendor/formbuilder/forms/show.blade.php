@extends('formbuilder::layout')
@section('title','Kuesioner')

@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Form Preview for '{{ $form->name }}' 
</span> 
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div id="fb-render"></div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h5 class="card-title">
                            Details 
                            
                            <button class="btn btn-primary btn-sm clipboard float-right" data-clipboard-text="{{ route('formbuilder::form.render', $form->identifier) }}" data-message="Copied" data-original="Copy Form URL" title="Copy form URL to clipboard">
                                <i class="fa fa-clipboard"></i> Copy Form URL
                            </button> 
                        </h5>
                    </div>
    
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Public URL: </strong> 
                            <a href="{{ route('formbuilder::form.render', $form->identifier) }}" class="float-right" target="_blank">
                                {{$form->identifier}}
                            </a>
                        </li>
                        <li class="list-group-item">
                            <strong>Visibility: </strong> <span class="float-right">{{ $form->visibility }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Allows Edit: </strong> 
                            <span class="float-right">{{ $form->allowsEdit() ? 'YES' : 'NO' }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Owner: </strong> <span class="float-right">{{ $form->user->name }}</span>
                        </li>
                         <li class="list-group-item">
                            <strong>Current Submissions: </strong> 
                            <span class="float-right">{{ $form->submissions_count }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Last Updated On: </strong> 
                            <span class="float-right">
                                {{ $form->updated_at->toDayDateTimeString() }}
                            </span>
                        </li>
                        <li class="list-group-item">
                            <strong>Created On: </strong> 
                            <span class="float-right">
                                {{ $form->created_at->toDayDateTimeString() }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push(config('formbuilder.layout_js_stack', 'scripts'))
    <script type="text/javascript">
        window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
    </script>
    <script src="{{ asset('vendor/formbuilder/js/preview-form.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}" defer></script>
@endpush

