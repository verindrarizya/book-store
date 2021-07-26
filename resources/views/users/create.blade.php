@extends('layouts\global')

@section('title')
    Create User
@endsection

@section('content')

<div class="col-md-8">

    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif 
    
    <form action="{{ route('users.store') }}" method="POST" class="bg-white shadow-sm p-3" enctype="multipart/form-data">
        @csrf
    
        <label for="name">Name</label>
        <input type="text" class="form-control {{ $errors->first('name') ? "is-invalid" : "" }}" placeholder="Full Name" name="name" id="name" value="{{ old('name') }}"/>
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
        <br>
    
        <label for="username">Username</label>
        <input type="text" class="form-control {{ $errors->first('username') ? "is-invalid" : "" }}" placeholder="Username" name="username" id="username" value="{{ old('username') }}"/>
        <div class="invalid-feedback">
            {{ $errors->first('username') }}
        </div>
        <br>
    
        <label for="">Roles</label>
        <br>
        <input type="checkbox" name="roles[]" id="ADMIN" value="ADMIN" class="form-control {{ $errors->first('roles') ? "is-invalid" : "" }}"/>
            <label for="ADMIN">Administrator</label>
        <input type="checkbox" name="roles[]" id="STAFF" value="STAFF" class="form-control {{ $errors->first('roles') ? "is-invalid" : "" }}"/>
            <label for="STAFF">Staff</label>
        <input type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER" class="form-control {{ $errors->first('roles') ? "is-invalid" : "" }}"/>
            <label for="CUSTOMER">Customer</label>
            <div class="invalid-feedback">
                {{ $errors->first('roles') }}
            </div>
        <br>
    
        <br>
        <label for="phone">Phone Number</label>
        <br>
        <input type="text" name="phone" class="form-control {{ $errors->first('phone') ? "is-invalid" : "" }}" value="{{ old('phone') }}">
        <div class="invalid-feedback">
            {{ $errors->first('phone') }}
        </div>
    
        <br>
        <label for="address">Address</label>
        <textarea name="address" id="address" class="form-control {{ $errors->first('address') ? "is-invalid" : "" }}" >{{ old('address') }}</textarea>
        <div class="invalid-feedback">
            {{ $errors->first('address') }}
        </div>
    
        <br>
        <label for="avatar">Avatar Image</label>
        <br>
        <input type="file" id="avatar" name="avatar" class="form-control {{ $errors->first('avatar') ? "is-invalid" : "" }}">
        <div class="invalid-feedback">
            {{ $errors->first('avatar') }}
        </div>
    
        <hr class="my-4">
    
        <label for="email">Email</label>
        <input type="email" class="form-control {{ $errors->first('email') ? "is-invalid" : "" }}" placeholder="user@mail.com" name="email" id="email" value="{{ old('email') }}">
        <div class="invalid-feedback">
            {{ $errors->first('email') }}
        </div>
        <br>
    
        <label for="password">Password</label>
        <input type="password" class="form-control {{ $errors->first('password') ? "is-invalid" : "" }}" placeholder="Password" name="password" id="password" value="{{ old('password') }}">
        <div class="invalid-feedback">
            {{ $errors->first('password') }}
        </div>
        <br>
    
        <label for="password_confirmation">Password Confirmation</label>
        <input type="password" class="form-control {{ $errors->first('password_confirmation') ? "is-invalid" : "" }}" placeholder="Password Confirmation" name="password_confirmation" id="password_confirmation" value="{{ $errors->first('password_confirmation') }}">
        <div class="invalid-feedback">
            {{ $errors->first('password_confirmation') }}
        </div>
        <br>
    
        <input type="submit" class="btn btn-primary" value="Save">
    </form>
</div>
    

@endsection