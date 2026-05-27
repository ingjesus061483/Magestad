<form action="{{$action}}" method="POST">
    @csrf
    @method('DELETE')
    <button title="Eliminar Tarea" type="button" onclick="validar(this,'¿Desea eliminar el registro?')" class="btn btn-danger">
        <i class="fa-solid fa-trash"></i>
    </button>
</form>
