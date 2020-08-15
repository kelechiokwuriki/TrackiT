<?php

namespace App\Services\Utility;

use Carbon\Carbon;

class SlugService
{
    public function createSlugFrom(string $stringToCreateSlugFrom)
    {
        return preg_replace('/\s+/', '-', strtolower($stringToCreateSlugFrom)).'-'.Carbon::now()->timestamp;
    }
}
