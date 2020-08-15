<?php

namespace App\Services;

use App\Repositories\SessionRepository;

class DashboardService
{
    protected $sessionRepository;

    public function __construct(SessionRepository $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    public function getTotalSessions()
    {
        return $this->sessionRepository->all()->count();
    }

    public function getLastSession()
    {
        return $this->sessionRepository->getByOrder('created_at', 'DESC')->first();
    }
}
