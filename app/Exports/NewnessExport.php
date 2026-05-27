<?php

namespace App\Exports;

use App\Models\Newness;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromArray;
use Override;

class NewnessExport implements FromArray
{
     protected $newness=[];
    protected $arr=[];
    public function __construct(Builder $newness)
    {
        $this->arr=
        [
            ["N°",
             "ID",
             "FECHA",
             "CLIENTE",
             "TIPO DE NOVEDAD",
             "NOVEDAD",
             "STATUS"]
        ];
        $this->newness=$newness->get();

    }
    /**
    * @return array
    */
    #[Override]
    public function array(): array
    {
        foreach($this->newness as $newness)
        {
            $this->arr[]=[
                $newness->id,
                $newness->user,
                 date("d/m/Y", strtotime($newness->date)),
                 $newness->client_reference,
                 $newness->newness_type,
                 $newness->remark,
                 $newness->status
            ];
        }

        return $this-> arr;
    }
}
