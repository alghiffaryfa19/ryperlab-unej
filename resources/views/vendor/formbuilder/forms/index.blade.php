@extends('formbuilder::layout')
@section('title','Kuesioner')

@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    Kuesioner
</span> 
<span style="float: right">
    <a href="{{ route('formbuilder::forms.create') }}" class='bg-blue-500 text-white p-2 rounded text-l font-bold'>Add Form</a>
    <a href="{{ route('formbuilder::my-submissions.index') }}" class='bg-blue-500 text-white p-2 rounded text-l font-bold'>My Submissions</a>
</span>
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if($forms->count())
                    <div class="table-responsive">
                        <table class="table table-bordered d-table table-striped pb-0 mb-0">
                            <thead>
                                <tr>
                                    <th class="five">#</th>
                                    <th>Name</th>
                                    <th>Kelas</th>
                                    <th class="ten">Visibility</th>
                                    <th class="fifteen">Allows Edit?</th>
                                    <th class="ten">Submissions</th>
                                    <th class="twenty-five">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($forms as $form)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $form->name }}</td>
                                        <td>{{ $form->kelas->name }}</td>
                                        <td>{{ $form->visibility }}</td>
                                        <td>{{ $form->allowsEdit() ? 'YES' : 'NO' }}</td>
                                        <td>{{ $form->submissions_count }}</td>
                                        <td>
                                            <a href="{{ route('formbuilder::forms.submissions.index', $form) }}" class="btn btn-primary btn-sm" title="View submissions for form '{{ $form->name }}'">
                                                <i class="fa fa-th-list"></i> Data
                                            </a>
                                            <a href="{{ route('formbuilder::forms.show', $form) }}" class="btn btn-primary btn-sm" title="Preview form '{{ $form->name }}'">
                                                <i class="fa fa-eye"></i> 
                                            </a> 
                                            <a href="{{ route('formbuilder::forms.edit', $form) }}" class="btn btn-primary btn-sm" title="Edit form">
                                                <i class="fa fa-pencil"></i> 
                                            </a> 
                                            <button class="btn btn-primary btn-sm clipboard" data-clipboard-text="{{ route('formbuilder::form.render', $form->identifier) }}" data-message="" data-original="" title="Copy form URL to clipboard">
                                                <i class="fa fa-clipboard"></i> 
                                            </button> 

                                            <form action="{{ route('formbuilder::forms.destroy', $form) }}" method="POST" id="deleteFormForm_{{ $form->id }}" class="d-inline-block">
                                                @csrf 
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm confirm-form" data-form="deleteFormForm_{{ $form->id }}" data-message="Delete form '{{ $form->name }}'?" title="Delete form '{{ $form->name }}'">
                                                    <i class="fa fa-trash-o"></i> 
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($forms->hasPages())
                        <div class="card-footer mb-0 pb-0">
                            <div>{{ $forms->links() }}</div>
                        </div>
                    @endif
                @else
                    <div class="card-body">
                        <h4 class="text-danger text-center">
                            No form to display.
                        </h4>
                    </div>  
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
