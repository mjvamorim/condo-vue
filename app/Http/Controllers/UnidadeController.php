<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;
use App\Http\Resources\UnidadeResource;

class UnidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $unidades = Unidade::all();

        return UnidadeResource::collection($unidades);
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
            'name' => 'required|unique:unidades'
        ]);

        $input = $request->all();
        $input['creator_id'] = auth()->id();

        $unidade = Unidade::create($input);

        return new UnidadeResource($unidade);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function show(Unidade $unidade)
    {
        return new UnidadeResource($unidade);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unidade $unidade)
    {
        $input = $request->all();
        $input['creator_id'] = auth()->id();

        $unidade->update($input);

        return new UnidadeResource($unidade);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidade $unidade)
    {
        $unidade->delete();

        return response(['message'=>'Deleted']);
    }
}
