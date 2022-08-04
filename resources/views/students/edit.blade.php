@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Student</div>
                <div class="card-body">
                    <form method="post" action="{{ route('students.update', $student) }}">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $student->name) }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" class="form-control @error('age') is-invalid @enderror" id="age" min="0" max="100" value="{{ old('age', $student->age) }}">
                            @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                                <option selected disabled>Select Gender</option>
                                <option value="m" @if (old('gender', $student->gender) == 'm') selected @endif>Male</option>
                                <option value="f" @if (old('gender', $student->gender) == 'f') selected @endif>Female</option>
                            </select>
                            @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="teacher_id" class="form-label">Reporting Teacher</label>
                            <select class="form-select @error('teacher_id') is-invalid @enderror" name="teacher_id">
                                <option selected disabled>Select Teacher</option>
                                @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"  @if (old('teacher_id', $student->teacher_id) == $teacher->id) selected @endif>{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection