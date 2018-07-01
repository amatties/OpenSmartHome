@extends('index')
@section('conteudo')





<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Usuários</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Usuários</h1>
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
        <th>Código</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
        
    
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
     
      
      <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>
          
          <form style="display: inline-block;"
                  method="POST" 
                  action="{{route('users.destroy',$user->id)}}"
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