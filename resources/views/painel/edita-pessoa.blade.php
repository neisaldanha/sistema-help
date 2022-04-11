@extends('layouts.admin')

@section('title', 'Cadatro-Usuário')

@section('content_header')

@stop

@section('content')
    <!-- Main content -->
    <div class="wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{isset($pessoa) ? $pessoa->PESSOA_NOME : 'Cadastrar'}}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <form class="card-body " method="post" action="{{route('painel.save')}}" enctype="multipart/form-data">
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
                                <input type="text" hidden class="form-control" placeholder="id" id="id" value="{{isset($pessoa) ? $pessoa->ID_PESSOA : 0}}" name="id">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <!-- Profile Image -->
                                            <div class="card card-primary card-outline">
                                                <div class="card-body box-profile">
                                                    <div style="margin-left:25px" id="profile-container" class="text-center">
                                                        <a href="#"><img id="profileImage" class="profile-user-img img-fluid img-circle"
                                                        src=" @if (isset($pessoa->PESSOA_FOTO)) {{asset('/storage/'.$pessoa->PESSOA_FOTO)}}  @else {{asset('/imagens/facisb_logo.png')}} @endif"
                                                        alt="User profile picture"></a>
                                                    </div>
                                                    <input id="imageUpload"   type="file" value="@if (isset($pessoa->PESSOA_FOTO)) {{asset('/storage/'.$pessoa->PESSOA_FOTO)}}  @else {{asset('/imagens/facisb_logo.png')}} @endif" name="arquivo" placeholder="Photo" capture>

                                                    <h3 class="profile-username text-center">{{isset($pessoa) ? $pessoa->PESSOA_NOME :''}}</h3>

                                                    <p class="text-muted text-center">{{isset($pessoa) ? $pessoa->FUNCAO :''}}</p>
                                                
                                                    <ul class="list-group list-group-unbordered mb-3">

                                                        <li align="center" class="list-group-item"> <strong >Meus Chamados</strong></li>
                                                        
                                                        <li class="list-group-item">
                                                            <b>Abertos</b> <a class="float-right">{{isset($pessoa) ? $qtdchamados :0}}</a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Em Atendimento</b> <a class="float-right">{{isset($pessoa) ? $qtdEmAtendimento :0}}</a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Não atendidos</b> <a class="float-right">{{isset($pessoa) ? $qtdSemAtendimento :0}}</a>
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
                                                    <div class="col-sm-8">
                                                        <label for="select1">Nome</label>
                                                        <input type="text" value="{{isset($pessoa) ? $pessoa->PESSOA_NOME :''}}" class="form-control" id="name" name="name" placeholder="Nome Completo">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="select1">CPF</label>
                                                        <input type="text" value="{{isset($pessoa) ? $pessoa->PESSOA_CPF :''}}" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label for="select1">Email</label>
                                                        <input type="email" value="{{isset($pessoa) ? $pessoa->EMAIL :''}}" class="form-control" id="email" name="email" placeholder="seuemail@provedor.com">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-5">
                                                        <label for="select1">Departamento</label>
                                                        <select class="form-control select2" name="dpto" id="dpto">
                                                            @foreach($dptos as $dpto)
                                                                @if(isset($pessoa) && $pessoa->ID_DPTO == $dpto->ID_DPTO )
                                                                    <option selected value="{{$pessoa->ID_DPTO}}" >{{ $pessoa->DESCRICAO}}</option>
                                                                @else
                                                                <option value="{{$dpto->ID_DPTO}}" >{{$dpto->DESCRICAO}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="select1">Função</label>
                                                        <select  class="form-control select2" name="funcao" id="funcao">
                                                            
                                                            @foreach($funcoes as $funcao)
                                                                @if(isset($pessoa) && $pessoa->ID_FUNCAO == $funcao->ID_FUNCAO)
                                                                    <option selected value="{{$pessoa->ID_DPTO}}" >{{ $pessoa->FUNCAO}}</option>
                                                                @else
                                                                <option value="{{$funcao->ID_FUNCAO}}" >{{$funcao->DESCRICAO}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                    <label for="select1">CEP</label>
                                                        <input type="text" value="{{isset($pessoa) ? $pessoa->PESSOA_CEP :''}}" onblur="pesquisacep(this.value);" class="form-control" id="cep" name="cep" placeholder="CEP">
                                                    </div>
                                                
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-8">
                                                        <label for="select1">Rua/Logradouro</label>
                                                        <input  type="text" readonly value="{{isset($pessoa) ? $pessoa->PESSOA_BAIRRO : ''}}" class="form-control" id="end" name="end" placeholder="Rua, Logradouro...">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="select1">Bairro</label>
                                                        <input type="text" readonly value="{{isset($pessoa) ? $pessoa->PESSOA_BAIRRO : ''}}" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label for="select1">Telefone</label>
                                                        <input type="text" value="{{isset($pessoa) ? $pessoa->PESSOA_TEL :''}}" class="form-control" id="tel" name="tel" placeholder="Telefone para contato">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class=" col-sm-10">
                                                        <button type="submit" class="btn btn-danger">{{isset($pessoa) ? 'Atualizar': 'Cadastar'}}</button>
                                                    </div>
                                                </div>
                                                    
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
    </div>
   
@stop

@section('css')
   
@stop

@section('js')

  
@stop


