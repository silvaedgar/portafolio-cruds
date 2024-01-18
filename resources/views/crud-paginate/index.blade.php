@extends('layouts.index-users', ['activePage' => config('labelsMenu.crudPaginateView.label'), 'collapse' =>
config('labelsMenu.crudPaginateView.collapse'), 'title' => config('labelsMenu.crudPaginateView.title')])

@section('contentIndex')
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
        <form class="container-search" action="{{ route('paginate.index') }}" method="get" id="form-search">
            <div class="show">
                <span> Mostrar</span>
                <select name="recordToShow" class="select-show" style="width: 15%; height:30px" id="recordToShow"
                    onchange="document.getElementById('form-search').submit()">
                    <option value="6" {{ $recordToShow==6 ? 'selected' : '' }}>6</option>
                    <option value="10" {{ $recordToShow==10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ $recordToShow==15 ? 'selected' : '' }}>15</option>
                    <option value="15" {{ $recordToShow==25 ? 'selected' : '' }}>25</option>
                    <option value="All" {{ $recordToShow=='All' ? 'selected' : '' }}>Todos</option>
                </select>
                <span> registros x pagina</span>
            </div>
            <div class="search">
                <span>Buscar: </span>
                <div class="input-search">
                    <input type="text" name="search" value="{{ $search }}"
                        style="outline: none; border: none; height:30px">
                    {{-- <button class="btn-icon bg-primary" type="submit" id="button-search"> --}}
                        <i class="fa fa-search" aria-hidden="true" onclick="querySearch()" style="cursor:pointer"></i>
                        {{-- </button> --}}
                </div>
            </div>
        </form>
        {{--
    </div> --}}
    <table class="table" id="table">
        <thead>
            <th style="text-align: center;"> Item</th>
            <th style="text-align: center; "> Foto </th>
            <th style="text-align: center;"> Nombre </th>
            <th style="text-align: center;"> Correo </th>
            <th style="text-align: center;"> Acciones </th>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td style="text-align: center"> {{ $loop->iteration }}</td>
                <td> <img src="{{ config('constants.Url') }}{{ $user->image }}" alt=""
                        style="height: 50px; width: 50px; object-fit: fill; margin: auto; display: block" />
                </td>
                <td> {{ $user->name }} </td>
                <td> {{ $user->email }}</td>
                <td>
                    <div style="display: flex; justify-content: center; align-items: center">
                        @if (VerifyPermissionsFacade::checkPermissions([config('permissions.canPaginateUpdate')]))

                        <button class="button-sm button__color-primary" onclick="createOrEdit({{ $user }})"
                            title="Editar Usuario {{ $user->name }}"><i class="fa fa-edit"
                                aria-hidden="true"></i></button>
                        @endif
                        @if (VerifyPermissionsFacade::checkPermissions([config('permissions.canPaginateDestroy')]))

                        <form action="{{ route('dataTable.destroy') }}" method="post"
                            style="margin-left: 10px; display: inline-block; " onsubmit="deleteItem({{ $user }})">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="urlIndex" value="{{ $urlIndex }}">
                            <input type="hidden" name="id" value="{{ $user->id }}">

                            <button class="button-sm button__color-red"><i class="fa fa-trash" type="submit"
                                    aria-hidden="true" title="Eliminar Usuario {{ $user->name }}"></i></button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center"> No existen registros para mostrar</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $users->links('vendor.pagination.my-pagination') }}
</div>

@include('shared/modal')

</div>
@endsection