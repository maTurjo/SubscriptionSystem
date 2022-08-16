@extends("layouts.layout")

@section('content')

<div class="mt-5">
    <h3>Login Form</h3>
    <form method="POST" action="/customerLogin">
        @csrf
        <div class="input-group mt-2">
            <label class="input-group-text" for="email">Email</label>
            <input id="email" class="form-control" name="email" type="email" required/>
        </div>
        <div class="input-group mt-2">
            <label class="input-group-text" for="password">Password</label>
            <input id="password" class="form-control" name="password" type="password" required/>
        </div>
        <div>
            @isset($errorList)
            <ul>
                @foreach ($errorList as $error )
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            @endisset
        </div>
        <div class="mt-2 text-end">
            <a class="btn btn-outline-success" href="/customerRegistration">Regtister With Us</a>
            <input class="btn btn-success" type="submit" value="Login">
        </div>
    </form>
</div>

@endsection
