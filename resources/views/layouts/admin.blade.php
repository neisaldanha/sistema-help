<!DOCTYPE html>
<html lang="pt-BR">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Sistema Help</title>
    

      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
      
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
      <!-- daterange picker -->
      <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
      <!-- iCheck for checkboxes and radio inputs -->
      <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
      <!-- Bootstrap Color Picker -->
      <link rel="stylesheet" href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
      <!-- Tempusdominus Bootstrap 4 -->
      <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
      <!-- Select2 -->
      <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
      <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
      <!-- Bootstrap4 Duallistbox -->
      <link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
      <!-- BS Stepper -->
      <link rel="stylesheet" href="{{asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">
      <!-- dropzonejs -->
      <link rel="stylesheet" href="{{asset('plugins/dropzone/min/dropzone.min.css')}}">
      <!-- Theme style 
      <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}"-->
      <link rel="shortcut icon" href="{{asset('imagens/logo.png')}}">

      <!-- CSS Customizado-->
      <link rel="stylesheet" href="{{ asset('css/customizado.css') }}">
      <!--<link rel="stylesheet" href="{{ asset('node_modules/bootstrap-fileinput/css/fileinput.min.css')}}">
      <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-fileinput/css/fileinput-rtl.min.css')}}"> -->
      

      <!-- Google Font: Source Sans Pro  -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
      <!-- Plugins-->
      <!-- DataTables -->
      
      <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
      <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
      <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Tempusdominus Bootstrap 4 -->
      <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
      <!-- JQVMap -->
      <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css')}}">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
      <!-- summernote -->
      <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

          <!-- Preloader -->
          <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('template/dist/img/logo_g.png')}}" alt="AdminLTELogo" height="60" width="60">
          </div>

          <!-- Navbar -->
          <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
              <!--
              <li class="nav-item d-none d-sm-inline-block">
                <a href="" class="nav-link">Home</a>
              </li>
              <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
              </li>-->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
              <!-- Navbar Search 
              <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                  <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                  <form class="form-inline">
                    <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" type="search" placeholder="..." aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                          <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>-->
              {{--
              <!-- Messages Dropdown Menu -->
              <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-comments"></i>
                  <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <img src="{{asset('template/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          Brad Diesel
                          <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Call me whenever you can...</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  
                  <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                      <img src="{{asset('template/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          John Pierce
                          <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">I got your message bro</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    
                    <div class="media">
                      <img src="{{asset('template/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          Nora Silvester
                          <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">The subject goes here</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                    
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
              </li>
              --}}
              <!-- Notifications Dropdown Menu -->
              <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                @if($imagem)
                @foreach($imagem as $foto)
                <img src="{{asset('/storage/'.$foto)}}" class="direct-chat-img" width="54px" alt="User Image">
                @endforeach
                @else 
                <img class="direct-chat-img" src="{{asset('template/dist/img/user1-128x128.jpg')}}" alt="message user image">
                @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <a href="{{url('admin/ver/user',$iduser)}}" class="dropdown-item">
                  <i class="fas fa-user mr-2"></i> Editar Usuário
                  </a>
                  <div class="dropdown-divider"></div>
                  @if($nivel == "A")
                  <a href="{{url('painel/edit',$iduser)}}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Ver Perfil
                  </a>
                  @endif
                  <div class="dropdown-divider"></div>
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('auth.logout') }}" class="dropdown-item dropdown-footer">
                  <i class="fas fa-sign-out-alt"></i> Sair

                  </a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
                </a>
              </li>
              <!--
              <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                  <i class="fas fa-th-large"></i>
                </a>
              </li>
                -->
            </ul>
          </nav>
          <!-- /.navbar -->

          <!-- Main Sidebar Container -->
          <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('admin/home')}}" class="brand-link">
              <img src="{{asset('template/dist/img/logo_g.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" >
              <span class="brand-text font-weight-light">HELP</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                  @foreach($imagem as $foto)
                  <a href="{{asset('/storage/'.$foto)}}" data-toggle="lightbox" >
                        <img src="{{asset('/storage/'.$foto)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; ">
                  </a>
                  @endforeach 
                </div>
                <div class="info">
                  <a href="#" class="d-block">
                    @foreach($data as $usu)
                        {{$usu}}
                    @endforeach
                  </a>
                </div>
              </div>
                {{--
              <!-- SidebarSearch Form -->
              <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                    </button>
                  </div>
                </div>
              </div>
                  --}}
              <!-- Sidebar Menu -->
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                      with font-awesome or any other icon font library -->
                  {{--
                  <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="./index.html" class="nav-link active">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Dashboard v1</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Dashboard v2</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Dashboard v3</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  --}}
                    @if($nivel == "A")
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                          Administrativo
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/departamentos')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Departamentos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/funcoes')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Funções</p>
                            </a>
                        </li>
                      </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                            Cadastro
                            <i class="fas fa-angle-left right"></i>
                            <!--<span class="badge badge-info right">6</span>-->
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="{{url('painel/lista-pessoas')}}" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Pessoa</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="{{url('admin/usuarios')}}" class="nav-link">
                              <i class="fas fa-user-plus nav-icon"></i>
                                <p>Usuários</p>
                              </a>
                            </li>
                             
                        </ul>
                    </li>
                     @endif
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-hands-helping"></i>
                        <p>
                          Chamados
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{url('painel/lista-chamados')}}" class="nav-link">
                          <i class="fas fa-bell nav-icon"></i>
                            <p>@if($nivel == "A") Todos os chamados @else Meus chamados @endif</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                    @if($nivel == "A" || $nivel == "S")
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon  fas fa-tasks"></i>
                                <p>
                                 Demanda DPTO
                                <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('painel/lista-chamados-dpto')}}" class="nav-link">
                                        <i class="fas fa-bell nav-icon"></i>
                                        <p>Chamados</p>
                                    </a>
                                </li>
                                <li class="nav-item">
	                              <a href="{{url('painel/lista-chamados-dpto-finalizados/')}}" class="nav-link">
	                             <i class="nav-icon far fa-copy"></i>
	                                <p>Chamados Finalizados</p>
	                              </a>
                           		 </li>
                                <li class="nav-item">
	                              <a href="{{url('admin/lista-demandas/')}}" class="nav-link">
	                             	<i class="nav-icon fas fa-file"></i>
	                                <p>Demanda</p>
	                              </a>
	                            </li>
	                            <li class="nav-item">
	                              <a href="{{url('painel/relatorio-chamados-finalizados/')}}" target="_blank" class="nav-link">
	                             <i class="nav-icon far fa-copy"></i>
	                                <p>Chamados Finalizados - PDF </p>
	                              </a>
	                            </li>
	                            <li class="nav-item">
	                              <a href="{{url('painel/relatorio-demandas/')}}" target="_blank" class="nav-link">
	                             <i class="nav-icon far fa-copy"></i>
	                                <p>Chamados-Relatório</p>
	                              </a>
	                            </li>
                            </ul>
                        </li>
                    @endif
                    @if($nivel == "A")
                    	<li class="nav-item">
                    		<a href="#" class="nav-link">
                                <i class="nav-icon  fas fa-tasks"></i>
                                <p>
                                 Relatórios
                                <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="{{url('painel/demandas-setores/')}}" class="nav-link">
                             <i class="nav-icon far fa-copy"></i>
                                <p>Por Setor</p>
                              </a>
                            </li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                      <i class="nav-icon far fa-envelope"></i>
                        <p>
                          E-mail
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{url('email/form-email')}}" class="nav-link">
                              <i class="nav-icon far fa-envelope-open"></i>
                                <p>Enviar E-mail</p>
                              </a>
                          </li>
                      </ul>
                    </li>
                  {{--
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                      <p>
                        Forms
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pages/forms/general.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>General Elements</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/forms/advanced.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Advanced Elements</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/forms/editors.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Editors</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/forms/validation.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Validation</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                        Tables
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pages/tables/simple.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Simple Tables</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/tables/data.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>DataTables</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/tables/jsgrid.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>jsGrid</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  
                  <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
                      <i class="nav-icon far fa-calendar-alt"></i>
                      <p>
                        Notícias
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                      <i class="nav-icon far fa-image"></i>
                      <p>
                      Eventos
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/kanban.html" class="nav-link">
                      <i class="nav-icon fas fa-columns"></i>
                      <p>
                      Cursos Livres
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-envelope"></i>
                      <p>
                        Mailbox
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pages/mailbox/mailbox.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Inbox</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/mailbox/compose.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Compose</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/mailbox/read-mail.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Read</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                        Pages
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Invoice</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/profile.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Profile</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/e-commerce.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>E-commerce</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/projects.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Projects</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/project-add.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Project Add</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/project-edit.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Project Edit</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/project-detail.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Project Detail</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/contacts.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Contacts</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/faq.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>FAQ</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/contact-us.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Contact us</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-plus-square"></i>
                      <p>
                        Extras
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Login & Register v1
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="pages/examples/login.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Login v1</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="pages/examples/register.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Register v1</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="pages/examples/forgot-password.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Forgot Password v1</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="pages/examples/recover-password.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Recover Password v1</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Login & Register v2
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="pages/examples/login-v2.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Login v2</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="pages/examples/register-v2.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Register v2</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="pages/examples/forgot-password-v2.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Forgot Password v2</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="pages/examples/recover-password-v2.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Recover Password v2</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/lockscreen.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Lockscreen</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Legacy User Menu</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Language Menu</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Error 404</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Error 500</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Pace</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/examples/blank.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Blank Page</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="starter.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Starter Page</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-search"></i>
                      <p>
                        Search
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="pages/search/simple.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Simple Search</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="pages/search/enhanced.html" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Enhanced</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                
                  <li class="nav-item">
                    <a href="iframe.html" class="nav-link">
                      <i class="fas fa-user-graduate"></i>
                      <p> Pós Graduação</p>
                    </a>
                  </li>
              
                  <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                      <i class="fas fa-user-graduate"></i>
                      <p>Documentation</p>
                    </a>
                  </li>
                  <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Level 1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-circle"></i>
                      <p>
                        Level 1
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Level 2</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Level 2
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Level 3</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Level 3</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Level 3</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Level 2</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Level 1</p>
                    </a>
                  </li>
                  <li class="nav-header">LABELS</li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-circle text-danger"></i>
                      <p class="text">Important</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-circle text-warning"></i>
                      <p>Warning</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-circle text-info"></i>
                      <p>Informational</p>
                    </a>
                  </li>
                </ul>
                --}}
              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
          </aside>

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    
                  </div><!-- /.col -->
                  
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                  </div>
                  
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
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
            <!-- AdminLTE for demo purposes -->
            <script src="{{asset('template/dist/js/demo.js')}}"></script>
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
            
            <!-- Page specific script -->
          
            @yield('content')
            <!-- /.content -->
          </div>
        
          <!-- /.content-wrapper -->
          <footer class="main-footer">
            <strong>Copyright &copy; 2022 <a href="https://facisb.edu.br">FACISB</a>.</strong>
          
            <div class="float-right d-none d-sm-inline-block">
              <b>Version</b> 1.0.0
            </div>
          </footer>

          <!-- Control Sidebar -->
          <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
          </aside>
          <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
    </body>
</html>
