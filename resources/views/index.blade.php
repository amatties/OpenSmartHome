@extends('base')

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
                <div class="profile-usertitle-status">{{{ (Auth::user()->name) }}} <span class="indicator label-success"></span>Online</div>

            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>
        
        <ul class="nav menu">
            <!-- DASHBOARD -->
            <li><a href="/dashboard"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
         
            
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
          
            <li class="parent "><a data-toggle="collapse" href="#listaLuzes">
                    <em class="fa fa-list">&nbsp;</em> Luzes <span data-toggle="collapse" href="#listaLuzes" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="listaLuzes">
                    <li><a class="" href="">
                            <span class="fa fa-list">&nbsp;</span> Listar Luzes
                        </a></li>
                    <li><a class="" href="">
                            <span class="fa fa-plus-circle">&nbsp;</span> Adicionar 
                        </a></li>
                </ul>
            </li>
            
            <li class="parent "><a data-toggle="collapse" href="#listaPortas">
                    <em class="fa fa-list">&nbsp;</em> Portas <span data-toggle="collapse" href="#listaPortas" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="listaPortas">
                    <li><a class="" href="">
                            <span class="fa fa-list">&nbsp;</span> Listar portas
                        </a></li>
                    <li><a class="" href="">
                            <span class="fa fa-plus-circle">&nbsp;</span> Adicionar 
                        </a></li>
                </ul>
            </li>
          
            <li class="parent "><a data-toggle="collapse" href="#listasensores">
                    <em class="fa fa-list">&nbsp;</em> Sensores <span data-toggle="collapse" href="#listasensores" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="listasensores">
                    <li><a class="" href="">
                            <span class="fa fa-list">&nbsp;</span> Listar Sensores
                        </a></li>
                    <li><a class="" href="}">
                            <span class="fa fa-plus-circle">&nbsp;</span> Adicionar 
                        </a></li>
                </ul>
            </li>
            <li class="parent "><a data-toggle="collapse" href="#listaDispositivos">
                    <em class="fa fa-list">&nbsp;</em> Dispositivos <span data-toggle="collapse" href="#listaDispositivos" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="listaDispositivos">
                    <li><a class="" href="">
                            <span class="fa fa-list">&nbsp;</span> Listar Dispositivos
                        </a></li>
                    <li><a class="" href="">
                            <span class="fa fa-plus-circle">&nbsp;</span> Adicionar 
                        </a></li>
                </ul>
            </li>
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


    <div class="footer">
        <p class="back-link">Todos direitos reservados <a href="#">Open Smart Home</a></p>
    </div>
</div><!--/.row-->
</div><!--/.main-->


<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/custom.js"></script>





</body>
</html>
