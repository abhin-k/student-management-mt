@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Marks</div>
                <div class="card-body">
                    @include('partials.flash-message')

                    <div class="table-responsive">
                        <a class="btn btn-primary float-end mb-4" href="{{ route('marks.create') }}">Add Marks</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Maths</th>
                                    <th scope="col">Science</th>
                                    <th scope="col">History</th>
                                    <th scope="col">Term</th>
                                    <th scope="col">Total Marks</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($marks as $mark)
                                <tr>
                                    <td>{{ $mark->id }}</td>
                                    <td>{{ $mark->student->name }}</td>
                                    <td>{{ $mark->maths }}</td>
                                    <td>{{ $mark->science }} </td>
                                    <td>{{ $mark->history }}</td>
                                    <td>{{ ucwords($mark->term) }}</td>
                                    <td>{{ $mark->total }}</td>
                                    <td>{{ $mark->created_at }}</td>
                                    <td>
                                        <a href="{{ route('marks.edit', $mark) }}">Edit</a>
                                        <a href="#" onclick="var result = confirm('Are you sure you want to delete this record?');if(result){event.preventDefault();document.getElementById('delete-form-{{$mark->id}}').submit();}">
                                            Delete
                                        </a>

                                        <form id="delete-form-{{$mark->id}}" action="{{ route('marks.destroy', $mark)}}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9">
                                        <p class="text-center">No records found!</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $marks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection