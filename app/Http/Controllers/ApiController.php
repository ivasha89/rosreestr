<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the plots.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show() {
        $getPlotsFromDatabase = Plot::all()->pluck('number')->toArray();
        $validatePlots = new ValidatePlots($getPlotsFromDatabase);
        $plotsArray = $validatePlots->plotsArray;

        return response()->json($plotsArray);
    }
}
