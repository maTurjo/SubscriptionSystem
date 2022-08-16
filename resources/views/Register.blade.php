@extends("layouts.layout")

@section('content')

<div class="mt-5">
    <h3>User Registration Form</h3>
    <form method="POST" action="/customerRegistration">
        @csrf
        <div class="input-group mt-2">
            <label class="input-group-text" for="fullName">Full Name</label>
            <input id="fullName" class="form-control" name="fullName" required type="text"/>
        </div>

        <div class="input-group mt-2">
            <label class="input-group-text" for="email">E mail</label>
            <input id="email" class="form-control" name="email" required type="email"/>
        </div>
        <div class="input-group mt-2">
            <label class="input-group-text" for="password">Password</label>
            <input id="password" class="form-control" name="password" required type="password"/>
        </div>
        <div class="input-group mt-2">
            <label class="input-group-text" for="repeatPassword">Repeat Password</label>
            <input id="password" class="form-control" name="repeatPassword" required type="password"/>
        </div>
        <div class="mt-2 text-end">
            @isset($errorList)
            <ul class="text-start text-danger">
                @foreach ($errorList as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            @endisset
            <input class="btn btn-success btn-lg" type="submit" value="Register">
            <a class="btn btn-outline-success btn-lg" href="/customerLogin">Login</a>
        </div>
    </form>
</div>

@endsection
