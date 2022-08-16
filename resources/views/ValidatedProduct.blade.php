@extends("layouts.layout")

@section('content')
<div>
    @if($isValidated)
    <h1 class="text-success">Your Product is validated !</h1>
    @else
    <h1 class="text-danger">sorry the product is not registered with us</h1>
    @endif
    <a href="/" class="btn  btn-outline-success">Go back to register page</a>
    <ul class="text-start text-danger">
        @foreach($errorList as $error)
            <li>{{$error}}</li>

        @endforeach
    </ul>
</div>
@endsection
