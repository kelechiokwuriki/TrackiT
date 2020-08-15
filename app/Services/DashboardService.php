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

    public function getAllSessionsForLoggedInUser()
    {
        return $this->sessionRepository->getSessionsForLoggedInUser()->get();
    }

    public function getTotalSessionsCountForLoggedInUser()
    {
        return $this->sessionRepository->getSessionsForLoggedInUser()->count();
    }

    public function getLastSessionForLoggedInUser()
    {
        return $this->sessionRepository->getSessionsForLoggedInUser()->orderBy('created_at', 'DESC')->first();
    }
}
