<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Module;


class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
         $devices = Device::all();
        

        return view('device_list', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $acao = 1;
          $modules = Module::orderBy('name')->get();



        return view('device_form', compact('acao','modules'));
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
        $log = new \App\Log;
        $log->acao = "Cadastro Dispositivo - " .$request->name;
        $log->user_id = \Auth::user()->id;
        $log->save();
        $inc = Device::create($dados);

        if ($inc) {
            return redirect()->route('device.index')->with('status', $request->name . ' Incluido! ');
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
        $reg = Device::find($id);
        $modules = Module::orderBy('name')->get();
        $acao = 2;
       
        return view('device_form', compact('reg', 'acao','modules'));
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

        $reg = Device::find($id);
        $log = new \App\Log;
        $log->acao = "Alteração Dispositivo - " .$reg->name;
        $log->user_id = \Auth::user()->id;
        $log->save();

        $alt = $reg->update($dados);

        if ($alt) {
            return redirect()->route('device.index')->with('status', $request->name . ' Alterado! ');
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
        $reg = Device::find($id);
        $log = new \App\Log;
        $log->acao = "Exclusão Dispositivo - " .$reg->name;
        $log->user_id = \Auth::user()->id;
        $log->save();

        $reg->delete();
        return redirect()->route('device.index')
                        ->with('status', $reg->name . ' Deletado com Sucesso');
    }
}
