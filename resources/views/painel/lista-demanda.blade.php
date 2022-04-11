@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pain�is Rotativo</h1>
    <meta charset="utf-8">
    
@stop

@section('content')
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
    <div class="container-fluid">
        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>OPS!</strong> Ocorreu um erro.
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
            <strong>Sucesso!</strong> Operação realizada com sucesso.
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
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group col-12">
                            <button type="button" title="Novo Departamento" data-toggle="modal" data-target="#novo" class="btn btn-success "><i class="fas fa-plus"> Novo</i></button>
                            </div>
                            <div class="modal fade" id="novo" >
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Criar nova Demanda</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="card-body " method="get" action="{{url('admin/nova-demanda')}}" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>DESCRIÇÃO</label>
                                                            <input required name="descricao" type="text" palceholder="Nova Demanda..." class="form-control" ">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="submit" class="btn btn-success">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="geral" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Demanda</th>
                                        <th>Status</th>
                                        <th>Data Cadastro</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($demandas as $demanda)
                                        <tr>
                                            <th>{{$demanda->d_descricao}}</th>
                                            <th>{{$demanda->d_status}}</th>
                                            <th>{{date('d/m/Y', strtotime($demanda->data_cad))}}</th> 
                                            <td>
                                                <button type="button" title="Editar" data-toggle="modal" data-target="#editar-{{$demanda->id_demanda}}" class="btn btn-success btn-xs"><i class="fas fa-user-edit"></i></button>
                                                @if($nivel == 'A')
                                                <button type="button" title="Exckuir" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#excluir-{{$demanda->id_demanda}}">
                                                    <i class="fas fa-trash-alt"></i> 
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                        <!-- Modal nunca deve ficar dentro da <tr> pq não aparece no modo mobile e trava a tela -->
                                        <div class="modal fade" id="excluir-{{$demanda->id_demanda}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Você deseja EXCLUIR a Demanda <strong> {{$demanda->d_descricao}}</strong> ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{url('admin/exclui-demanda',$demanda->id_demanda)}}" >
                                                            <button type="button" class="btn btn-danger">Sim</button>
                                                        </a>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="editar-{{$demanda->id_demanda}}" >
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Editanto {{$demanda->d_descricao}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="card-body " method="get" action="{{url('admin/edita-demanda',$demanda->id_demanda)}}" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>DESCRIÇÃO</label>
                                                                        <input required name="descricao" value="{{$demanda->d_descricao}}" type="text" class="form-control" ">
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="submit" class="btn btn-success">Salvar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
@stop

@section('css')
   
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
