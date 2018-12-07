@extends('index')
@section('conteudo')





<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">

                    <em class="fa fa-microchip">&nbsp;</em>
                </a></li>
            <li class="active">Log</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <em class="fa fa-microchip"></em>
            <h1 class="page-header">Log</h1>
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

                    <th>Nome do usuário</th>

                    <th>Ação</th>
                    <th>Data</th>

                    



                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)


                <tr>


                    
                    

                    <td>{{$log->user->name}}</td>
                    <td>{{$log->acao}}</td>
                    <td>{{$log->created_at}}</td>
                
                </tr>

                @endforeach


            </tbody>
        </table>


    </div>
</div>


@endsection