<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Sensor;
use App\Sensor_Data;
use Illuminate\Support\Facades\DB;

class SensorController extends Controller {

    public function receiveData(Request $request) {

        $bodyContent = $request->getContent();
        $str = explode(',', $bodyContent);
        $topico = $str[0];
        $mensagem = $str[1];

        $module = DB::table('modules')->where('pub_topic', $topico)->first();
        $sensor = DB::table('sensors')->where('module_id', $module->id)->first();

        if (!empty($sensor)||!empty($module)) {

            $sensor_data = new Sensor_Data;
            $sensor_data->data = $mensagem;
            $sensor_data->sensor_id = $sensor->id;
            $sensor_data->save();
            return;
        }
        return;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $sensors = Sensor::all();


        return view('sensor_list', compact('sensors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $acao = 1;
        $modules = Module::orderBy('name')->get();



        return view('sensor_form', compact('acao', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $dados = $request->all();
        $inc = Sensor::create($dados);

        if ($inc) {
            return redirect()->route('sensor.index')->with('status', $request->nome . ' Incluido! ');
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
        $reg = Sensor::find($id);
        $modules = Module::orderBy('name')->get();
        $acao = 2;

        return view('sensor_form', compact('reg', 'acao', 'modules'));
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

        $reg = Sensor::find($id);

        $alt = $reg->update($dados);

        if ($alt) {
            return redirect()->route('sensor.index')->with('status', $request->nome . ' Alterado! ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $reg = Sensor::find($id);

        $reg->delete();
        return redirect()->route('sensor.index')
                        ->with('status', $reg->nome . ' Deletado com Sucesso');
    }

}
