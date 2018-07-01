<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\light;
use App\module;

class LightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $lights = light::all();
        

        return view('light_list', compact('lights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $acao = 1;
          $modules = module::orderBy('name')->get();



        return view('light_form', compact('acao','modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $dados = $request->all();
        $inc = light::create($dados);

        if ($inc) {
            return redirect()->route('light.index')->with('status', $request->nome . ' Incluido! ');
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
        $reg = light::find($id);
        $modules = module::orderBy('name')->get();
        $acao = 2;
       
        return view('light_form', compact('reg', 'acao','modules'));
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
         $dados = $request->all();

        $reg = light::find($id);

        $alt = $reg->update($dados);

        if ($alt) {
            return redirect()->route('light.index')->with('status', $request->nome . ' Alterado! ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reg = light::find($id);

        $reg->delete();
        return redirect()->route('light.index')
                        ->with('status', $reg->nome . ' Deletado com Sucesso');
    }
}
