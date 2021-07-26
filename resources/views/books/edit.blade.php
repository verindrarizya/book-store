@extends('layouts.global')

@section('title')
    Edit Book
@endsection

@section('content')
    
    <div class="row">
        <div class="col-md-8">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('books.update', [$book->id]) }}" method="POST" enctype="multipart/form-data" class="p-3 shadow-sm bg-white">
                @csrf

                <input type="hidden" name="_method" value="PUT">

                <label for="title">Title</label><br>
                <input type="text" name="title" value="{{ $book->title }}" placeholder="Book title" class="form-control">
                <br>

                <label for="cover">Cover</label><br>
                <small class="text-muted">Current Cover</small><br>
                @if ($book->cover)
                    <img src="{{ asset('public/storage/'.$book->cover) }}" alt="Current Cover Image" width="96px">
                @endif
                <br><br>
                <input type="file" name="cover" class="form-control">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                <br><br>

                <label for="slug">Slug</label><br>
                <input type="text" value="{{ $book->slug }}" name="slug" placeholder="enter-a-slug" class="form-control">
                <br>

                <label for="description">Description</label><br>
                <textarea name="description" id="description" class="form-control">{{ $book->description }}</textarea>
                <br>

                <label for="categories">Categories</label>
                <select name="categories[]" id="categories" multiple class="form-control"></select>
                <br><br>

                <label for="stock">Stock</label><br>
                <input type="text" placeholder="Stock" id="stock" name="stock" value="{{ $book->stock }}" class="form-control">
                <br>

                <label for="author">Author</label><br>
                <input type="text" placeholder="Author" value="{{ $book->author }}" name="author" id="author" class="form-control">
                <br>

                <label for="publisher">Publisher</label><br>
                <input type="text" placeholder="Publisher" name="publisher" id="publisher" value="{{ $book->publisher }}" class="form-control">
                <br>

                <label for="price">Price</label><br>
                <input type="text" name="price" id="price" placeholder="Price" value="{{ $book->price }}" class="form-control">
                <br>

                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="PUBLISH" {{ $book->status == 'PUBLISH' ? 'selected' : '' }}>PUBLISH</option>
                    <option value="DRAFT" {{ $book->status == 'DRAFT' ? 'selected' : '' }}>DRAFT</option>
                </select>
                <br>

                <button class="btn btn-primary" value="PUBLISH">Update</button>
            </form>
        </div>
    </div>

@endsection

@section('footer-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $('#categories').select2({
            ajax: {
                url: 'http://localhost/projek/larashop/ajax/categories/search',
                processResults: function(data){
                    return {
                        results: data.map(function(item){return {id: item.id, text: item.name} })
                    }
                }
            }
        });

        var categories = {!! $book->categories !!}

            categories.forEach(function(category){
                var option = new Option(category.name, category.id, true, true);
                $('#categories').append(option).trigger('change');
            });
    </script>
@endsection