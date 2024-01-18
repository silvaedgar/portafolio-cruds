@if (VerifyPermissionsFacade::checkPermissions([config('permissions.canDtssUpdate')]))
<button class="button-sm button__color-primary" id="{{ $id }}" onclick="createOrEdit()"
    title="Editar Usuario {{ $name }}"><i class="fa fa-edit" aria-hidden="true" id="{{ $id }}"></i>
</button>
@endif
@if (VerifyPermissionsFacade::checkPermissions([config('permissions.canDtssDestroy')]))
<form action="{{ route('dataTable.destroy') }}" method="post" onsubmit="deleteItem()" id="{{ $id }}"
    style="margin-left: 10px; display: inline-block; text-align: center">
    @csrf
    @method('delete')
    <input type="hidden" name="id" value="{{ $id }}">

    <button class="button-sm button__color-red" id="{{ $id }}"><i class="fa fa-trash" type="submit" aria-hidden="true"
            title="Eliminar Usuario {{ $name }}"></i></button>
</form>
@endif