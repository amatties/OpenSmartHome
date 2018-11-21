@extends('index')

@section('conteudo')




        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="login-panel panel panel-default">
               
                <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Agendamento</li>
            </ol>
        </div><!--/.row-->
        

    @if($acao ==1)


    <h2>
        Cadastro de Agendamento
    </h2>  

    @else

    <h2>
        Alteração de Agendamento
    </h2>  

    @endif

</div>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">


    @if($acao ==1)

    <form method="post" action="{{route('schedule.store')}}">

        @else

        <form method="post" action="{{route('schedule.update', $reg->id)}}">
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
            
     
         
           <div class='input-group date' id='datetimepickerini'>
                <input type='text' name="datetime_init" id="datetime_init" class="form-control" />
                
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
               
            </div>
            <div class='input-group date' id='datetimepickerend'>
                <input type='text' name="datetime_end" id="datetime_end" class="form-control" />
                
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
               
            </div>
            
            

            

            

            <button type="submit" class="btn btn-primary">Enviar</button>
            <button type="reset" class="btn btn-warning">Limpar</button>

        </form>
    </div>

            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->    

<script type="text/javascript">
        $(function () {
                $('#datetimepickerini').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                 $('#datetimepickerend').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
            });
    </script>

@endsection