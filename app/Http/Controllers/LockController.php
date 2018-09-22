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
        
        $reg = DB::table('users')->where('rf_key', $mensagem)->first();
        
        if(!empty($reg)){
            //return "encontrado"; 
            return $this->sendData("lock12", "25");
            
            
        }else{
            return "não encontrado";
        }

       
        
       // return $this->sendData("tfeyfewuguwyeg", $nome);

        
        
       
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

        if ($inc) {
            return redirect()->route('lock.index')->with('status', $request->nome . ' Incluido! ');
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

        $alt = $reg->update($dados);

        if ($alt) {
            return redirect()->route('lock.index')->with('status', $request->nome . ' Alterado! ');
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

        $reg->delete();
        return redirect()->route('lock.index')
                        ->with('status', $reg->nome . ' Deletado com Sucesso');
    }

}
