<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;

class ModuleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $modules = \App\Module::all();

        return view('module_list', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $acao = 1;



        return view('module_form', compact('acao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // $dados = $request->all();
        // $inc = Module::create($dados);


        $nome = $request->name;

        $inc = new Module;
        $inc->name = $nome;
        $inc->pub_topic = 'pub_' . $nome;
        $inc->sub_topic = 'sub_' . $nome;
        $inc->save();
        $log = new \App\Log;
        $log->acao = "Cadastro Modulo - " . $request->name;
        $log->user_id = \Auth::user()->id;
        $log->save();

        if ($inc) {
            return redirect()->route('module.index')->with('status', $request->name . ' Incluido! ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $reg = Module::find($id);
        $acao = 2;

        return view('module_form', compact('reg', 'acao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $dados = $request->all();

        $reg = Module::find($id);
        $log = new \App\Log;
        $log->acao = "Alteração Modulo - " .$reg->name;
        $log->user_id = \Auth::user()->id;
        $log->save();

        $alt = $reg->update($dados);

        if ($alt) {
            return redirect()->route('module.index')->with('status', $request->name . ' Alterado! ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $reg = Module::find($id);
        $log = new \App\Log;
        $log->acao = "Exclusão Modulo - " .$reg->name;
        $log->user_id = \Auth::user()->id;
        $log->save();

        $reg->delete();
        return redirect()->route('module.index')
                        ->with('status', $reg->name . ' Deletado com Sucesso');
    }

}
