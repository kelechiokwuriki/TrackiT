<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class OneRepMaxCalculatorService extends Controller
{
    private const percentageAndRepitions = [
        '100' => 1,
        '95' => 2,
        '90' => 4,
        '85' => 6,
        '80' => 8,
        '75' => 10,
        '70' => 12,
        '65' => 16,
        '60' => 20,
        '55' => 24,
        '50' => 30
    ];

    public function __construct()
    {

    }

    public function calculateOneRepMax(int $weightLifted)
    {
        $result = [];

        for($i = 1; $i < 12; $i++) {
            $repititions = $i;

            if(($repititions % 2 != 0) && ($repititions > 1) && ($repititions <= 12)) {
                $repititions = $repititions + 1;
            }

            //since double repitions are pushed, then skip
            // if( in_array($repititions, $result ) )
            // {
            //     $repititions = $repititions + 2;
            // }

            $result[$weightLifted] = $repititions;



            Log::debug($result);


            $weightLifted = $weightLifted - 10;
        }

        Log::debug($result);
    }
}
