@extends('layouts.global')

@section('footer-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $('#categories').select2({
            ajax: {
                url: 'http://localhost/projek/larashop/ajax/categories/search', 
                processResults: function(data){
                    return {
                        results: data.map(function(item){return {id: item.id, text:item.name} })
                    }
                }
            }
        });
    </script>
@endsection

@section('title')
    Create Book
@endsection

@section('content')
    
    <div class="row">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('books.store') }}" class="shadow-sm p-3 bg-white" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="title">Title</label><br>
                <input type="text" name="title" placeholder="Book Title" class="form-control {{ $errors->first('title') ? :"is-invalid" : "" }}" value="{{ old('title') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
                <br>

                <label for="cover">Cover</label>
                <input type="file" name="cover" class="form-control {{ $errors->first('cover') ? "is-invalid" : "" }}" value="{{ old('cover') }}">
                <div class="invalid-feedback">
                    {{ $errors->first("cover") }}
                </div>
                <br>

                <label for="description">Description</label><br>
                <textarea name="description" id="description" placeholder="Give a description about this book" class="form-control {{ $errors->first('description') ? "is-invalid" }}">{{ old('description') }}</textarea>
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}
                </div>
                <br>

                <label for="categories">Categories</label><br>
                <select name="categories[]" id="categories" multiple class="form-control"></select>
                <br><br>

                <label for="stock">Stock</label><br>
                <input type="number" id="stock" name="stock" min="0" value="{{ old('stock') ? old('stock') : "0" }}" class="form-control {{ $errors->first('stock') ? "is-invalid" : "" }}">
                <div class="invalid-feedback">
                    {{ $errors->first('stock') }}
                </div>
                <br>

                <label for="author">Author</label><br>
                <input type="text" name="author" id="author" placeholder="Book Author" class="form-control {{ $errors->first('author') ? "is-invalid" ? "" }}" value="{{ old('author') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('author') }}
                </div>
                <br>

                <label for="publiser">Publisher</label><br>
                <input type="text" name="publisher" id="publisher" placeholder="Book Publisher" class="form-control {{ $errors->first('publisher') ? "is-invalid" : "" }}" value="{{ old('publisher') }}">
                <div class="invalid-feedback">
                    {{ $errors->first('publisher') }}
                </div>
                <br>

                <label for="price">Price</label><br>
                <input type="number" name="price" id="price" placeholder="Book Price" class="form-control {{ $errors->first('number') ? "is-invalid" : ""}}" value="{{ old('price') }}">
                <br>

                <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
                <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as Draft</button>
            </form>
        </div>
    </div>

@endsection

