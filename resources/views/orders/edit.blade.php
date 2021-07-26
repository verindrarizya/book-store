@extends('layouts.global')

@section('title')
    Edit Order
@endsection

@section('content')
    
<div class="row">
    <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('orders.update', [$order->id]) }}" class="shadow-sm bg-white p-3" method="POST">
            @csrf

            <input type="hidden" name="_method" value="PUT">

            <label for="invoice_number">Invoice Number</label><br>
            <input type="text" value="{{ $order->invoice_number }}" disabled class="form-control">
            <br>

            <label for="">Buyer</label><br>
            <input type="text" class="form-control" value="{{ $order->user->name }}" disabled>
            <br>

            <label for="created_at">Order Date</label><br>
            <input type="text" disabled value="{{ $order->created_at }}" class="form-control">
            <br>

            <label for="">Books {{ $order->totalQuantity }}</label><br>
            <ul>
                @foreach ($order->books as $book)
                    <li>{{ $book->title }} <b>{{ $book->pivot->quantity }}</b></li>
                @endforeach
            </ul>

            <label for="">Total Price</label><br>
            <input type="text" disabled value="{{ $order->total_price }}" class="form-control">
            <br>

            <label for="status">Status</label><br>
            <select name="status" id="status" class="form-control">
                <option value="SUBMIT" {{ $order->status == "SUBMIT" ? "selected" : '' }}>SUBMIT</option>
                <option value="PROCESS" {{ $order->status == "PROCESS" ? "selected" : '' }}>PROCESS</option>
                <option value="FINISH" {{ $order->status == "FINISH" ? "selected" : '' }}>FINISH</option>
                <option value="CANCEL" {{ $order->status == "CANCEL" ? "selected" : '' }}>CANCEL</option>
            </select>
            <br>

            <input type="submit" value="Update" class="btn btn-primary">
        </form>
    </div>
</div>

@endsection