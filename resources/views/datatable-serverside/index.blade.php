@extends('layouts.index-users', ['activePage' => config('labelsMenu.crudDtssView.label'), 'collapse' =>
config('labelsMenu.crudDtssView.collapse'), 'title' => config('labelsMenu.crudDtssView.title')])

{{-- CSS para estilar el data table --}}
@section('extra-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection


@section('contentIndex')
<div class="content">
    <div class="header">
        <div class="header-row">
            <h5 style="padding: 0px">Modulo de Usuarios</h5>
            @if (VerifyPermissionsFacade::checkPermissions([config('permissions.canDtssCreate')]))

            <button for="btn-modal" class="button button__color-lightgray" id="0" onclick="createOrEdit()">
                Crear Usuario
            </button>
            @endif
        </div>
        @include('shared/message')
    </div>
    <div class="body">
        <table class="table" id="table">
            <thead>
                <th style="text-align: center;"> Item </th>
                <th style="text-align: center;"> Foto </th>
                <th style="text-align: center;"> Nombre </th>
                <th style="text-align: center;"> Correo </th>
                <th style="text-align: center;"> Acciones </th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>


    @include('shared/modal')


</div>
@endsection

@push('extrajs')

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>


<script type="text/javascript">
    $(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dataTableSS.index') }}",
                columns: [{
                        data: 'id',
                    },
                    {
                        data: 'photo',
                        orderable: false
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'email',
                    },
                    {
                        data: 'actions',
                        orderable: false
                    },
                ],
                stateSave: true,
                lengthMenu: [
                    [6, 10, 20, -1],
                    [6, 10, 20, "Todos"]
                ],
                autoWidth: true,
                language: {
                    search: "Buscar: ",
                    emptyTable: "No hay registros que mostrar",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "No hay registros para mostrar",
                    lengthMenu: "Mostrar _MENU_ registros x pagina",
                    infoFiltered: "(Filtrado de un total de _MAX_  registros)",
                    paginate: {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Sig",
                        "previous": "Ant"
                    },
                }

            })
        })

// La funcion createOrEdit se sobreescribe ya que en el serverside no existe el objeto user aqui se hace uso de un api
        function createOrEdit() {
            if (event.target.id > 0) {
                let url = "<?php echo config('constants.Url'); ?>"

                fetch(url + "datatable-serverside/edit/" + event.target.id, {
                    'method': 'get',
                    headers: {
                        "Accept": "application/json",
                    },
                }).then(response => {
                    return response.json()
                }).then(json => {
                    if (json.findRecord) {
                        let messageEdit = "<?php echo config('constants.Edit'); ?>"

                        document.getElementById('id').value = json.user.id
                        document.getElementById('btn-modal').checked = true
                        document.getElementById('header-modal').innerHTML = messageEdit + "  Usuario " + json.user
                            .name
                        document.getElementById('name').value = json.user.name
                        document.getElementById('email').value = json.user.email
                        if (json.user.image != null && json.user.image != '') {
                            showImage(url + json.user.image)
                        } else {
                            document.getElementById('display-image').innerHTML = "";
                        }
                    }
                })
            } else {
                let messageAdd = "<?php echo config('constants.Add'); ?>"
                document.getElementById('form').reset()
                document.getElementById('id').value = 0
                document.getElementById('btn-modal').checked = true
                document.getElementById('header-modal').innerHTML = messageAdd + " Usuario"
                document.getElementById('display-image').innerHTML = "";
            }
        }

</script>
@endpush