@extends('index')
@section('conteudo')





<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">

                    <em class="fa fa-microchip">&nbsp;</em>
                </a></li>
            <li class="active">Iluminação</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <em class="fa fa-microchip"></em>
            <h1 class="page-header">Iluminação</h1>
        </div>
    </div><!--/.row-->

    <div class="panel panel-container">

        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @elseif (session('status2'))
        <div class="alert alert-danger">
            {{ session('status2') }}
        </div>


        @endif

        <table class="table table-hover">
            <thead>
                <tr>

                    <th>Nome</th>

                    <th>Porta</th>

                    <th>Módulo</th>



                </tr>
            </thead>
            <tbody>
                @foreach($lights as $light)


                <tr>


                    <td>{{$light->name}}</td>
                    <td>{{$light->port}}</td>

                    <td>{{$light->module->name}}</td>
                    <td>



                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#swModal{{$light->id}}"><span class="glyphicon glyphicon-off"></span></button>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#confModal{{$light->id}}"><span class="glyphicon glyphicon-cog"></span></button>

                        <div class="modal fade" id="swModal{{$light->id}}" role="dialog">
                            <div class="modal-dialog">


                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Ações</h4>
                                    </div>
                                    <div class="modal-body">
                                        @if ($light->port_status == 1 )
                                        <a href="{{route('command.msg', [$light->port ,$light->port_status, $light->id])}}" class="btn btn-primary" role="button">Ligar</a>
                                        @elseif ($light->port_status == 0)

                                        <a href="{{route('command.msg', [$light->port ,$light->port_status, $light->id])}}" class="btn btn-primary" role="button">Desligar</a>
                                        @endif


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>


                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal fade" id="confModal{{$light->id}}" role="dialog">
                            <div class="modal-dialog">


                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Ações</h4>
                                    </div>
                                    <div class="modal-body">
                                        <a href="{{route('schedule.l', $light->id)}}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-calendar"></span> Agendar </a>
                                        <a href="{{route('light.edit', $light->id)}}" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-pencil"></span> Alterar </a>

                                        <form style="display: inline-block;"
                                              method="POST" 
                                              action="{{route('light.destroy',$light->id)}}"
                                              onsubmit="return confirm('Confirma exclusão?')">
                                            {{method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Excluir</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>


                                    </div>
                                </div>

                            </div>
                        </div>



                    </td>
                </tr>

                @endforeach


            </tbody>
        </table>


    </div>
</div>


@endsection