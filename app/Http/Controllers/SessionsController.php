<?php

namespace App\Http\Controllers;

use App\Http\Resources\SessionResource;
use App\Services\SessionService;
use Illuminate\Http\Request;

use function GuzzleHttp\json_encode;

class SessionsController extends Controller
{
    protected $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('session.mysessions');
    }

    public function mysessions()
    {
        return view('session.mysessions');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('session.addsession');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $sessionFound = $this->sessionService->getSessionBySlug($slug);

        if($sessionFound) {
            return view('session.viewmysession')->with(['session' => json_encode(new SessionResource($sessionFound))]);

        }

        return redirect('/home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $sessionFound = $this->sessionService->getSessionBySlug($slug);

        if($sessionFound) {
            return view('session.editsession')->with(['session' => json_encode(new SessionResource($sessionFound))]);
        }

        return redirect('/home');
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
