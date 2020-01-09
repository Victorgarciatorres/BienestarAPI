<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\application;
use App\Helper\Token;

class applicationController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $application = new application();
        if(!$application->applicationExists($request->name))
        {
            $application->new_application($request);
        return response()->json(["Success" => "Se ha añadido la aplicacion correctamente"]);
        }else{
            return response()->json(["Error" => "La aplicacion no se ha añadido correctamente"]);
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $application = application::where('name', $request->name)->first();
        $application->name = $request->new_name;
        $application->icon = $request->new_icon;

        $application->update();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $application = application::where('name', $request->name)->first();
        
        $application->delete();   
    }
}