<?php

namespace App\Repositories;

use App\Exercise;
use App\Repositories\BaseRepository;

class ExerciseRepository extends BaseRepository
{
    protected $exerciseModel;

    public function __construct(Exercise $exerciseModel)
    {
        parent::__construct($exerciseModel);
    }
}
