@extends('layouts.admin')

@section('title', 'Cadatro-Usuário')

@section('content_header')

@stop

@section('content')
 <!-- Main content -->
   <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Atualizar Usuario</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <form class="card-body " method="post" action="{{route('auth.save')}}" enctype="multipart/form-data">
                            <div class="container-fluid">
                                @if(Session::has('error'))
                                <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>OPS!</strong> Ocorreu um erro ao salvar.
                                    @if (count($errors) > 0)
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
                                @endif
                                @if(Session::has('success'))
                                <div class="alert alert-success alert-dismissible bg-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Sucesso!</strong> Registro salvo com sucesso.
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
                            <input type="text" hidden class="form-control" placeholder="id" id="id" value="{{isset($user) ? $user->ID_PESSOA : ''}}" name="id">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- Profile Image -->
                                        <div class="card card-primary card-outline">
                                            <div class="card-body box-profile">
                                                <div class="text-center">
                                                    <img class="profile-user-img img-fluid img-circle"
                                                    src="@if (isset($user)) {{asset('/storage/'.$user->avatar)}}  @else {{asset('/imagens/facisb_logo.png')}} @endif"
                                                    alt="User profile picture">
                                                </div>

                                                <h3 class="profile-username text-center">{{$pessoas->PESSOA_NOME}}</h3>

                                                <p class="text-muted text-center">{{$pessoas->PESSOA_FUNCAO}}</p>
                                            
                                                <ul class="list-group list-group-unbordered mb-3">

                                                <li align="center" class="list-group-item"> <strong >Meus Chamados</strong></li>
                                                
                                                <li class="list-group-item">
                                                    <b>Abertos</b> <a class="float-right">1,322</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Em Atendimento</b> <a class="float-right">543</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Não atendidos</b> <a class="float-right">13,287</a>
                                                </li>
                                                </ul>

                                                <a href="#" class="btn btn-primary btn-block"><b>Abrir Chamado</b></a>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-9">
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="settings">
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="email" value="{{$pessoas->PESSOA_NOME}}" class="form-control" id="nome" placeholder="nome">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                <input type="email" value="{{$pessoas->PESSOA_EMAIL}}" class="form-control" id="email" placeholder="email">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Endereço</label>
                                                <div class="col-sm-10">
                                                <input type="text" value="{{$pessoas->PESSOA_END}}" class="form-control" id="end" placeholder="end">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputExperience" class="col-sm-2 col-form-label">Bairro</label>
                                                <div class="col-sm-10">
                                                <input type="text" value="{{$pessoas->PESSOA_BAIRRO}}" class="form-control" id="bairro" placeholder="bairro">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputSkills" class="col-sm-2 col-form-label">CEP</label>
                                                <div class="col-sm-10">
                                                <input type="text" value="{{$pessoas->PESSOA_CEP}}" class="form-control" id="cep" placeholder="cep">
                                                </div>
                                            </div>
                                            <!--
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </div>
                                                -->
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div><!-- /.card-body -->
                                </div>
                            </div>
                        </form>
                    </div> <!-- /.row -->
                </div>
            </div>
        </div>          
    </section>
@stop

@section('css')
   
@stop

@section('js')
  
@stop


