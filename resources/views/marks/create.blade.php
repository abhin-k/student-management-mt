@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Mark</div>
                <div class="card-body">
                    <form method="post" action="{{ route('marks.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Student</label>
                            <select class="form-select @error('student_id') is-invalid @enderror" name="student_id">
                                <option selected disabled>Select Student</option>
                                @foreach ($students as $student)
                                <option value="{{ $student->id }}"  @if (old('student_id') == $student->id) selected @endif>{{ $student->name }}</option>
                                @endforeach
                            </select>
                            @error('student_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="term" class="form-label">Term</label>
                            <select class="form-select @error('term') is-invalid @enderror" name="term">
                                <option selected disabled>Select Term</option>
                                <option value="one" @if (old('term') == 'one') selected @endif>One</option>
                                <option value="two" @if (old('term') == 'two') selected @endif>Two</option>
                            </select>
                            @error('term')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="maths" class="form-label">Marks: Maths</label>
                            <input type="number" name="maths" class="form-control @error('maths') is-invalid @enderror" id="maths" value="{{ old('maths') }}">
                            @error('maths')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="science" class="form-label">Marks: Science</label>
                            <input type="number" name="science" class="form-control @error('science') is-invalid @enderror" id="science" value="{{ old('science') }}">
                            @error('science')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="history" class="form-label">Marks: History</label>
                            <input type="number" name="history" class="form-control @error('history') is-invalid @enderror" id="history" value="{{ old('history') }}">
                            @error('history')
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