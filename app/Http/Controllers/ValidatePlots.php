<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ValidatePlots
{
    public $plotsArray = [];

    public function __construct(array $array)
    {
        foreach($array as $value) {
            $kadastrNumber = explode(':', trim($value));
            $kadastrNumber[2] = ltrim($kadastrNumber[2], '0');
            $kadastrNumberWithoutLeedingNull = implode(':', $kadastrNumber);
            $answer = json_decode(Http::get("https://pkk.rosreestr.ru/api/features/1/".$kadastrNumberWithoutLeedingNull), true);
            if (isset($answer['feature']['attrs'])) {
                $response = $answer['feature']['attrs'];
                try {
                    $plot = Plot::where('number', trim($value))->firstOrFail();
                    if ($plot->cad_cost != $response['cad_cost']) {
                        $plot->cad_cost = $response['cad_cost'];
                        $plot->save();
                    }
                }
                catch (ModelNotFoundException $exception) {
                    $plot = Plot::create([
                        'cad_cost' => $response['cad_cost'],
                        'area_value' => $response['area_value'],
                        'address' => $response['address'],
                        'number' => $response['cn'],
                    ]);
                }
                $this->plotsArray[] = $plot->toArray();
            }
        }
    }
}
