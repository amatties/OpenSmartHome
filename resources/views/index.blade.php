<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Open Smart Home</title>
        <!--<link href="/css/bootstrap.min.css" rel="stylesheet">-->
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <link href="/css/styles.css" rel="stylesheet">
        <script src="/js/jquery-1.11.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/moment-with-locales.js"></script>
        
        <script src="/js/custom.js"></script>
        <script src="/js/moment.js"></script>
        <script src="/js/Chart.js"></script>
        <script src="/js/utils.js"></script>
        <script src="/js/bootstrap-datetimepicker.js"></script>
    
         
    </head>

    <body>
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span></button>
                    <a class="navbar-brand" href="#"><span>Open</span>Smart Home</a>
                    <ul class="nav navbar-top-links navbar-right">


                </div>
            </div><!-- /.container-fluid -->
        </nav>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="profile-sidebar">

                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"></div>
                    <div class="profile-usertitle-status"> <span class="indicator label-success"></span>Online</div>

                </div>
                <div class="clear"></div>
            </div>
            <div class="divider"></div>

            <ul class="nav menu">
                <!-- DASHBOARD -->
                <li><a href=""><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>


                <!-- USUÁRIOS -->
                <li class="parent "><a data-toggle="collapse" href="#listaUsuarios">
                        <em class="fa fa-user">&nbsp;</em> Usuários<span data-toggle="collapse" href="#listaUsuarios" class="icon pull-right"><em class="fa fa-plus"></em></span>
                    </a>
                    <ul class="children collapse" id="listaUsuarios">
                        <li><a class="" href="{{route('users.index')}}">
                                <span class="fa fa-list">&nbsp;</span> Listar Usuários
                            </a></li>
                        <li><a class="" href="{{ route('register') }}">

                                <span class="fa fa-plus-circle">&nbsp;</span> Adicionar novo
                            </a></li>
                    </ul>
                </li>

                <li class="parent "><a data-toggle="collapse" href="#modulos">
                        <em class="fa fa-wifi">&nbsp;</em> Módulos <span data-toggle="collapse" href="#modulos" class="icon pull-right"><em class="fa fa-plus"></em></span>
                    </a>
                    <ul class="children collapse" id="modulos">
                        <li><a class="" href="{{route('module.index')}}">
                                <span class="fa fa-list">&nbsp;</span> Listar Modulos
                            </a></li>

                        <li><a class="" href="{{route('module.create')}}">
                                <span class="fa fa-plus-circle">&nbsp;</span> Adicionar 
                            </a></li>
                    </ul>

                </li>

                <li class="parent "><a data-toggle="collapse" href="#iluminacao">
                        <em class="fa fa-lightbulb-o">&nbsp;</em> Iluminação <span data-toggle="collapse" href="#iluminacao" class="icon pull-right"><em class="fa fa-plus"></em></span>
                    </a>
                    <ul class="children collapse" id="iluminacao">
                        <li><a class="" href="{{route('light.index')}}">
                                <span class="fa fa-list">&nbsp;</span> Listar Luzes
                            </a></li>
                        <li><a class="" href="{{route('light.create')}}">
                                <span class="fa fa-plus-circle">&nbsp;</span> Adicionar 
                            </a></li>
                    </ul>
                </li>

                <li class="parent "><a data-toggle="collapse" href="#listaPortas">
                        <em class="fa fa-lock">&nbsp;</em> Portas <span data-toggle="collapse" href="#listaPortas" class="icon pull-right"><em class="fa fa-plus"></em></span>
                    </a>
                    <ul class="children collapse" id="listaPortas">
                        <li><a class="" href="{{route('lock.index')}}">
                                <span class="fa fa-list">&nbsp;</span> Listar portas
                            </a></li>
                        <li><a class="" href="{{route('lock.create')}}">
                                <span class="fa fa-plus-circle">&nbsp;</span> Adicionar 
                            </a></li>
                    </ul>
                </li>

                <li class="parent "><a data-toggle="collapse" href="#listasensores">
                        <em class="fa fa-signal">&nbsp;</em> Sensores <span data-toggle="collapse" href="#listasensores" class="icon pull-right"><em class="fa fa-plus"></em></span>
                    </a>
                    <ul class="children collapse" id="listasensores">
                        <li><a class="" href="{{route('sensor.index')}}">
                                <span class="fa fa-list">&nbsp;</span> Listar Sensores
                            </a></li>
                        <li><a class="" href="{{route('sensor.create')}}">
                                <span class="fa fa-plus-circle">&nbsp;</span> Adicionar 
                            </a></li>
                    </ul>
                </li>
                <li class="parent "><a data-toggle="collapse" href="#listaDispositivos">
                        <em class="fa fa-microchip">&nbsp;</em> Dispositivos <span data-toggle="collapse" href="#listaDispositivos" class="icon pull-right"><em class="fa fa-plus"></em></span>
                    </a>
                    <ul class="children collapse" id="listaDispositivos">
                        <li><a class="" href="{{route('device.index')}}">
                                <span class="fa fa-list">&nbsp;</span> Listar Dispositivos
                            </a></li>
                        <li><a class="" href="{{route('device.create')}}">
                                <span class="fa fa-plus-circle">&nbsp;</span> Adicionar 
                            </a></li>
                    </ul>
                </li>
                <li class="parent "><a data-toggle="collapse" href="#agendamentos">
                        <em class="fa fa-calendar-check-o">&nbsp;</em> Agendamentos <span data-toggle="collapse" href="#agendamentos" class="icon pull-right"><em class="fa fa-plus"></em></span>
                    </a>
                    <ul class="children collapse" id="agendamentos">
                        <li><a class="" href="">
                                <span class="fa fa-list">&nbsp;</span> Listar Agendamentos
                            </a></li>
                        <li><a class="" href="">
                                <span class="fa fa-plus-circle">&nbsp;</span> Adicionar 
                            </a></li>
                    </ul>
                </li>
                <li><a href="#"><em class="fa fa-archive">&nbsp;</em> Log</a></li>

                <!-- LOGOUT -->
                <li>   <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form></li>
            </ul>
        </div><!--/.sidebar-->

        <!-- NESTA ÁREA IRÁ O CONTEUDO DO DASHBOARD
        <!-- conteudo-->

        @yield('conteudo')

        <div class="push"></div>
        <div class="footer">
            <p class="back-link">Todos direitos reservados <a href="#">Open Smart Home</a></p>
        </div>
    </div><!--/.row-->
</div><!--/.main-->








</body>


</html>
