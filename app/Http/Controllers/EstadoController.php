<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;
use App\Http\Resources\EstadoResource;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $estados = Estado::all();

        return EstadoResource::collection($estados);
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
            'name' => 'required|unique:estados'
        ]);

        $input = $request->all();
        $input['creator_id'] = auth()->id();

        $estado = Estado::create($input);

        return new EstadoResource($estado);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(Estado $estado)
    {
        return new EstadoResource($estado);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado $estado)
    {
        $input = $request->all();
        $input['creator_id'] = auth()->id();

        $estado->update($input);

        return new EstadoResource($estado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estado $estado)
    {
        $estado->delete();

        return response(['message'=>'Deleted']);
    }
}
