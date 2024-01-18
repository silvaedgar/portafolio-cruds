@extends('layouts.app', ['activePage' => config('labelsMenu.crudApiView.label'), 'collapse' =>
config('labelsMenu.crudApiView.collapse'), 'title' => config('labelsMenu.crudApiView.title')])

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="css/modal.css">

@endsection

@section('content')
<div class="content">
    <div class="header">
        <div class="header-row">
            <h3 style="padding: 0px">Modulo de Usuarios</h3>
            @if (VerifyPermissionsFacade::checkPermissions([config('permissions.canPaginateCreate')]))
            <button for="btn-modal" class="button button__color-lightgray" onclick="createOrEdit(0)">
                Crear Usuario
            </button>
            @endif
        </div>
        @include('shared/message')
    </div>
    <div class="body">
        <div class="container-search">
            <div class="show">
                <span> Mostrar</span>
                <select name="recordToShow" class="select-show" style="width: 15%; height:30px" id="recordToShow"
                    onchange="numberRecord()">
                </select>
                <span> registros x pagina</span>
            </div>
            <div class="search">
                <span>Buscar: </span>
                <div class="input-search">
                    <input type="text" name="search" value="" style="outline: none; border: none; height:30px"
                        id="search">
                    <i class="fa fa-search" aria-hidden="true" onclick="numberRecord()" style="cursor:pointer"></i>
                </div>
            </div>
        </div>
        <table class="table" id="table">
            <thead>
                <th style="text-align: center;"> Item</th>
                <th style="text-align: center; "> Foto </th>
                <th style="text-align: center;"> Nombre </th>
                <th style="text-align: center;"> Correo </th>
                <th style="text-align: center;"> Acciones </th>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div style="text-align: end; ">
            <span>Pagina:
                <select name="links" class="select-show" style="width: 8%; height:30px" id="links"
                    onchange="loadData(event.target.value)"></select>
            </span>
        </div>


        {{-- ------------ Modal del Api ---------}}
        <input type="checkbox" id="btn-modal" style="display: none">

        <div class="container-modal">
            <form method="post" enctype="multipart/form-data" id="form" onsubmit="saveUser()">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="content-modal">
                    <h4 id="header-modal"></h4>
                    <div class="header-row" style="display:none" id="header-block-modal">
                        <span class="message-session" id="message-session-modal"></span>
                    </div>
                    <hr>
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
                                    <input class="input" type="email" name="email" id="email"
                                        placeholder="Ingrese el correo"
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
                                    <input class="input" type="password" name="password" id="password"
                                        placeholder="Ingrese el password"
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
                                <input type="file" name="image" id="imagefile" accept="image/*"
                                    onchange="preview(event)" style="display:none" value="{{ old('image') }}">
                                <div id="display-image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: 25px; text-align: center;">
                        <button type="submit" class="button button__color-primary" disabled
                            id="btn-save">Grabar</button>
                        <button type="button" for="btn-modal" class="button button__color-red"
                            onclick="document.getElementById('btn-modal').checked = false">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>

        {{-- --------- Fin del Modal -------- --}}
    </div>


</div>
@endsection

@push('extrajs')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        loadData("")
    })

    function createOrEdit(user) {
        document.getElementById('header-block-modal').style.display = 'none'
        document.getElementById('header-row').style.display = 'none'

        if (user == 0) {
            const messageAdd = "<?php echo config('constants.Add'); ?>"
            document.getElementById('form').reset()
            document.getElementById('id').value = 0
            document.getElementById('header-modal').innerHTML = messageAdd + " Usuario"
            document.getElementById('display-image').innerHTML = "";
        } else {
            const url = getUrl()
            let messageEdit = "<?php echo config('constants.Edit'); ?>"

            document.getElementById('id').value = user.id
            document.getElementById('header-modal').innerHTML = messageEdit + "  Usuario " + user
                .name
            document.getElementById('name').value = user.name
            document.getElementById('email').value = user.email
            document.getElementById('password').value = ""

            if (user.image != null && user.image != '') {
                showImage(url + user.image)
            } else document.getElementById('display-image').innerHTML = "";
        }
        document.getElementById('btn-modal').checked = true
    }

    async function loadData(page)
    {
        response = await getData(page)
        if (response.success)
            generateTable(response)
        else
            alert("ERROR LEYENDO DATOS")
    }

    function showImage(file) {
        document.getElementById('display-image').innerHTML = "<img src='" + file +
            "' height = '90%' width = '100%' />";
    }

    function getFileExtension1(filename) { //usado para validar la extension de la imagen
        return (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename)[0] : undefined;
    }

    function preview(event) {

        let extsValid = ['jpeg', 'png', 'jpg', 'tiff', 'gif', 'bmp']

        let reader = new FileReader();
        reader.onload = (e) => {
            showImage(e.target.result)
        }
        reader.readAsDataURL(event.target.files[0])
        if (event.target.files[0]) {
            let extFile = getFileExtension1(event.target.files[0].name)
            let extValid = extsValid.find(element => element == extFile)

            if (!extValid) {
                let messageError = "<?php echo config('messageModels.UsersModel.image'); ?>"
                document.getElementById('error-image').innerHTML = messageError
                document.getElementById('btn-save').disabled = true;
            } else {
                document.getElementById('error-image').innerHTML = ""
                validateForm()
            }
        }
    }

    async function getUser(id) {
        let url = "<?php echo config('constants.Url'); ?>"
        url += "api/crud/" + id
        let resp = await fetch(url,  {
            'method': 'get',
            headers: {
                "Accept": "application/json",
            }})
        if (resp.ok)
            response =  await resp.json();
        else
            response = {
            'success' : false,
            'message' : "error de servidor"
            }

        if (response.success) {
            createOrEdit(response.user)
        }
    }

    async function deleteUser(id) {
        let url = "<?php echo config('constants.Url'); ?>"
        url += "api/crud/" + id

        let resp = await fetch(url,  {
            'method': 'delete',
            headers: {
                "Accept": "application/json",
                "X-CSRF-Token": getToken()
            }})
        if (resp.ok) {
            response =  await resp.json();
            if (response.success) {
                document.getElementById('message-session').innerHTML = response.message
                document.getElementById('message-session').style = 'margin-left: -10px'
                loadData("")
            }
            else {
                document.getElementById('message-session').innerHTML = "No se elimino el usuario. Error de datos"
                document.getElementById('message-session').style = 'margin-left: -10px'
            }
        }
        else {
                document.getElementById('message-session').innerHTML = "No se elimino el usuario. Error de Conexion al Servidor"
                document.getElementById('message-session').style = 'margin-left: -10px'
        }

    }

    function deleteItem(id, name) {
        event.preventDefault()

        Swal.fire({
            title: '¿Esta Seguro de Eliminar el Usuario ' + name + "?",
            text: "Recuerde esta acción no se podrá reversar",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar',
            cancelButtonText: 'No, Cancelar',

        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                    deleteUser(id)
            }
        })
    }

    function DeleteTable(table) {
        var filas = table.rows.length;
        try {
            for (let i = 1; i < filas;) {
                table.deleteRow(i);
                filas--;
            }   // elimina las celdas existentes comienza en uno para no eliminar el encabezado
        } catch (e) {
            alert(e);
        }
    }

    function createElementInput(row,celda,input,type,name,value, clase, action="Edit") {

        elementInput = document.createElement(input)
        elementInput.type = type
        elementInput.name = name
        elementInput.value = value
        if (input == 'button') {
            elementInput.value = ""
            elementInput.innerHTML = value
            elementInput.classList = clase
            elementInput.style = "margin-left: 8px"

            elementInput.onclick = function () {
                if (action =="Edit") {
                    // OJO Mantener solo un input en la fila dentro de la celda 0
                    getUser(row.cells[0].querySelector("input").value,"get")
                }
                else {
                    deleteItem(row.cells[0].querySelector("input").value,row.cells[2].innerHTML )
                }
            }
        }
        celda.appendChild(elementInput)
    }

    function getToken() {
        return document.head.querySelector("[name~=csrf-token][content]").content;
    }

    function getUrl() {
        return "<?php echo config('constants.Url'); ?>"
    }

    function generateTable(data) {

        let url = getUrl()

        rowRecord = data.collection.current_page * data.collection.per_page - (data.collection.per_page - 1)
        table = document.getElementById('table')
        DeleteTable(table);
        select = document.getElementById('links')
        recordToShow = document.getElementById('recordToShow')

        data.collection.data.forEach(element => {
            var row = table.insertRow();
            for (let index = 0; index < 5; index++) {
                celda = row.insertCell(index);  // celda del item
                switch(index) {
                    case 0:
                        celda.innerHTML = rowRecord
                        createElementInput(row,celda,"input","hidden","id[]",element.id)
                        break;
                    case 1:
                        if (element.image != null) {
                        image = "<img src='" + url + element.image.substring(1) + "' alt=''  style='height: 50px; width: 50px; object-fit: fill; margin: auto; display: block'>"
                        celda.innerHTML = image
                        }
                        break;
                    case 2:
                        celda.innerHTML = element.name
                        break;
                    case 3:
                        celda.innerHTML = element.email
                        break;
                    default:
                        createElementInput(row,celda,"button","submit","",'<i class="fa fa-edit" aria-hidden="true"></i>',"button-sm button__color-primary","Edit")
                        createElementInput(row,celda,"button","button","",'<i class="fa fa-trash" aria-hidden="true"></i>',"button-sm button__color-red ","Delete")

                }
            }
            rowRecord ++;
        });
        select.innerHTML = ""
        data.collection.links.forEach(element => {
            if (!isNaN(element.label))
                select.innerHTML += "<option value='" + element.url + "' " +   (data.collection.current_page == element.label ? "selected" : "")  + ">" +   element.label + " </option>"
        });
        recordToShow.innerHTML = ""
        arrayRecord = ["6","10","15","25","All"]

        arrayRecord.forEach(element => {
                recordToShow.innerHTML += "<option value='" + element + "'" + (element == data.recordToShow ? "selected" : "")  + ">" +   element + " </option>"
        });
    }

    async function getData(page) {
        let url = "<?php echo config('constants.Url'); ?>"
        url += "api/crud"
        if (page != '') url = page


        let resp = await fetch(url,  {
            'method': 'get',
            headers: {
                "Accept": "application/json",
            }})
        if (resp.ok)
            return await resp.json();
        else
            return {
            'success' : false,
            'message' : "error de servidor"
            }
    }

    function numberRecord() {
        event.preventDefault()

        let url = "<?php echo config('constants.Url'); ?>"
        url += "api/crud?recordToShow=" + document.getElementById('recordToShow').value + "&search=" + document.getElementById('search').value

        console.log("NumberRecord ", url)
        loadData(url)
    }

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

    async function saveUser() {
        event.preventDefault()

        data = new FormData(form)
        token = getToken()

        url = getUrl() + "api/save-user"

        resp = await fetch(url, {
        'method': 'post',
            headers: {
                "Accept": "application/json",
                "X-CSRF-Token": token
            },
            body: data
        })
        if (!resp.ok) {
            document.getElementById('header-block-modal').style.display = 'block'
            document.getElementById('message-session-modal').innerHTML = "Error no se grabo el registro"
        }
        else {
            response = await resp.json()
            if (response.success) {
                loadData("")
                document.getElementById('btn-modal').checked = false
                document.getElementById('message-session').innerHTML = response.message
                document.getElementById('message-session').style = 'margin-left: -10px'

                document.getElementById('header-row').style.display = 'block'

            }
            console.log("RESPONSE ", response)
        }
    }

</script>
@endpush('extrajs')
