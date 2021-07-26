@extends('layouts.global')

@section('title')
    Create Category
@endsection

@section('content')
    
    <div class="col-md-8">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('categories.store') }}" class="bg-white shadow-sm p-3" enctype="multipart/form-data" method="POST">

            @csrf

            <label for="">Category Name</label><br>
            <input type="text" class="form-control {{ $errors->first('name') ? "is-invalid" : "" }}" name="name" value="{{ old('name') }}">
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            <br>

            <label for="">Category Image</label>
            <input type="file" class="form-control {{ $errors->first('image') ? "is-invalid" : "" }}" name="image">
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
            <br>
            
            <input type="submit" class="btn btn-primary" value="Save">

        </form>
    </div>

@endsection