<?php

namespace App\Services;

use App\Repositories\ExerciseRepository;

class ExerciseService
{
    protected $exerciseRepository;

    public function __construct(ExerciseRepository $exerciseRepository)
    {
        $this->exerciseRepository = $exerciseRepository;
    }

    public function transformExerciseData(array $exerciseData)
    {
        return [
            'session_id' => $exerciseData['session_id'],
            'user_id' => $exerciseData['user_id'],
            'name' => $exerciseData['name'],
            'reps' => $exerciseData['reps'],
            'sets' => $exerciseData['sets'],
            'weight_number' => $exerciseData['weight_number'],
            'weight_type' => $exerciseData['weight_type']
        ];
    }
}
