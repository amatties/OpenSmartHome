
@extends('index')
@section('conteudo')
<script src="/js/moment.js"></script>
<script src="/js/Chart.js"></script>
<script src="/js/utils.js"></script>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="panel panel-container">

        <div style="width:75%;">
            @foreach ($tipos as $t)
            <canvas id={!! "'$t->type'" !!}></canvas>
            @endforeach
        </div>


        <script>



            var matrix = [];
            var col = {!! "'$num'" !!};
            
            var tipos = [];
            
            
          @foreach ($tipos as $t)
         var tt = {!! "'$t->type'" !!};
         tipos.push(tt);
   
    
    @endforeach

for ( var i = 0; i < col; i++ ) {
    matrix[i] = []; 
}

          @foreach ($sensors as $sensor)
                var date = new Date({!! "'$sensor->created_at'" !!});
                var dado = {!! $sensor->data !!};
                var type = {!! "'$sensor->type'" !!};
                var b = {x: date, y: dado};
            
              var pesq  = tipos.indexOf(type);
                matrix[pesq].push(b);
              
    @endforeach
    

           // var cont = entrada.length;

            var color = Chart.helpers.color;
@foreach ($tipos as $t)
            var ttt = {!! "'$t->type'" !!};
            var xx  = tipos.indexOf(ttt);
            var {!! "$t->type" !!} = {
                type: 'line',
                data: {
                    datasets: [{
                            label: ttt,
                            backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                            borderColor: window.chartColors.blue,
                            fill: false,
                            data: matrix[xx]
                        }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: ttt
                    },
                    scales: {
                        xAxes: [{
                                type: 'time',
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Date'
                                },
                                ticks: {
                                    major: {
                                        fontStyle: 'bold',
                                        fontColor: '#FF0000'
                                    }
                                }
                            }],
                        yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'value'
                                }
                            }]
                    }
                }
            };
 @endforeach
            window.onload = function () {
 @foreach ($tipos as $t)              
                var ctx = document.getElementById({!! "'$t->type'" !!}).getContext('2d');
                window.myLine = new Chart(ctx, {!! "$t->type" !!});
                @endforeach
                
            };


        </script>



    </div>
</div>      
@endsection
