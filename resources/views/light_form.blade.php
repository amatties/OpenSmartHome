@extends('index')

@section('conteudo')




        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="login-panel panel panel-default">
               
                <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Iluminação</li>
            </ol>
        </div><!--/.row-->
        

    @if($acao ==1)


    <h2>
        Cadastro de Iluminação
    </h2>  

    @else

    <h2>
        Alteração de Iluminação
    </h2>  

    @endif

</div>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">


    @if($acao ==1)

    <form method="post" action="{{route('light.store')}}">

        @else

        <form method="post" action="{{route('light.update', $reg->id)}}">
            {!! method_field('put') !!}

            @endif

            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Nome</label>
                <input style="width: 60%" type="text" class="form-control" id="name"
                       name="name" 
                       value="{{$reg->name or old('name')}}"
                       required>
            </div>
            
     
         
            <div class="form-group">
                <label for="port">Porta Saida</label>
                <input style="width: 60%" type="text" class="form-control" id="port"
                       name="port" 
                       value="{{$reg->port or old('port')}}"
                       required>
            </div>
            
            <div class="form-group">
                <label for="marca_id">Módulo</label>
                <select class="form-control" id="module_id" name="module_id" >
                    @foreach($modules as $m)
                    
                    
                    
                    <option value="{{$m->id}}"
                            @if((isset($reg) and $reg->module_id == $m->id) or old('module_id') == $m->id) selected 
                            @endif

                            >{{$m->name}}</option>
                    @endforeach
                </select>
            </div>

            

            

            <button type="submit" class="btn btn-primary">Enviar</button>
            <button type="reset" class="btn btn-warning">Limpar</button>

        </form>
    </div>

            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->    



@endsection