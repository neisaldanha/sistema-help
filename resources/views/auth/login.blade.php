<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sistema Help - Login</title>
  <!--PWA-->
  <link rel="stylesheet" type="text/css" href="{{asset('css/addtohomescreen.css')}}">
  <link rel="manifest" href="{{asset('manifest.webmanifest')}}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css')}}">
  <!--Logo do sistema-->
  <link rel="shortcut icon" href="{{asset('imagens/logo.png')}}">
  <!--CSS Diversos-->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/customizado.css') }}">

</head>

<body id="body" class="hold-transition login-page">
  <!-- 
    <div class="col-md-2" id="container">
        <p id="p">
            <a href="https://www.facisb.edu.br/">
                FACISB
             </a>
        </p>
    </div>
 -->
  <div class=" col-md-4 login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>FACISB</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Faça login para iniciar sua sessão</p>

        <form action="{{ route('auth.check') }}" method="post">
          @if(Session::get('fail'))
          <div class="alert alert-danger">
            {{ Session::get('fail') }}
          </div>
          @endif

          @csrf
          <span class="text-danger">@error('email'){{ $message }} @enderror</span>
          <div class="input-group mb-3">
            <input type="search" class="form-control" id="login" name="email" placeholder="000.000.000-00" value="{{ old('email') }}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <span class="text-danger">@error('password'){{ $message }} @enderror</span>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!--
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          -->
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-block btn-primary">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
          <br>
          <hr>
          <p>Copyright ©2022 FACISB</p>
        </form>
        <!-- 
      <p class="mb-1">
        <a href="#">Esqueci a senha</a>
      </p>
       -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

  <!-- /.content-header -->
  <!-- Main content -->
  <!-- jQuery-->

  <script src="{{asset('node_modules/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('node_modules/popper.js/dist/umd/popper.min.js')}}"></script>
  <script src="{{asset('node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

  <!-- Summernote -->
  <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('template/dist/js/adminlte.js')}}"></script>

  <!-- AdminLTE dashboard demo (This is only for demo purposes) 
            <script src="{{asset('template/dist/js/pages/dashboard.js')}}"></script>-->

  <!-- DataTables  & Plugins -->

  <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

  <!-- JS customizado -->
  <script src="{{asset('customizados/customizado.js')}}"></script>

  <!-- jQuery -->

  <!-- Bootstrap 4 -->
  <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Select2 -->
  <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
  <!-- InputMask -->
  <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
  <!-- date-range-picker -->
  <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- bootstrap color picker -->
  <script src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Bootstrap Switch -->
  <script src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
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
  <script src="{{asset('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('node_modules/datatables.net-buttons/js/buttons.colVis.js')}}"></script>
  <script src="{{asset('node_modules/datatables.net-buttons/js/buttons.html5.js')}}"></script>
  <script src="{{asset('node_modules/datatables.net-buttons/js/buttons.print.js')}}"></script>
  <script src="{{asset('node_modules/bootstrap-fileinput/js/fileinput.min.js')}}"></script>

  <!-- PWA -->
  <script src="{{asset('index.js')}}" defer></script>



</body>

</html>