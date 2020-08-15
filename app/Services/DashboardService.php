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

    public function getDashBoardData()
    {
        $totalSessions = $this->sessionRepository->all()->count();
        $lastSession = $this->sessionRepository->getByOrder('created_at', 'DESC')->first();
        $lastestBodyWeight = $lastSession->bodyWeight;

    }
}
