<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Relatório Gerencial</title>

<!-- daterange picker -->
<link rel="stylesheet"
	href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet"
	href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet"
	href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
	href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet"
	href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet"
	href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet"
	href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
<!-- BS Stepper -->
<link rel="stylesheet"
	href="{{asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">
<!-- dropzonejs -->
<link rel="stylesheet"
	href="{{asset('plugins/dropzone/min/dropzone.min.css')}}">
<!-- Theme style 
      <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}"-->
<link rel="shortcut icon" href="{{asset('imagens/logo.png')}}">

<!-- CSS Customizado-->
<link rel="stylesheet" href="{{ asset('css/customizado.css') }}">
<!--<link rel="stylesheet" href="{{ asset('node_modules/bootstrap-fileinput/css/fileinput.min.css')}}">
      <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-fileinput/css/fileinput-rtl.min.css')}}"> -->

<!-- Plugins-->
<!-- Font Awesome -->
<link rel="stylesheet"
	href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
<!-- daterange picker -->

<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
	href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet"
	href="{{asset('template/dist/css/adminlte.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet"
	href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet"
	href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
	
	<div class="wrapper">
		<table style="text-align: center;" class="table">
			<thead>
				<tr>
					<th><img src="{{asset('template/dist/img/logo_g.png')}}"
						alt="AdminLTE Logo" width="60" height="40"
						class="brand-image img-circle elevation-3"></th>
					<th>Faculdade de Ciências da Saúde de Barretos Dr. Paulo Prata -
						FACISB</th>
				</tr>
			</thead>
		</table>
		<div class="container-fluid">
        @if(Session::has('error2'))
        <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>OPS!</strong> Você não pode acessa a pagina solicitada.
            @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        @endif
        
        @csrf
    </div>
		<h1 align="center">Relatório Gerencial do Setor {{$setor}}</h1>

		<h5 class="row mx-md-4">
			@if($abertosDpto > 0)
					Chamados temos {{$abertosDpto}}, sendo que:<br> 
					Sem atendimento: {{$qtdAbertos}} ;<br>
					Em atendimento: {{$atendimento}} ;<br>
					Encerrados: {{$qtdFechados}} .
			@else Não temos chamados!
			@endif
			
			<!-- <button id="btn" type="button" class="btn btn-primary"><i class="nav-icon far fa-copy"></i> imprimir</button> -->
		</h5>
		
		<br>
		<table id="chamados" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>CHAMADO</th>
					<th>TITULO</th>
					<th>Abertura</th>
					<th>Usuario</th>
					<th>STATUS</th>
					<th>VISUALIZOU</th>
					<th>Atendente</th>
				</tr>
			</thead>

			<tbody>

				@foreach($chamados as $chamado)
				<input hidden="" type="text"
					value=" {{$diferenca = strtotime(date('Y-m-d H:i:s')) - strtotime($chamado->DATA_ABERTURA)}}">
				<input hidden="" type="text"
					value=" {{$dias = floor($diferenca / (60 * 60 * 24))}}"> @if($dias
				> 7 && $chamado->STATUS != 'F')
				<tr style="color: red;">@elseif($dias <= 7 && $dias > 4 &&
					$chamado->STATUS != 'F')
				
				
				<tr style="color: orange;">@elseif($dias <= 4 && $chamado->STATUS !=
					'F')
				
				
				<tr style="color: green;">@else
				
				
				<tr>
					@endif
					<th>{{$chamado->NM_CHAMADO}}</th>
					<th>{{$chamado->d_descricao}}</th>
					<th>{{date('d/m/Y', strtotime($chamado->DATA_ABERTURA))}}</th>
					<td>{{$chamado->USU_LOGIN}}</td>
					<td>@if($chamado->STATUS == 'A') Aberto @elseif($chamado->STATUS ==
						'E') Em Atendimento @else Fechado @endif</td>
					@if($chamado->VIEW == 'S')
                       <td style="color: green;">@if($chamado->VIEW == 'S') SIM @endif</td>
                    @else
                    <td style="color: red;">@if($chamado->VIEW == 'N') Não @endif</td>
                      @endif
					<td>{{$chamado->PESSOA_NOME}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<br>
		<br>
		<br>
		<br>
		<section class="content">
			<div class="container-fluid">
				<!-- Small boxes (Stat box) -->
				<div class="row">
					<div class="col-lg-3 col-4">
						<!-- small box -->
						<div class="small-box bg-info">
							<div class="inner">
								<h3>{{$abertosDpto}}</h3>

								<p>Total Chamados Abertos</p>
							</div>
							<div class="icon">
								<i class="ion ion-bag"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i
								class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-4">
						<!-- small box -->
						<div class="small-box bg-success">
							<div class="inner">
								<h3>{{$qtdEncerrados}}</h3>

								<p>Encerrados</p>
							</div>
							<div class="icon">
								<i class="ion ion-stats-bars"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i
								class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>

					<div class="col-lg-3 col-4">
						<!-- small box -->
						<div class="small-box bg-success">
							<div class="inner">
								<h3>
									{{ $percente}}<sup style="font-size: 20px">%</sup>
								</h3>

								<p>Solucionados</p>
							</div>
							<div class="icon">
								<i class="fas fa-percent"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i
								class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>


					<!-- ./col -->
					<div class="col-lg-3 col-4">
						<!-- small box -->
						<div class="small-box bg-danger">
							<div class="inner">
								<h3>{{$qtdSemAtendimmento}}</h3>

								<p>Chamados não atendidos</p>
							</div>
							<div class="icon">
								<i class="ion ion-pie-graph"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i
								class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-4">
						<!-- small box -->
						<div class="small-box bg-success">
							<div class="inner">
								<h3>{{$qtdEmAtendimento}}</h3>
								<p>Chamados Em Atendimento</p>
							</div>
							<div class="icon">
								<i class="ion ion-pie-graph"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i
								class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="form-group col-4"></div>
				</div>
			</div>
		</section>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<!-- BAR CHART -->
						<div class="card card-success">
							<div class="card-header">
								<h3 class="card-title">
									<i class="far fa-chart-bar"></i> Chamados Mês a Mês
								</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool"
										data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
									<button type="button" class="btn btn-tool"
										data-card-widget="remove">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<div class="chart">
									<canvas id="barChart"
										style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
								</div>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<!-- /.col (LEFT) -->
					<div class="col-md-6">
						<!-- PIE CHART -->
						<div class="card card-danger">
							<div class="card-header">
								<h3 class="card-title">
									<i class="far fa-chart-bar"></i> Total de Chamados por Status
								</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool"
										data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
									<button type="button" class="btn btn-tool"
										data-card-widget="remove">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
							<div class="card-body">
								<canvas id="pieChart"
									style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<!-- /.col (RIGHT) -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container-fluid -->
		</section>
		<section class="content">
	<div class="container-fluid">
		<div class="row">
		
		<div class="col-md-12">
				<!-- BAR CHART -->
				<div class="card card-success">
					<div class="card-header">
						<h3 class="card-title">
							<i class="far fa-chart-bar"></i> Percentual por Status
						</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool"
								data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool"
								data-card-widget="remove">
								<i class="fas fa-times"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<div class="chart">
							<div  id="piechartGoogle" style="  width: 900px; height: 500px;"></div>
						</div>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		

			

			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
</section>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

		<script src="{{asset('node_modules/jquery/dist/jquery.min.js')}}"></script>
		<script
			src="{{asset('node_modules/popper.js/dist/umd/popper.min.js')}}"></script>
		<script
			src="{{asset('node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

		<!-- Summernote -->
		<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
		<!-- overlayScrollbars -->
		<script
			src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
		<!-- AdminLTE App -->
		<script src="{{asset('template/dist/js/adminlte.js')}}"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="{{asset('template/dist/js/demo.js')}}"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) 
            <script src="{{asset('template/dist/js/pages/dashboard.js')}}"></script>-->

		<!-- DataTables  & Plugins -->

		<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

		<script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
		<script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
		<script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
		<script
			src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
		<script
			src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
		<script
			src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

		<!-- JS customizado -->
		<script src="{{asset('customizados/customizado.js')}}"></script>

		<!-- jQuery -->

		<!-- Bootstrap 4 -->
		<script
			src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- Select2 -->
		<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
		<!-- Bootstrap4 Duallistbox -->
		<script
			src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
		<!-- InputMask -->
		<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
		<script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
		<!-- date-range-picker -->
		<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
		<!-- bootstrap color picker -->
		<script
			src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
		<!-- Tempusdominus Bootstrap 4 -->
		<script
			src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
		<!-- Bootstrap Switch -->
		<script
			src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
		<!-- BS-Stepper -->
		<script src="{{asset('plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
		<!-- dropzonejs -->
		<script src="{{asset('plugins/dropzone/min/dropzone.min.js')}}"></script>
		<!-- Ekko Lightbox -->
		<script src="{{asset('plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>

		<!-- AdminLTE App 
            <script src="{{asset('dist/js/adminlte.min.js')}}"></script>-->
		<!-- AdminLTE for demo purposes
            <script src="{{asset('dist/js/demo.js')}}"></script> -->
		<!-- novo -->
		<script
			src="{{asset('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
		<script
			src="{{asset('node_modules/datatables.net-buttons/js/buttons.colVis.js')}}"></script>
		<script
			src="{{asset('node_modules/datatables.net-buttons/js/buttons.html5.js')}}"></script>
		<script
			src="{{asset('node_modules/datatables.net-buttons/js/buttons.print.js')}}"></script>
		<script
			src="{{asset('node_modules/bootstrap-fileinput/js/fileinput.min.js')}}"></script>

		<script>
      document.getElementById('btn').onclick = function() {
          window.print();
        };
     </script>
		<script>
/************** Cria graficos JS ***********************/
 $(function(){
     	 var dados      = <?php echo $chamados ?>;
	     var abertos    = <?php echo json_encode($abertos)?>;
	     var fechado    = <?php echo json_encode($fechados )?>;
	     var atendendo  = <?php echo json_encode($emAtendimento )?>;
	        
	     var qdtAbertos    = <?php echo ($qtdSemAtendimmento )?>;
	     var qtdFechado    = <?php echo ($qtdEncerrados )?>;
	     var qtdAtendendo    = <?php echo ($qtdEmAtendimento )?>;
    //var status = dados.find(d => d.STATUS.some(id=>id.STATUS=='F'));
    
   
      // Meses dos chamados em abertos
      var aJan = abertos[0];      var aFev = abertos[1];      var aMar = abertos[2];
      var aAbr = abertos[3];      var aMai = abertos[4];      var aJun = abertos[5];
      var aJul = abertos[6];      var aAgo = abertos[7];      var aSet = abertos[8];
      var aOut = abertos[9];      var aNov = abertos[10];     var aDez = abertos[11];
      
       // Meses dos chamados  Fechados
      var fJan = fechado[0];      var fFev = fechado[1];      var fMar = fechado[2];
      var fAbr = fechado[3];      var fMai = fechado[4];      var fJun = fechado[5];
      var fJul = fechado[6];      var fAgo = fechado[7];      var fSet = fechado[8];
      var fOut = fechado[9];      var fNov = fechado[10];     var fDez = fechado[11];
      
       // Meses dos chamados em Atendimento
      var eJan = atendendo[0];    var eFev = atendendo[1];    var eMar = atendendo[2];
      var eAbr = atendendo[3];    var eMai = atendendo[4];    var eJun = atendendo[5];
      var eJul = atendendo[6];    var eAgo = atendendo[7];    var eSet = atendendo[8];
      var eOut = atendendo[9];    var eNov = atendendo[10];   var eDez = atendendo[11];
      
         //alert('Em Março temos '+eMar+' Abertos'); 
     // console.log('temos '+atendendo+' Em atendimento'); 
      //console.log('temos '+fechado+' Fechados');
      
      /*
       * // O MAP faz busca no array
       var abertoMap = abertos.map((a)=>{
          //var cont = a.STATUS.length;
         // console.log(cont);
    })
       */
      
      
    console.log('quantidade de Abertos é - '+qdtAbertos);
    console.log('quantidade de Fechados é - '+qtdFechado);
    console.log('quantidade de Em Atendimento é - '+qtdAtendendo);
           
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    /*
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
*/
    var areaChartData = {
      labels  : ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
      datasets: [
        {
          label               : 'Fechado',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [fJan,fFev,fMar,fAbr,fMai,fJun,fJul,fAgo,fSet,fOut,fNov,fDez]
        },
        {
          label               : 'Aberto',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [aJan,aFev,aMar,aAbr,aMai,aJun,aJul,aAgo,aSet,aOut,aNov,aDez]
        },
        {
          label               : 'Em Atendimento',
          backgroundColor     : 'rgba(1, 214, 222, 210)',
          borderColor         : 'rgba(1, 214, 222, 210)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [eJan,eFev,eMar,eAbr,eMai,eJun,eJul,eAgo,eSet,eOut,eNov,eDez]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }
/*
    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })
*/
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    //var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutChartCanvas = $('#pieChart').get(0).getContext('2d')
    var donutData        = {
      labels: ['Abertos','Fechados','Em Atendimento'],
      datasets: [
        {
          data: [qdtAbertos,qtdFechado,qtdAtendendo],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })
    
    

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
   /*
    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
*/

// *************** PieChart Google ***********************
    
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Abertos',     qdtAbertos],
          ['Fechados',     qtdFechado],
          ['Em Atendimento',  qtdAtendendo]
        ]);

        var chart = new google.visualization.PieChart(document.getElementById('piechartGoogle'));

        chart.draw(data);
      }
      
})
  

/*********************** FIM GERA GRAFICOS **************************/
</script>



		<!-- /.content-wrapper -->
		<footer align="center" class="main-footer">
			<strong>Copyright &copy; {{$anoCorrente}} <a
				href="https://facisb.edu.br">Facisb</a>.
			</strong>

			<div class="float-right d-none d-sm-inline-block">
				<b>Version</b> 1.0.0
			</div>
		</footer>

</body>
</html>

