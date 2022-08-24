@extends("layouts.layout")

@section('content')
<div class="my-5">
    <h1>Register Product</h1>
</div>
<div>
    <form method="POST"  action="/registerProduct">
        @csrf
        <div class="input-group mt-2">
            <label class="input-group-text" for="productKey">Product Key</label>
            <input class="form-control" id="productKey" type="text" name="productKey" required>
        </div>
        <div class="input-group mt-2">
            <label class="input-group-text" for="email">Email</label>
            <input class="form-control" id="email" type="text" name="email" required value="{{Cookie::get('userEmail')}}" readonly>
        </div>
        <div class="input-group mt-2">
            <label class="input-group-text" for="LicenseKey">License Key</label>
            <input class="form-control" id="LicenseKey" type="text" name="LicenseKey" required>
        </div>
        <div>
            <ul>

            </ul>
        </div>
        <div class="text-end">
        </div>
        <div class="text-end">
            <input class="btn btn-success mt-2" type="submit" value="Register your product">
            <a class="btn btn-danger mt-2" href="/logout">logout</a>
        </div>
    </form>
</div>
@if(isset($ActivatedProductsList))
    <div>
        <table class="table">
            <tr>
                <th>Product Key</th>
                <th>Product Name</th>
                <th>Total Activation Allowed</th>
                <th>Activation Done</th>
                <th>License Key</th>
            </tr>
            @foreach ($ActivatedProductsList as $product )
            <tr>
                <td>{{$product->product->id}}</td>
                <td>{{$product->product->product_name}}</td>
                <td>{{$product->activation_allowed}}</td>
                <td>{{$product->activation_done}}</td>
                <td>{{$product->activation_key}}</td>
            </tr>
            @endforeach
        </table>
    </div>
@endif
@endsection
