@extends("layouts.layout")

@section('content')

<div>
    @if (!isset($generatedData))

    <form action="/addProductLicense-admin" method="POST">
        @csrf
        <div class="row my-2">
            <Label class="col-md-4">Select The Product</Label>
            <Select class="col-md-8 " name="productId" required>
                @foreach ($products as $product )
                <option value="{{$product->id}}">{{$product->product_name}}</option>
                @endforeach
            </Select>
        </div>
        <div class="row my-2">
            <Label class="col-md-4">Select User</Label>
            <Select class="col-md-8 " name="userId" required>
                @foreach ($users as $user )
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </Select>
        </div>
        <div class="row my-2">
            <Label for="activation" class="col-md-4">How Many Activation Allowed</Label>
            <input min="1" step="1" class="col-md-8" type="number" name="activation" id="activation" required>
        </div>

        <div>
            <input class="btn btn-success btn-sm" type="submit" value="Generate License Key">
        </div>
    </form>
    @else
        <h1>Licensekey Generated</h1>
        <div class="row">
            <label class="col-md-4">Product Name</label>
            <input class="col-md-8" readonly value="{{$productName}}">
        </div>
        <div class="row">
            <label class="col-md-4">Customer Name</label>
            <input class="col-md-8" readonly value="{{$customerName}}">
        </div>
        <div class="row">
            <label class="col-md-4">LicenseKey</label>
            <input class="col-md-8" readonly value="{{$LicenseKey}}">
        </div>


    @endif

    @if(isset($errorList))
        <ul>
            @foreach ($errorList as $error )
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
</div>

@push('footer-scripts')
@vite('resources/js/addProductLicense-admin.js')
@endpush

@endsection
