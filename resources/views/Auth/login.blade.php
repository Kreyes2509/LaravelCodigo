@extends('diseño')


@if ($message = Session::get('msg'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{$message}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="login"style="text-align: center;width: 50%">
    <form method="POST" action="{{url("sesion")}}" style="width: 50%">
        <h1>Login</h1>
        @csrf
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
        <button type="submit" class="btn btn-primary btn-block btn-large">Iniciar sesion</button><br>
        <div style="text-align: center">
            <a href="/registrar">Registrar</a>
        </div>
    </form>
</div>


