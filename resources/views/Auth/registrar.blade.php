@extends('diseño')

@if ($message = Session::get('msg'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{$message}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif


<div class="login">
	<h1>Registrar</h1>
    <form method="POST" action="{{url("signUp")}}">
        @csrf
        <div class="mb-3">
            <input type="text" name="name" placeholder="Username" required="required" />
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <input type="text" name="email" placeholder="email" required="required" />
            @error('email')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" required="required" />
            @error('password')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-large">Registrar</button>
    </form>
    <div style="text-align: center">
        <a href="/login">Login</a>
    </div>
</div>
