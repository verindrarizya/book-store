@extends('layouts.global')

@section('title')
    Category list
@endsection


@section('content')

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('categories.index') }}">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Filter by category name" name="name">
                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link active">Published</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.trash') }}" class="nav-link">Trash</a>
                </li>
            </ul>
        </div>
    </div>
    <hr class="my-3">

    @if (session('status'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    {{ session('status') }}
                </div>
            </div>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-12 text-right">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Slug</b></td>
                        <td><b>Image</b></td>
                        <td><b>Actions</b></td>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                @if ($category->image)
                                    <img src="{{ asset('public/storage/'.$category->image) }}" alt="Image Category" width="48px">
                                @else
                                    No image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', [$category->id]) }}" class="btn btn-info btn-sm">Edit</a>
                                <a href="{{ route('categories.show', [$category->id]) }}" class="btn btn-primary btn-sm">Show</a>
                                <form action="{{ route('categories.destroy', [$category->id]) }}" class="d-inline" method="POST" onsubmit="return confirm('Move Category to Trash?')">
                                    @csrf

                                    <input type="hidden" value="DELETE" name="_method">
                                    <input type="submit" value="Trash" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="10">{{ $categories->appends(Request::all())->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection