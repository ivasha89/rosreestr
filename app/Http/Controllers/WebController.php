<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebController extends Controller
{
    public function show(Request $request) 
    {
        $request->validate([
            'plots' => 'string|min:5'
        ]);
        $requestPlots = explode(',', $request->plots);
        $validatedPlots = new ValidatePlots($requestPlots);
        $plotsArray = $validatedPlots->plotsArray;

        return view('web')
        ->withplots($plotsArray);
    }

    public function hi() {
        return view('welcome');
    }
}
