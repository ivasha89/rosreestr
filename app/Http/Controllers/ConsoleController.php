<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plot;

class ConsoleController extends Controller
{
    /**
     * Команда для консоли прописана в файле console.php в папке routes
     */
    public static function show($command) {
        $validatedPlots = new ValidatePlots($command->arguments()['plot']);
        $plotsArray = $validatedPlots->plotsArray;
        $command->table(
            ['CN', 'Addr', 'Price', 'Area'],
            $plotsArray
        );
    }
}
