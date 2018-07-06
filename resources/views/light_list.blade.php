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
        <th>Status</th>
        <th>Módulo</th>
        <th>Ações</th>
       
    
      </tr>
    </thead>
    <tbody>
      @foreach($lights as $light)
     
      
      <tr>
     
        
          <td>{{$light->name}}</td>
          <td>{{$light->port}}</td>
          <td>{{$light->port_status}}</td>
          <td>{{$light->module->name}}</td>
          <td>
           <a href="{{route('command.msg', [$light->port ,$light->port_status, $light->id, $light->module->pub_topic])}}" class="btn btn-primary" role="button">Enviar Comando</a>
          <a href="{{route('light.edit', $light->id)}}" class="btn btn-warning" role="button"> Alterar </a>
          
          <form style="display: inline-block;"
                  method="POST" 
                  action="{{route('light.destroy',$light->id)}}"
                  onsubmit="return confirm('Confirma exclusão?')">
                {{method_field('DELETE') }}
                  {{ csrf_field() }}
             <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
             
          </td>
      </tr>
      
      @endforeach
        
        
    </tbody>
  </table>
    
    
</div>
</div>


@endsection