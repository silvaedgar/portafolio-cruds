@extends('layouts.index-users', ['activePage' => config('labelsMenu.crudDtclientView.label'), 'collapse' =>
config('labelsMenu.crudDtclientView.collapse'), 'title' => config('labelsMenu.crudDtclientView.title')])

@section('extra-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection


@section('contentIndex')

<div class="content">
    <div class="header">
        <div class="header-row">
            <h5 style="padding: 0px">Modulo de Usuarios</h5>
            @if (VerifyPermissionsFacade::checkPermissions([config('permissions.canDtclientCreate')]))
            <button for="btn-modal" class="button button__color-lightgray " id="0" onclick="createOrEdit(0)">
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
                @foreach ($users as $user)
                <tr>
                    <td style="text-align: center"> {{ $loop->iteration }}</td>
                    <td> <img src="{{ config('constants.Url') }}{{ $user->image }}" alt=""
                            style="height: 50px; width: 50px; object-fit: fill; margin: auto; display: block" />
                    </td>
                    <td> {{ $user->name }}</td>
                    <td> {{ $user->email }}</td>
                    <td>
                        <div style="display: flex; justify-content: center; align-items: center">
                            @if (VerifyPermissionsFacade::checkPermissions([config('permissions.canDtclientUpdate')]))
                            <button class="button-sm button__color-primary " onclick="createOrEdit({{ $user }})"
                                title="Editar Usuario {{ $user->name }}"><i class="fa fa-edit"
                                    aria-hidden="true"></i></button>
                            @endif
                            @if (VerifyPermissionsFacade::checkPermissions([config('permissions.canDtclientDestroy')]))

                            <form action="{{ route('dataTable.destroy') }}" method="post"
                                style="margin-left: 10px; display: inline-block; " onsubmit="deleteItem({{ $user }})">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="urlIndex" value="{{ $urlIndex }}">
                                <input type="hidden" name="id" value="{{ $user->id }}">

                                <button class="button-sm button__color-red "><i class="fa fa-trash" type="submit"
                                        aria-hidden="true" title="Eliminar Usuario {{ $user->name }}"></i></button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!--Ventana Modal-->
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
                infoEmpty: "",
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

</script>
@endpush