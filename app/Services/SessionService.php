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

    public function updateOrCreateSession(array $session, $sessionId = null)
    {
        if(!isset($session) || empty($session)) {
            throw new Exception('Session is empty. Could not create');
        }

        $sessionAttributes = $this->transformSessionData($session);

        try {
            //session id present means we are updating
            if($sessionId) {
                $sessionResult = $this->sessionRepository->update($sessionId, $sessionAttributes);

                $this->updateOrCreateExercisesForSession($session, $sessionId);

                return $session;
            }

            //no sesson id so lets make a new one
            $sessionResult = $this->sessionRepository->create($sessionAttributes);

            if($sessionResult) {
                $this->updateOrCreateExercisesForSession($session, $sessionResult->id);
            }

            return $session;
        } catch(Exception $e) {
            Log::debug(self::class . 'Error updating/creating session with data: ' . $session . ' Reason: ' . $e->getMessage());
        }
    }

    public function deleteSession(int $id)
    {
        try {
            return $this->sessionRepository->delete($id);
        } catch (Exception $e) {
            Log::debug(self::class . 'Error deleting session with id: ' . $id . ' Reason: ' . $e->getMessage());
        }
    }

    public function getSessionBySlug(string $slug)
    {
        try{
            return $this->sessionRepository->where('slug', $slug)->first();
        } catch(Exception $e) {
            Log::debug(self::class . 'Error fetching session with slug: ' . $slug . ' Reason: ' . $e->getMessage());
        }
    }

    public function getSessionForLoggedInUser()
    {
        try{
            return $this->sessionRepository->getSessionsForLoggedInUser()->get();
        } catch(Exception $e) {
            Log::debug(self::class . 'Error fetching session, reason: ' . $e->getMessage());
        }
    }

    public function transformSessionData(array $sessionData)
    {
        return [
            'name' => $sessionData['name'],
            'user_id' => auth()->id(),
            'body_weight' => $sessionData['body_weight'],
            'slug' => $this->slugService->createSlugFrom($sessionData['name'])
        ];
    }

    private function updateOrCreateExercisesForSession(array $exercises, int $sessionId)
    {
        try {
            foreach($exercises['exercises'] as $exercise) {
                $exercise['session_id'] = $sessionId;
                $exercise['user_id'] = auth()->id();

                if($this->exerciseRepository->where('id', $exercise['id'])->exists()) {
                    $this->exerciseRepository->update($exercise['id'], $exercise);
                } else {
                    $this->exerciseRepository->create($exercise);
                }
            }
        } catch(Exception $e) {
            Log::debug(self::class . 'Error updating/creating exercises with data:' . $exercises . 'reason: ' . $e->getMessage());
        }
    }
}
