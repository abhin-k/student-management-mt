@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Students</div>
                <div class="card-body">
                    @include('partials.flash-message')
                    <div class="table-responsive">
                        <a class="btn btn-primary float-end mb-4" href="{{ route('students.create') }}">Add New Student</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Age</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Reporting Teacher</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->age }}</td>
                                    <td>{{ strtoupper($student->gender) }} </td>
                                    <td>{{ $student->teacher->name }}</td>
                                    <td>
                                        <a href="{{ route('students.edit', $student) }}">Edit</a>
                                        <a href="#" onclick="var result = confirm('Are you sure you want to delete this record?');if(result){event.preventDefault();document.getElementById('delete-form-{{$student->id}}').submit();}">
                                            Delete
                                        </a>

                                        <form id="delete-form-{{$student->id}}" action="{{ route('students.destroy', $student)}}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        <p class="text-center">No records found!</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection