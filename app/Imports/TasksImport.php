<?php

namespace App\Imports;

use App\Models\Homework;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class TasksImport implements ToModel,WithHeadingRow,WithValidation,
                             WithBatchInserts,WithChunkReading
{
    public function prepareForValidation(array $data, $index)
    {
        $data['date'] = Date::excelToDateTimeObject($data['date'])->format('Y-m-d');
        $data['task'] =trim($data['task'] ?? '');
        $data['remark'] =trim($data['remark'] ?? '');
        $data['user_id'] = (int) $data['user_id'];
        $data['client_id'] = (int) $data['client_id'];
        $data['state_homework_id'] = (int) $data['state_homework_id'];
        $data['homework_type_id'] = (int) $data['homework_type_id'];
        return $data;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Homework([
            'user_id' => $row['user_id'],
            'date' => $row['date'],
            'client_id' => $row['client_id'],
            'task' => $row['task'],
            'remark' => $row['remark'] ?? null,
            'state_homework_id' => $row['state_homework_id'],
            'homework_type_id' => $row['homework_type_id'],
            //
        ]);
    }
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'client_id' => 'required|exists:clients,id',
            'task' => 'required|string',
            'remark' => 'nullable|string',
            'state_homework_id' => 'required|exists:state_homework,id',
            'homework_type_id' => 'required|exists:homework_types,id',
        ];
    }
    public function customValidationMessages()
    {
        return [
            'user_id.required' => 'El campo :attribute es obligatorio.',
            'user_id.exists' => 'El :attribute proporcionado no existe en la tabla users.',
            'date.required' => 'El campo :attribute es obligatorio.',
            'date.date' => 'El campo :attribute debe ser una fecha válida.',
            'client_id.required' => 'El campo :attribute es obligatorio.',
            'client_id.exists' => 'El :attribute proporcionado no existe en la tabla clients.',
            'task.required' => 'El campo :attribute es obligatorio.',
            'task.string' => 'El campo :attribute debe ser una cadena de texto.',
            'remark.string' => 'El campo :attribute debe ser una cadena de texto.',
            'state_homework_id.required' => 'El campo :attribute es obligatorio.',
            'state_homework_id.exists' => 'El :attribute proporcionado no existe en la tabla state_homeworks.',
            'homework_type_id.required' => 'El campo :attribute es obligatorio.',
            'homework_type_id.exists' => 'El :attribute proporcionado no existe en la tabla homework_types.',
        ];
    }
    public function customValidationAttributes()
    {
        return [
            'user_id' => 'ID de usuario',
            'date' => 'fecha',
            'client_id' => 'ID de cliente',
            'task' => 'tarea',
            'remark' => 'observación',
            'state_homework_id' => 'ID de estado de tarea',
            'homework_type_id' => 'ID de tipo de tarea',
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
