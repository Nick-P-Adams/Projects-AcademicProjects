<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CitiesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $all_cities = \App\Models\City::all();
        return view('cities.index', ['cities' => $all_cities]);
    }

}
