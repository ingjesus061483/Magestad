<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Override;

class TasksExport implements FromArray
{
      protected $tasks=[];
    protected $arr=[];

    public function __construct(Builder $task)
    {
       $this->arr=
       [
          [
            "N°",
            "ID",
            "FECHA",
            "CLIENTE",
            "TAREA",
            "COMENTARIOS",
            "TIPO DE TAREA",
            "STATUS"

            ]
        ];
        $this->tasks=$task->get();


    }
    /**
    * @return array
    */
    #[Override]
    public function array(): array
    {
        foreach($this->tasks as $task)
        {
            $this->arr[]=[
                $task->id,
                $task->user_name,
                $task->date,
                $task->client_reference,
                $task->title,
                $task->remark,
                $task->homework_type,
                $task-> state_homework

            ];
        }
        return $this->arr;
    }

        //

}
