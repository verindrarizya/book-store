@extends('layouts.global')

@section('title')
    Trashed Books
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('books.index') }}">
                <div class="input-group">
                    <input type="text" name="keyword" value="{{ Request::get('keyword') }}" class="form-control" placeholder="Filter by title">
                    <div class="input-group-append">
                        <input type="submit" value="filter" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="{{ route('books.index') }}" class="nav-link {{ Request::get('status') == NULL && Request::path() == 'books' ? 'active' : '' }}">All</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('books.index', ['status' => 'publish']) }}" class="nav-link {{ Request::get('status') == 'publish' ? 'active' : '' }}">Publish</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('books.index', ['status' => 'draft']) }}" class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}">Draft</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('books.trash') }}" class="nav-link {{ Request::path() == 'books/trash' ? 'active' : '' }}">Trash</a>
                </li>
            </ul>
        </div>
    </div>

    <hr class="my-3">

    <div class="row">

        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td><b>Cover</b></td>
                        <td><b>Title</b></td>
                        <td><b>Author</b></td>
                        <td><b>Categories</b></td>
                        <td><b>Stock</b></td>
                        <td><b>Price</b></td>
                        <td><b>Action</b></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>
                                @if ($book->cover)
                                    <img src="{{ asset('public/storage/'.$book->cover) }}" alt="Book Cover" width="96px">
                                @endif
                            </td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>
                                <ul class="pl-3">
                                    @foreach ($book->categories as $category)
                                        <li>{{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $book->stock }}</td>
                            <td>{{ $book->price }}</td>
                            <td>
                                <form action="{{ route('books.restore', [$book->id]) }}" class="d-inline" method="POST">
                                    @csrf
                                    <input type="submit" value="Restore" class="btn btn-success btn-sm">
                                </form>
                                <form action="{{ route('books.delete-permanent', [$book->id]) }}" method="POST" onsubmit="return confirm('Delete this book permanently?')" class="d-inline">
                                    @csrf

                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10">{{ $books->appends(Request::all())->links() }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection