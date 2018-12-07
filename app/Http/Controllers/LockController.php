<?php

namespace App\Http\Controllers;

use App\Lock;
use App\Module;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LockController extends Controller {

    public function receiveData(Request $request) {

        $bodyContent = $request->getContent();
        $str = explode(',', $bodyContent);
        $topico = $str[0];
        $mensagem = $str[1];
        $lock = DB::table('modules')->where('pub_topic', $topico)->first();
        $cad = DB::table('users')->where('rf_key', $topico)->first();
        if (!empty($cad)) {
               
            $userId = $cad->id;
            $user = User::Find($userId);
            $alt = $user->update(['rf_key' => trim($mensagem)]);
            return $this->sendData($lock->sub_topic, "cad");
        }

        $reg = DB::table('users')->where('rf_key', trim($mensagem))->first();

        if (!empty($reg)) {

            return $this->sendData($lock->sub_topic, "open");
        } else {
            return $this->sendData($lock->sub_topic, "block");
        }
    }

    public function openWeb(Request $request) {

        $lockid = $request->id;
        $lock = Lock::Find($lockid);
        $this->sendData($lock->module->sub_topic, "open");

        return redirect()->route('lock.index')->with('status', 'Porta Aberta ');
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
    public function select($user) {
        $locks = Lock::all();


        return view('lock_select', compact('locks','user'));
    }
    
    public function index() {
        $locks = Lock::all();


        return view('lock_list', compact('locks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $acao = 1;
        $modules = Module::orderBy('name')->get();
       

        return view('lock_form', compact('acao', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $dados = $request->all();
        $inc = Lock::create($dados);
        $log = new \App\Log;
        $log->acao = "Cadastro Tranca - " .$request->name;
        $log->user_id = \Auth::user()->id;
        $log->save();

        if ($inc) {
            return redirect()->route('lock.index')->with('status', $request->name . ' Incluido! ');
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
        $reg = Lock::find($id);
        $modules = Module::orderBy('name')->get();
        $acao = 2;

        return view('lock_form', compact('reg', 'acao', 'modules'));
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

        $reg = Lock::find($id);
        $log = new \App\Log;
        $log->acao = "Alteração Tranca - " .$reg->name;
        $log->user_id = \Auth::user()->id;
        $log->save();

        $alt = $reg->update($dados);

        if ($alt) {
            return redirect()->route('lock.index')->with('status', $request->name . ' Alterado! ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $reg = Lock::find($id);
        $log = new \App\Log;
        $log->acao = "Exclusão Tranca - " .$reg->name;
        $log->user_id = \Auth::user()->id;
        $log->save();

        $reg->delete();
        return redirect()->route('lock.index')
                        ->with('status', $reg->name . ' Deletado com Sucesso');
    }

}
