<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Light;

class ScheduleController extends Controller
{
    
    public function novo($id) {
        
        
        
        $reg = Light::find($id);
         
        



//$acao = 1;
       
        // return view('schedule_form', compact('acao','id'));
    }
    
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index() {
        $schedules = Schedule::all();


        return view('schedule_list', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $acao = 1;
       



        return view('schedule_form', compact('acao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $dados = $request->all();
        $inc = Schedule::create($dados);

        if ($inc) {
            return redirect()->route('schedule.index')->with('status', $request->nome . ' Incluido! ');
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

        $reg = Schedule::find($id);

        $alt = $reg->update($dados);

        if ($alt) {
            return redirect()->route('schedule.index')->with('status', $request->nome . ' Alterado! ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $reg = Schedule::find($id);

        $reg->delete();
        return redirect()->route('schedule.index')
                        ->with('status', $reg->nome . ' Deletado com Sucesso');
    }

}
