<?php

namespace App\Http\Controllers;

use App\Proprietario;
use Illuminate\Http\Request;
use App\Http\Resources\ProprietarioResource;

class ProprietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $proprietarios = Proprietario::all();

        return ProprietarioResource::collection($proprietarios);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:proprietarios'
        ]);

        $input = $request->all();
        $input['creator_id'] = auth()->id();

        $proprietario = Proprietario::create($input);

        return new ProprietarioResource($proprietario);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proprietario  $proprietario
     * @return \Illuminate\Http\Response
     */
    public function show(Proprietario $proprietario)
    {
        return new ProprietarioResource($proprietario);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proprietario  $proprietario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proprietario $proprietario)
    {
        $input = $request->all();
        $input['creator_id'] = auth()->id();

        $proprietario->update($input);

        return new ProprietarioResource($proprietario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proprietario  $proprietario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proprietario $proprietario)
    {
        $proprietario->delete();

        return response(['message'=>'Deleted']);
    }
}
