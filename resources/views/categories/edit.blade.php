@extends('layouts.global')

@section('title')
    Edit Category
@endsection

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>        
    @endif

    <div class="col-md-8">
        <form action="{{ route('categories.update', [$category->id]) }}" class="bg-white shadow-sm p-3" enctype="multipart/form-data" method="POST">
            @csrf

            <input type="hidden" value="PUT" name="_method">

            <label for="">Category Name</label>
            <br>
            <input type="text" value="{{ old('name') ? old('name') : $category->name }}"  name="name" class="form-control {{ $errors->first('name') ? "is-invalid" : "" }}">
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            <br><br>

            <label for="">Category Slug</label>
            <br>
            <input type="text" value="{{ old('slug') ? old('slug') : $category->slug }}" name="slug" class="form-control {{ $errors->first('slug') ? "is-invalid" : "" }}">
            <div class="invalid-feedback">
                {{ $errors->first('slug') }}
            </div>
            <br><br>

            <label for="">Category Image</label>
            @if ($category->image)
                <span>Current Image</span>
                <img src="{{ asset('public/storage/'.$category->image) }}" alt="Current Category Image" width="120px">
                <br><br>
            @endif
            <input type="file" class="form-control {{ $errors->first('image') ? "is-invalid" : "" }}" name="image">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
            <br><br>

            <input type="submit" value="Update" class="btn btn-primary">

        </form>
    </div>

@endsection