<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CitiesController extends Controller
{
    public function toView()
    {
        $cities = City::all();
        return view('cities', ['cities'=>$cities]);
    }
}
