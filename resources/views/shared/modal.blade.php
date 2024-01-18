<input type="checkbox" id="btn-modal" style="display: none">

<div class="container-modal">
    <form method="post" enctype="multipart/form-data" action="{{ route('dataTable.store') }}" id="form">
        @csrf
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="urlIndex" id="urlIndex" value="{{ $urlIndex }}">
        <div class="content-modal">
            <h4 id="header-modal"></h4>
            <hr>
            {{-- El header se asigna en el JS de createoredit --}}
            <div class="container-form">
                <div class="container-input">
                    <div class="input-text">
                        <div class="input-group">
                            <label for="name" class="label">Nombre</label>
                            <input class="input" type="text" name="name" id="name"
                                onkeyup="validate('{{ config('messageModels.UsersModel.name') }}')"
                                onblur="validate('{{ config('messageModels.UsersModel.name') }}')"
                                placeholder="Ingrese el nombre de usuario" value="{{ old('name') }}">
                            <div class="message-error">
                                @if ($errors->has('name'))
                                <span id="error-name"> {{ $errors->first('name') }}</span>
                                @else
                                <span id="error-name"></span>
                                @endif
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="email" class="label">email</label>
                            <input class="input" type="email" name="email" id="email" placeholder="Ingrese el correo"
                                onkeyup="validate('{{ config('messageModels.UsersModel.email') }}')"
                                onblur="validate('{{ config('messageModels.UsersModel.email') }}')"
                                value="{{ old('email') }}"">
                            <div class=" message-error">
                            @if ($errors->has('email'))
                            <span id="error-email"> {{ $errors->first('email') }}</span>
                            @else
                            <span id="error-email"></span>
                            @endif
                        </div>
                        <div class="input-group">
                            <label for="password" class="label">Password</label>
                            <input class="input" type="password" name="password" placeholder="Ingrese el password"
                                onkeyup="validate('{{ config('messageModels.UsersModel.password') }}')"
                                onblur="validate('{{ config('messageModels.UsersModel.password') }}')">
                            <div class="message-error" style="margin-left: 52px">
                                @if ($errors->has('password'))
                                <span id="error-password"> {{ $errors->first('password') }}</span>
                                @else
                                <span id="error-password"></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-image" style="margin-top: 5px">
                    <div class="message-error" style="margin-bottom: 5px;">
                        @if ($errors->has('image'))
                        <span id="error-image"> {{ $errors->first('image') }}</span>
                        @else
                        <span id="error-image"> </span>
                        @endif
                    </div>
                    <div class="input-image">
                        <label for="imagefile"
                            style="font-size:15px;  padding: 5px; cursor: pointer; margin-left:-15px; "> <i
                                class="fa fa-plus" aria-hidden="true">
                            </i>Seleccione una Imagen</label>
                        <input type="file" name="image" id="imagefile" accept="image/*" onchange="preview(event)"
                            style="display:none" value="{{ old('image') }}">
                        <div id="display-image">
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 25px; text-align: center;">
                <button type="submit" class="button button__color-primary" disabled id="btn-save">Grabar</button>
                <button type="button" for="btn-modal" class="button button__color-red"
                    onclick="document.getElementById('btn-modal').checked = false">Cancelar</button>
            </div>
        </div>
    </form>
</div>