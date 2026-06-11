<div class="card mb-4" style="width: 100%; display:none" id="importForm">
    <div class="card-header">
      <i class="fa-solid fa-cloud-arrow-up"></i>
        Importar desde excel:
    </div>
    <div class="card-body">
        <form method="post" id="frmImportExcel" action="{{$action}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for=""style="font-size:14px" >Seleccionar archivo</label>
                        <input type="file" class="form-control" name="file" style="font-size:12px;" accept=".xls,.xlsx" id="fileExcel">
                    </div>
                </div>
            </div>
            <div class="justify-content-end d-flex">
                    <button title="Ocultar filtro" type="button" class="btn btn-secondary me-2" id="btnCloseImportExcel">
                        <i class="fa-solid fa-eye-slash"></i>
                    </button>
                    <button title="Importar" type="submit" class="btn btn-success">
                        <i class="fas fa-file-import"></i>
                    </button>

            </div>
        </form>
    </div>
    <div class="card-footer text-muted">
        El archivo debe tener el formato de ejemplo:
        <ul>
            <li>Tareas: descargarlo <a href="{{url('Homework/downloadTemplate/1')}}" target="_blank">aquí</a></li>
            <li>Novedades: descargarlo <a href="{{url('Newness/downloadTemplate/1')}}" target="_blank">aquí</a></li>
        </ul>
    </div>
</div>
