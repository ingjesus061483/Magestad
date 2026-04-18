<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function GetcitiesByName(Request $request)
    {
        $name = $request->name;
        return response()->json(City::select('cities.id')
            ->selectRaw("CONCAT(cities.name, ' | ', states.name) AS name")
            ->join('states', 'cities.state_id', '=', 'states.id')
            ->where('cities.name','like','%'.$name.'%')
            ->orderby('cities.name','asc')
            ->get());
    }
    public function GetCitiesByState($stateId)
    {
        return response()->json(City::where('state_id',$stateId)->orderby('name','asc')->get());
    }
    //
}
