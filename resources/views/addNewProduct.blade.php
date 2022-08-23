@extends("layouts.layout")

@section('content')

@if(isset($errorMessage))
    <div>
        <p class="text-danger">{{ $errorMessage}}</p>
    </div>
@elseif(! isset($SuccessMessage))
    <div>
        <form method="POST" action="/addProduct-admin">
            @csrf
            <div class="row">
                <label class="col-md-4">Product Name</label>
                <input class="col-md-8 " type="text" name="productName" id="productName">
            </div>
            <div>
                <input class="mt-2 btn btn-success" type="submit" value="Register New Product Type">
            </div>
        </form>
    </div>
@else
    <div>
        <h1 class="text-success">{{$SuccessMessage}}</h1>
        <div class="row">
            <label class="col-md-4">Id</label>
            <input class="col-md-8" type="text" value="{{$productId}}" readonly>
        </div>
        <div class="row">
            <label class="col-md-4">Name</label>
            <input class="col-md-8" type="text" value="{{$ProductName}}" readonly>
        </div>
        <p>Please Save This For Reference</p>
    </div>
@endif

@endsection
