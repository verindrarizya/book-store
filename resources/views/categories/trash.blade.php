@extends('layouts.global')

@section('title')
    Trashed Categories
@endsection

@section('content')
    
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('categories.index') }}">
                <div class="input-group">
                    <input type="text" placeholder="Filter by Category Name" value="{{ Request::get('name') }}" name= "name" class="form-control">
                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">Published</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.trash') }}" class="nav-link active">Trash</a>
                </li>
            </ul>
        </div>
    </div>

    <hr class="my-3">

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                @if ($category->image)
                                    <img src="{{ asset('public/storage/'.$category->image) }}" alt="Image of Category" width="48px">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('categories.restore', [$category->id]) }}" class="btn btn-sm btn-success">Restore</a>
                                <form action="{{ route('categories.delete-permanent', [$category->id] )}}" method="POST"  class="d-inline" onsubmit="return confirm('Delete this category permanently?')">
                                    @csrf

                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
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