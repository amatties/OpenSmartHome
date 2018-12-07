<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\phpMQTT;
use App\Device;

class DeviceController extends Controller
{
     public function command(Request $request) {
        $port = $request->port;
        $id = $request->id;
        $port_status = $request->port_status;

        $msg = "" . $port . "" . $port_status . "";

        $reg = Device::find($id);
        $pub_topic = $reg->module->sub_topic;
        $dest = $reg->port_status;
        if ($dest == 0) {
            $alt = $reg->update(['port_status' => 1]);
            if ($alt) {
                $this->sendData($pub_topic, $msg);

                return 1;
            }
        } else {
            $alt = $reg->update(['port_status' => 0]);
            if ($alt) {
                $this->sendData($pub_topic, $msg);

                return 1;
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
    public function index()
    {
         $devices = Device::all();
      

       // return  compact('lights');
        return response()->json($devices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
