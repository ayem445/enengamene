<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Session;
use App\Chapitre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\CreateSessionRequest;
use App\Http\Requests\UpdateSessionRequest;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateSessionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Chapitre $chapitre, CreateSessionRequest $request)
    {
        $data = $request->all();
        $data['code'] = uniqid(Str::slug($data['libelle']), true);

        return $chapitre->sessions()->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSessionRequest  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Chapitre $chapitre, Session $session, UpdateSessionRequest $request)
    {
        $session->update($request->all());

        return $session->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapitre $chapitre, Session $session)
    {
        $session->delete();

        return response()->json(['status' => 'ok'], 200);
    }
}
