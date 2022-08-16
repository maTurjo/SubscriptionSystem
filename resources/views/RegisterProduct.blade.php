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
            <label class="input-group-text" for="userName">UserName</label>
            <input class="form-control" id="userName" type="text" name="userName" required>
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
@endsection
