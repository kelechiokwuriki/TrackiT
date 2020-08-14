<?php

namespace App\Repositories;

use App\Session;
use App\Repositories\BaseRepository;

class SessionRepository extends BaseRepository
{
    protected $sessionModel;

    public function __construct(Session $sessionModel)
    {
        parent::__construct($sessionModel);
    }
}
