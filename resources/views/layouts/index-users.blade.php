@extends('layouts.app', ['activePage' => $activePage, 'collapse' => $collapse, 'title' => $title])

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="css/modal.css">
@endsection

@section('content')
@yield('contentIndex')
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    window.addEventListener("DOMContentLoaded", () => {
        let errors = "<?php echo $errors->first(); ?>"

        if (errors != '') {
            document.getElementById('btn-modal').checked = true
        }

    })

    function getFileExtension1(filename) { //usado para validar la extension de la imagen
        return (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename)[0] : undefined;
    }

    function showImage(file) {
        document.getElementById('display-image').innerHTML = "<img src='" + file +
            "' height = '120vh' width = '100%' />";
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

    function createOrEdit(user) {
        if (user == 0) {
            let messageAdd = "<?php echo config('constants.Add'); ?>"
            document.getElementById('form').reset()
            document.getElementById('id').value = 0
            document.getElementById('header-modal').innerHTML = messageAdd + " Usuario"
            document.getElementById('display-image').innerHTML = "";
        } else {
            // let url = "<?php echo config('constants.Url'); ?>"
            const url = getUrl()
            let messageEdit = "<?php echo config('constants.Edit'); ?>"

            document.getElementById('id').value = user.id
            document.getElementById('header-modal').innerHTML = messageEdit + "  Usuario " + user
                .name
            document.getElementById('name').value = user.name
            document.getElementById('email').value = user.email
            if (user.image != null && user.image != '') {
                showImage(url + user.image)
            } else document.getElementById('display-image').innerHTML = "";
        }
        document.getElementById('btn-modal').checked = true
    }

    // function deleteRecord(target, nameUser) {

    //     const token = getToken();
    //     const goUrl = document.getElementById('urlIndex').value
    //     let form = target
    //     const url = getUrl() + "/" + target.id + "/" + goUrl
    //     alert("EDGAR")
    //     console.log(url,"EDGAR")

    //     fetch(url, {
    //         'method': 'DELETE',
    //         headers: {
    //             "Accept": "application/json",
    //             "X-CSRF-Token": token
    //         },
    //     }).then(response => {
    //         return response.json()
    //     }).then(json => {
    //         if (json.findRecord) {
    //             let messageDelete = "<?php echo config('constants.messageDelete'); ?>"
    //             Swal.fire({
    //                 title: 'Usuario ' + nameUser + ' ' + messageDelete,
    //                 icon: 'success'
    //             }).then(result => {

    //                 form.submit()
    //             })
    //         }
    //     })
    // }

    function deleteItem(user="") {
        event.preventDefault()

        form = event.target
        Swal.fire({
            title: '¿Esta Seguro de Eliminar el Usuario ' + user.name + "?",
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
                form.submit()
                // deleteRecord(form, user.name)
            }
        })
    }

    function getToken() {
        return document.head.querySelector("[name~=csrf-token][content]").content;
    }

    function getUrl() {
        return "<?php echo config('constants.Url'); ?>"
    }

    function querySearch() {
        const form = document.getElementById('form-search')
        form.submit()
    }
</script>
@endpush
