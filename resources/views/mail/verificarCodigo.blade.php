@extends('diseño')

<div class="login"style="text-align: center;width: 50%">
    <form  style="width: 50%">
        <h1>Verificar codigo:{{$id}}</h1>
        @csrf
        <div class="mb-3">
            <input type="text" name="codigo" placeholder="codigo" required="required" />
            @error('codigo')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-large">Verificar</button><br>
    </form>
</div>
