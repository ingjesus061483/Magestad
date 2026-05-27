<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\FilterRequest;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function filterBy(FilterRequest $request,Builder $builder ): Builder
    {
        if($request->firstdate!=null&&$request->enddate!=null)//dates
        {
            $build=$builder->wherebetween('date', [
                                                        $request->firstdate,
                                                        $request->enddate
                                                    ]);

            if($request->client_id!=null)
            {
                $build=$build->where('client_id',$request->client_id);

            }
            if($request->newness_type_id!=null)
            {
                $build=$build->where('newness_type_id',$request->newness_type_id);

            }
        }
        else if($request->client_id!=null && $request->newness_type_id!=null)
        {
            $build=$builder->where('client_id',$request->client_id)
                                                     ->where('newness_type_id',$request->newness_type_id);
        }
        else if($request->client_id!=null )
        {
            $build=$builder->where('client_id',$request->client_id);

        }
        else if($request->newness_type_id!=null)
        {
            $builder=$builder->where('newness_type_id',$request->newness_type_id);


        }
        else
        {
            $build=$builder;

        }
        return $build;


    }

    public function getImage(Request $request,string $nombre){
        $nombreimagen=null;
        if($request->hasFile('file'))
        {
            $imagen=$request->file('file');
            $nombreimagen=Str::slug($nombre).".".$imagen->guessExtension();
            $ruta=storage_path('app/public/img');
            if (!file_exists($ruta))
            {
                 mkdir($ruta);
            }
            if(file_exists($ruta.'\\'.$nombreimagen))
            {
                unlink($ruta.'\\'.$nombreimagen);
            }
            copy($imagen->getRealPath(),$ruta.'\\'.$nombreimagen);
        }
        return $nombreimagen;
    }


}
