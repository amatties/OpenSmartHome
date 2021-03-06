<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\Sensor;
use App\Sensor_Data;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SensorController extends Controller {

    public function receiveData(Request $request) {

        $bodyContent = $request->getContent();
        $str = explode(',', $bodyContent);
        $topico = $str[0];
        $mensagem = $str[1];
        $str2 = explode('-', $mensagem);

        $module = DB::table('modules')->where('pub_topic', $topico)->first();
        $sensor = DB::table('sensors')->where('module_id', $module->id)->first();

        if (!empty($sensor) || !empty($module)) {

            $sensor_data = new Sensor_Data;
            $sensor_data->data = $str2[0];
            $sensor_data->type = trim($str2[1]);
            $sensor_data->sensor_id = $sensor->id;
            $sensor_data->save();
            return;
        }
        return;
    }

    public function show_graph_filter(Request $request, $id) {

        $request->validate([
            'time' => 'required',
        ]);


        $date = $request->time;
        $id = $request->id;
        $sensors = DB::table('sensor_datas')
                ->where('sensor_id', $id)
                ->whereDate('created_at', '=', $date)
                ->get();
        if (!empty($sensors)) {
            
        }
        $tipos = Sensor_Data::select('type')
                ->where('sensor_id', $id)
                ->groupBy('type')
                ->get();
        $num = count($tipos);

        return view('show_graph', compact('sensors', 'num', 'tipos', 'id'));
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
        $log = new \App\Log;
        $log->acao = "Cadastro Sensor - " .$request->name;
        $log->user_id = \Auth::user()->id;
        $log->save();

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

        $date = Carbon::today()->toDateString();

        $sensors = DB::table('sensor_datas')
                ->where('sensor_id', $id)
                ->whereDate('created_at', '=', $date)
                ->get();
        $tipos = Sensor_Data::select('type')
                ->where('sensor_id', $id)
                ->groupBy('type')
                ->get();
        $num = count($tipos);

        return view('show_graph', compact('sensors', 'num', 'tipos', 'id'));
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
        $log = new \App\Log;
        $log->acao = "Alteração Sensor - " .$reg->name;
        $log->user_id = \Auth::user()->id;
        $log->save();

        $alt = $reg->update($dados);

        if ($alt) {
            return redirect()->route('sensor.index')->with('status', $request->name . ' Alterado! ');
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
        $log = new \App\Log;
        $log->acao = "Exclusão Sensor - " .$reg->name;
        $log->user_id = \Auth::user()->id;
        $log->save();

        $reg->delete();
        return redirect()->route('sensor.index')
                        ->with('status', $reg->name . ' Deletado com Sucesso');
    }

}
