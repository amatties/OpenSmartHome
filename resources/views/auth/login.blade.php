<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{URL::asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{URL::asset('/css/datepicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/styles.css')}}" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Open Smart Home</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="page-login">
<div id="app">
    <div class="container">
        <div class="row" >
            <div class=" col-sm-3 "></div>
            <div class=" jumbotron col-sm-6">
                <div class="login-logo">
<span>Open</span> Smart Home
               
            </div>
                 </div>
            <div class=" col-sm-3 "></div>
            <div class=" col-sm-3 "></div>
            <div class=" col-sm-6 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span></span> Login </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}" role="form">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="inputEmail3" class="col-sm-3 control-label">
                                    Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="inputEmail3" placeholder="email" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="inputPassword3" class="col-sm-3 control-label">
                                    Senha</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputPassword3" placeholder="*********" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">

                                </div>
                            </div>
                            <div class="form-group last">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        Entrar</button>
                                    <button type="reset" class="btn btn-default btn-sm">
                                        Limpar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class=" col-sm-3 "></div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>