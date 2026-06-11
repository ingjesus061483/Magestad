<form action="{{$action}}" method="POST">
    @csrf
    @method('DELETE')
    <button title="Eliminar " type="button" onclick="validar(this,'¿Desea eliminar el registro?')" class="btn btn-danger btn-sm">
        <i class="fa-solid fa-trash"></i>
    </button>
</form>
