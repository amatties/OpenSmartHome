
@extends('index')
@section('conteudo')
	<script src="/js/moment.js"></script>
	<script src="/js/Chart.js"></script>
	<script src="/js/utils.js"></script>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="panel panel-container">

	<div style="width:75%;">
		<canvas id="canvas"></canvas>
	</div>
	
	
	<script>
		
		var color = Chart.helpers.color;
		var config = {
			type: 'line',
			data: {
				datasets: [{
					label: 'Dataset with date object point data',
					backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
					borderColor: window.chartColors.blue,
					fill: false,
                    data: [
                            @foreach ($sensors as $sensor)
                    {!! "{x: new Date('$sensor->created_at'), y: $sensor->data}," !!}
                    @endforeach]
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Chart.js Time Point Data'
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

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};

	
	</script>
        
        
        
 </div>
  </div>      
@endsection
