<?php

namespace App\Http\Controllers;

use App\Models\FormClass;
use Illuminate\Http\Request;

class FormClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [];
        $data['madarasa'] = FormClass::get();
        return view('madarasa.index', $data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormClass  $formClass
     * @return \Illuminate\Http\Response
     */
    public function show(FormClass $formClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormClass  $formClass
     * @return \Illuminate\Http\Response
     */
    public function edit(FormClass $formClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormClass  $formClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormClass $formClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormClass  $formClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormClass $formClass)
    {
        //
    }
}
