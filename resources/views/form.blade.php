@extends('layouts.app', ['activePage' => 'form', 'collapse' => '', 'title' => 'Formularios'])

@section('css')
@endsection
@section('content')
    <div class="content">
        <form action="{{ route('crud.store') }}" method="post">
            @csrf
            <div>
                <h2>Crear Usuario</h2>
                <div class="container-form">
                    <div class="input-text">
                        <div class="input-grou0p">
                            <label for="name" class="label">Nombre</label>
                            <input class="input" type="text" name="name" placeholder="Ingrese el nombre de usuario">
                        </div>
                        <div class="input-group">
                            <label for="email" class="label">email</label>
                            <input class="input" type="email" name="email" placeholder="Ingrese el correo">
                        </div>
                        <div class="input-group">
                            <label for="password" class="label">Password</label>
                            <input class="input" type="password" name="password" placeholder="Ingrese el password">
                        </div>
                    </div>
                    <div class="input-image">
                        <label for="img" class="label">Seleccione la Foto</label>
                        <input type="file" name="img">
                    </div>
                </div>
                <div style="margin-top: 25px; text-align: center;">
                    <button type="submit" class="btn btn-primary">Grabar</button>
                    <button class="btn btn-red">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
