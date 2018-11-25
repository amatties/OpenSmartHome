<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Light;
use App\Module;
use Illuminate\Support\Facades\DB;

class LightController extends Controller {
    
    
     public function command(Request $request) {
        $port = $request->port;
        $id = $request->id;
        $port_status = $request->port_status;

        $msg = "" . $port . "" . $port_status . "";

        $reg = Light::find($id);
        $pub_topic = $reg->module->sub_topic;
        $dest = $reg->port_status;
        if ($dest == 0) {
            $alt = $reg->update(['port_status' => 1]);
            if ($alt) {
                $this->sendData($pub_topic, $msg);

                return redirect()->route('light.index')->with('status2', $reg->name . ' Desligada! ');
            }
        } else {
            $alt = $reg->update(['port_status' => 0]);
            if ($alt) {
                $this->sendData($pub_topic, $msg);

                return redirect()->route('light.index')->with('status', $reg->name . ' Ligada! ');
            }
        }
    }

    public function command2(Request $request) {
        $port = $request->port;
        $id = $request->id;
        $port_status = $request->port_status;

        $msg = "" . $port . "" . $port_status . "";

        $reg = Light::find($id);
        $pub_topic = $reg->module->sub_topic;
        $dest = $reg->port_status;
        if ($dest == 0) {
            $alt = $reg->update(['port_status' => 1]);
            if ($alt) {
                $this->sendData($pub_topic, $msg);

                return redirect()->route('light.index')->with('status2', $reg->name . ' Desligada! ');
            }
        } else {
            $alt = $reg->update(['port_status' => 0]);
            if ($alt) {
                $this->sendData($pub_topic, $msg);

                return redirect()->route('light.index')->with('status', $reg->name . ' Ligada! ');
            }
        }
    }

    public function sendData($topico, $mensagem) {

        $server = "127.0.0.1";
        $port = 1883;
        $username = "";
        $password = "";
        $client_id = "clienteweb";
        $mqtt = new phpMQTT($server, $port, $client_id);
        if ($mqtt->connect(true, NULL, $username, $password)) {
            $mqtt->publish($topico, $mensagem, 0);

            $mqtt->close();
        }
        return;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $lights = Light::all();


        return view('light_list', compact('lights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $acao = 1;
        $modules = Module::orderBy('name')->get();



        return view('light_form', compact('acao', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $dados = $request->all();
        $inc = Light::create($dados);

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
        $reg = Light::find($id);
        $modules = Module::orderBy('name')->get();
        $acao = 2;

        return view('light_form', compact('reg', 'acao', 'modules'));
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

        $reg = Light::find($id);

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
    public function destroy($id) {
        $reg = Light::find($id);

        $reg->delete();
        return redirect()->route('light.index')
                        ->with('status', $reg->nome . ' Deletado com Sucesso');
    }

}
