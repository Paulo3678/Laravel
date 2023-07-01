<?php

namespace App\Http\Controllers;

use App\Models\Serie;

class SeasonsController extends Controller
{
    public function index(Serie $series)
    {

        /** Eager loading-> Já faz a busca dizendo que quer outros dados junto */
        $seasons = $series->temporadas()->with('episodes')->get();

        return view("seasons.index")->with("seasons", $seasons);
    }
}
