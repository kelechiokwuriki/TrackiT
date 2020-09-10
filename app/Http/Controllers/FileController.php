<?php

namespace App\Http\Controllers;

use App\Repositories\SessionRepository;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;


class FileController extends Controller
{
    protected $sessionRepository;

    public function __construct(SessionRepository $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    public function generatePdfFile($sessionSlug)
    {
        $session = $this->sessionRepository->where('slug', $sessionSlug)->first();

        // share data to view
        view()->share('session', $session);
        $pdf = PDF::loadView('pdf.singlesession', $session);

        return $pdf->stream();
    }
}
