@extends('index')

@section('conteudo')




        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="login-panel panel panel-default">
               
                <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Módulos</li>
            </ol>
        </div><!--/.row-->
        

    @if($acao ==1)


    <h2>
        Cadastro de Módulo
    </h2>  

    @else

    <h2>
        Alteração de Módulo
    </h2>  

    @endif

</div>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">


    @if($acao ==1)

    <form method="post" action="{{route('module.store')}}">

        @else

        <form method="post" action="{{route('module.update', $reg->id)}}">
            {!! method_field('put') !!}

            @endif

            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Nome</label>
                <input style="width: 60%" type="text" class="form-control" id="name"
                       name="name" 
                       value="{{$reg->name or old('nome')}}"
                       required>
            </div>
            
     
         
            <div class="form-group">
                <label for="sub_topic">Sub Topic</label>
                <input style="width: 60%" type="text" class="form-control" id="sub_topic"
                       name="sub_topic" 
                       value="{{$reg->sub_topic or old('sub_topic')}}"
                       required>
            </div>
            <div class="form-group">
                <label for="pub_topic">Pub Topic</label>
                <input style="width: 60%" type="text" class="form-control" id="pub_topic"
                       name="pub_topic" 
                       value="{{$reg->pub_topic or old('pub_topic')}}"
                       required>
            </div>
            <div class="form-group">
                <label for="ip">IP</label>
                <input style="width: 60%" type="text" class="form-control" id="ip"
                       name="ip" 
                       value="{{$reg->ip or old('ip')}}"
                       required>
            </div>

            

            <button type="submit" class="btn btn-primary">Enviar</button>
            <button type="reset" class="btn btn-warning">Limpar</button>

        </form>
    </div>

            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->    


@endsection