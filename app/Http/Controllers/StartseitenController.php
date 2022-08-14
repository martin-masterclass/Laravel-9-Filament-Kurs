<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class StartseitenController extends Controller
{
    public function getStartseitenData(){

        $slider = Property::where('visible', '=', 1)
        ->withWhereHas('media', function ($query){
            $query->where('collection_name', '=', 'slider');
        })
        ->where('slider', '=', 1)
        ->orderBy('updated_at', 'desc')
        ->take(3)
        ->get();

        $neuesteProjekte = Property::where('visible', '=', 1)
            ->withWhereHas('media', function ($query){
                $query->where('collection_name', '=', 'hauptbilder')
                ->orderBy('order_column', 'asc');
            })
            ->orderBy('updated_at', 'desc')
            ->take(4)
            ->get();;

        dd($neuesteProjekte);


        //dd($slider);

        return view('pages.startseite');

    }
}
