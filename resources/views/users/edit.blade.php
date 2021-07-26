@extends('layouts.global')

@section('title')
    Edit User
@endsection

@section('content')
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('users.update', [$user->id]) }}" class="bg-white shadow-sm p-3" method="POST" enctype="multipart/form-data">
            
            @csrf

            <input type="hidden" value="PUT" name="_method">

            <label for="name">Name</label>
            <input type="text" class="form-control {{ $errors->first('name') ? "is-invalid" : "" }}" value="{{ old('name') ? old('name') : $user->name }}" name="name" id="name" placeholder="Full Name">
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
            <br>

            <label for="username">Username</label>
            <input type="text" class="form-control" value="{{ $user->username }}" name="username" id="username" placeholder="Username" disabled>
            <br>

            <label for="">Status</label>
            <br>
                <input type="radio" value="ACTIVE" class="form-control" id="active" name="status" {{ $user->status == "ACTIVE" ? "checked" : "" }}>
                <label for="active">Active</label>

                <input type="radio" value="INACTIVE" class="form-control" id="inactive" name="status" {{ $user->status == "INACTIVE" ? "checked" : "" }}>
                <label for="inactive">Inactive</label>
                <br>
            <br>

            <label for="">Roles</label>
            <br>
                <input type="checkbox" name="roles[]" id="ADMIN" value="ADMIN" {{ in_array("ADMIN", json_decode($user->roles)) ? "checked" : "" }} class="form-control {{ $errors->first('roles') ? "is-invalid" : "" }}">
                <label for="ADMIN">Administrator</label>

                <input type="checkbox" name="roles[]" id="STAFF" value="STAFF" {{ in_array("STAFF", json_decode($user->roles)) ? "checked" : "" }} class="form-control {{ $errors->first('roles') ? "is-invalid" : "" }}">
                <label for="STAFF">Staff</label>

                <input type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER" {{ in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : "" }} class="form-control {{ $errors->first('roles') ? "is-invalid" : "" }}">
                <label for="CUSTOMER">Customer</label>
                <div class="invalid-feedback">
                    {{ $errors->first('roles') }}
                </div>
                <br>
            <br>

            <label for="phone">Phone Number</label>
            <br>
            <input type="text" class="form-control {{ $errors->first('phone') ? "is-invalid" : "" }}" name="phone" value="{{ old('phone') ? old('phone') : $user->phone }}">
            <div class="invalid-feedback">
                {{ $errors->first('phone') }}
            </div>
            <br>

            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control {{ $errors->first('address') ? "is-invalid" : "" }}">{{ $user->address }}</textarea>
            <div class="invalid-feedback">
                {{ $errors->first('address') }}
            </div>
            <br>

            <label for="avatar">Avatar image</label>
            <br>
            Current avatar: <br>
            @if ($user->avatar)
                <img src="{{ asset('public/storage/'.$user->avatar) }}" alt="Avatar" width="120px">
                <br>
            @else
                No Avatar
            @endif
            <br>
            <input type="file" id="avatar" name="avatar" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>

            <hr class="my-3">

            <label for="email">Email</label>
            <input type="email" value="{{ old('email') ? old('email') : $user->email }}" class="form-control {{ $errors->first('email') ? "is-invalid" : "" }}" placeholder="user@mail.com" name="email" id="email">
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
            <br>

            <input type="submit" class="btn btn-primary" value="Save">

        </form>
    </div>
@endsection