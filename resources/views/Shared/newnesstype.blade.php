<label for="newness_type_id" class="col-form-label" style="font-size:14px">Tipo de Novedad</label>
<input type="text" value="{{ $newness_type_name ?? $newness_type?->name ??  old('newness_type') }}" class="form-control" name="newness_type" style="font-size:12px" id="newsness_type">
<input type="hidden" class="form-control" value="{{ $newness_type_id ?? $newness_type?->id ??  old('newness_type_id') }}" name="newness_type_id" style="font-size:12px" id="newsness_type_id">
