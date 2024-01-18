@extends('layouts.app', ['activePage' => config('labelsMenu.loginView.label'), 'collapse' =>
config('labelsMenu.loginView.collapse'), 'title' => config('labelsMenu.loginView.title')])

@section('css')
<style>
    .container-form {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 70vh;
    }

    .form {
        width: 50%;
        background-color: white;
        box-shadow: 3px 8px 17px -5px rgba(0, 0, 0, 1);
        padding: 10px;
    }

    .input-group {
        width: 90%;
    }

    .message-session {
        /* background-color: blue; */
        color: white;
        width: 100%;
        font-size: 14px;
    }
</style>
@endsection
@section('content')
<div class="content">
    <div class="container-form">
        <div class="form">
            <form method="post" action="{{ route('user.login') }}">
                @csrf
                <h3 style="text-align: center; padding: 10px 0"> Acceso al Sistema</h3>
                @include('shared/message')
                <div class="input-group">
                    <i class="fa-solid fa-circle-user"></i>
                    <input class="input" type="text" name="name" id="name"
                        onkeyup="validate('{{ config('messageModels.UsersModel.name') }}')"
                        onblur="validate('{{ config('messageModels.UsersModel.name') }}')"
                        placeholder="Ingrese correo o nombre de usuario" value="{{ old('name') }}">
                    <div class="message-error">
                        @if ($errors->has('name'))
                        <span id="error-name"> {{ $errors->first('name') }}</span>
                        @else
                        <span id="error-name"></span>
                        @endif
                    </div>

                </div>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input class="input" type="password" name="password" placeholder="Ingrese el password"
                        onkeyup="validate('{{ config('messageModels.UsersModel.password') }}')"
                        onblur="validate('{{ config('messageModels.UsersModel.password') }}')">
                    <div class="message-error">
                        @if ($errors->has('password'))
                        <span id="error-password"> {{ $errors->first('password') }}</span>
                        @else
                        <span id="error-password"></span>
                        @endif
                    </div>
                </div>
                <div style="margin-top: 25px; text-align: center;">
                    <button type="submit" class="button button__color-primary" disabled id="btn-save">Login</button>
                    <button type="button" for="btn-modal" class="button button__color-red" style="margin-left: 5px;"
                        onclick="document.getElementById('btn-modal').checked = false">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function validateForm() {
        let inputs = document.querySelectorAll(".input")
        let existError = false;
        inputs.forEach(element => {
            if (element.value == "")
                existError = true
        });
        document.getElementById('btn-save').disabled = existError;
    }

    function validate(message) {
        if (event.target.value == '') {
            document.getElementById('error-' + event.target.name).innerHTML = message
            document.getElementById('btn-save').disabled = true;
        } else {
            document.getElementById('error-' + event.target.name).innerHTML = ""
            validateForm()
        }
    }
</script>
@endpush