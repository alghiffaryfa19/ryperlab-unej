@extends('formbuilder::asisten')

@section('content')
@section('header')
<span class="font-semibold text-xl text-gray-800 leading-tight">
    {{ $pageTitle }}
</span>   
@endsection
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Name</th>
                            <th data-priority="2">Aksi</th>
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
       url: "{{ route('formbuilders::sub.asisten', [$kelas->id,$form->id]) }}",
      },
      columns:[
       {
        data: 'user.name',
        name: 'user.name'
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
@endsection











{{-- <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if($submissions->count())
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">#</th>
                            <th class="2">Aksi</th>
                                    @foreach($form_headers as $header)
                                        <th>{{ $header['label'] ?? title_case($header['name']) }}</th>
                                    @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $submission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $submission->user->name ?? 'n/a' }}</td>
                                <td>
                                    <a href="{{ route('formbuilders::forms.submissions.show', [$form, $submission->id]) }}" class="btn btn-primary btn-sm" title="View submission">
                                        <i class="fa fa-eye"></i> View
                                    </a> 

                                    <form action="{{ route('formbuilder::forms.submissions.destroy', [$form, $submission]) }}" method="POST" id="deleteSubmissionForm_{{ $submission->id }}" class="d-inline-block">
                                        @csrf 
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm confirm-form" data-form="deleteSubmissionForm_{{ $submission->id }}" data-message="Delete this submission?" title="Delete submission">
                                            <i class="fa fa-trash-o"></i> 
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($submissions->hasPages())
                <div>{{ $submissions->links() }}</div>
                @endif
                @else
                <span class="font-semibold text-xl text-gray-800 leading-tight">
                    Belum ada data
                </span> 
                @endif
            </div>
        </div>
    </div>
</div>
@endsection --}}
