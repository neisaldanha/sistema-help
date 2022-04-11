<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Impressão de demanda</title>

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
		<div class="row mx-md-4 card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
			  <div style="background-color: #98FB98;" class="card-header">
			    <h1 align="center">{{$numChamado}} - Titulo: {{$titulo}}</h1>
			  </div>
			  <div style="background-color: #FFFAFA;" class="card-body">
			    <b><p align="justify" class="card-header"> {!! nl2br(e($descricao)) !!}</p></b>
			  </div>
			  <div class="card-footer text-muted">
			    <strong>Copyright &copy; 2022 <a
					href="https://facisb.edu.br">Facisb</a>.
				</strong>
				<div class="float-right d-none d-sm-inline-block">
					<b>Version</b> 1.0.0
				</div>
			  </div>
		</div>

		
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
			
</body>
</html>

		