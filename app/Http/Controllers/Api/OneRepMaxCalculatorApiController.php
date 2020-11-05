<?php

namespace App\Http\Controllers\Api;

use App\Services\OneRepMaxCalculatorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class OneRepMaxCalculatorApiController extends Controller
{
    protected $oneRepMaxCalcService;

    public function __construct(OneRepMaxCalculatorService $oneRepMaxCalcService)
    {
        $this->oneRepMaxCalcService = $oneRepMaxCalcService;
    }

    public function calculateOneRepMax(Request $request)
    {
        $oneRepMax = $request->get('lift');

        return $this->oneRepMaxCalcService->calculateOneRepMax($oneRepMax);
    }


}
