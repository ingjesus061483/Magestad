<?php

namespace App\Imports;

use App\Models\Newness;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class NewnessImport implements ToModel,WithHeadingRow,WithValidation,
                               WithBatchInserts,WithChunkReading
{
    public function prepareForValidation(array $data, $index)
    {
        $data['date'] = Date::excelToDateTimeObject($data['date'])->format('Y-m-d');
        $data['remark'] =trim($data['remark'] ?? '');
        $data['user_id'] = (int) $data['user_id'];
        $data['client_id'] = (int) $data['client_id'];
        $data['state_newness_id'] = (int) $data['state_newness_id'];
        $data['newness_type_id'] = (int) $data['newness_type_id'];
        return $data;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Newness([
            'user_id' => $row['user_id'],
            'date' => $row['date'],
            'client_id' => $row['client_id'],
            'newness_type_id' => $row['newness_type_id'],
            'remark' => $row['remark'] ?? null,
            'state_newness_id' => $row['state_newness_id'],
            //
        ]);
    }
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'client_id' => 'required|exists:clients,id',
            'newness_type_id' => 'required|exists:newness_types,id',
            'remark' => 'nullable|string',
            'state_newness_id' => 'required|exists:state_newness,id',
        ];
    }
    public function customValidationMessages()
    {
        return [
            'user_id.required' => 'El campo :attribute es obligatorio.',
            'user_id.exists' => 'El :attribute proporcionado no existe en la tabla users.',
            'date.required' => 'El campo :attribute es obligatorio.',
            'client_id.required' => 'El campo :attribute es obligatorio.',
            'client_id.exists' => 'El :attribute proporcionado no existe en la tabla clients.',
            'newness_type_id.required' => 'El campo :attribute es obligatorio.',
            'newness_type_id.exists' => 'El :attribute proporcionado no existe en la tabla newness_types.',
            'remark.string' => 'El campo :attribute debe ser una cadena de texto.',
            'state_newness_id.required' => 'El campo :attribute es obligatorio.',
            'state_newness_id.exists' => 'El :attribute proporcionado no existe en la tabla state_newness.',
        ];
    }
    public function customValidationAttributes(){
        return [
            'user_id' => 'ID de usuario',
            'date' => 'fecha',
            'client_id' => 'ID de cliente',
            'newness_type_id' => 'ID de tipo de novedad',
            'remark' => 'observación',
            'state_newness_id' => 'ID de estado de novedad',
        ];
    }
    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
