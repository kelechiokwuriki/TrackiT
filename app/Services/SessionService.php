<?php

namespace App\Services;

use App\Repositories\ExerciseRepository;
use App\Repositories\SessionRepository;
use App\Services\Utility\SlugService;
use Exception;
use Illuminate\Support\Facades\Log;

class SessionService
{
    protected $sessionRepository;
    protected $exerciseRepository;
    protected $slugService;

    public function __construct(SessionRepository $sessionRepository,
    ExerciseRepository $exerciseRepository, SlugService $slugService)
    {
        $this->sessionRepository = $sessionRepository;
        $this->exerciseRepository = $exerciseRepository;
        $this->slugService = $slugService;
    }

    public function createSession(array $session)
    {
        if(!isset($session) || empty($session)) {
            throw new Exception('Session is empty. Could not create');
        }

        $sessionAttributes = $this->transformSessionData($session);

        try {
            $sessionResult = $this->sessionRepository->create($sessionAttributes);

            if($sessionResult) {
                $this->createExercisesForSession($session, $sessionResult->id);
            }

            return $session;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getSessionForLoggedInUser()
    {
        try{
            return $this->sessionRepository->getSessionsForLoggedInUser()->get();
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function transformSessionData(array $sessionData)
    {
        return [
            'name' => $sessionData['name'],
            'user_id' => $sessionData['user_id'],
            'body_weight' => $sessionData['body_weight'],
            'slug' => $this->slugService->createSlugFrom($sessionData['name'])
        ];
    }

    private function createExercisesForSession(array $exercises, int $sessionId)
    {
        foreach($exercises['exercises'] as $exercise) {
            $exercise['session_id'] = $sessionId;
            $exercise['user_id'] = $exercises['user_id'];

            try {
                $this->exerciseRepository->create($exercise);
            } catch(Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
    }
}
