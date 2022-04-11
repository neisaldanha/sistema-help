@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Painéis Rotativo</h1>
    <meta charset="utf-8">
    
@stop

@section('content')
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
                                            <h4 class="modal-title">Criar nova Função</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="card-body " method="get" action="{{url('admin/nova-funcao')}}" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>DESCRIÇÃO</label>
                                                            <input  name="descricao" type="text" palceholder="Nova Função..." class="form-control" ">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="select1">Departamento</label>
                                                        <select class="form-control select2" name="dpto" id="dpto">
                                                            @foreach($dptos as $dpto)
                                                                <option value="{{$dpto->ID_DPTO}}" >{{$dpto->DESCRICAO}}</option>
                                                            @endforeach
                                                        </select>
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
                                        <th>Funcao</th>
                                        <th>Departamento</th>
                                        <th>Data Cadastro</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($funcs as $func)
                                        <tr>
                                            <th>{{$func->FUNCAO}}</th>
                                            <th>{{$func->DEPARTAMENTO}}</th>
                                            <th>{{date('d/m/Y', strtotime($func->DATA_CAD))}}</th> 
                                            <td>
                                                <button type="button" title="Editar" data-toggle="modal" data-target="#editar-{{$func->ID_FUNCAO}}" class="btn btn-success btn-xs"><i class="fas fa-user-edit"></i></button>
                                                <button type="button" title="Exckuir" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#excluir-{{$func->ID_FUNCAO}}">
                                                    <i class="fas fa-trash-alt"></i> 
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal nunca deve ficar dentro da <tr> pq não aparece no modo mobile e trava a tela -->
                                        <div class="modal fade" id="excluir-{{$func->ID_FUNCAO}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Você deseja EXCLUIR a Função <strong> {{$func->FUNCAO}}</strong> ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{url('admin/exclui-funcao',$func->ID_FUNCAO)}}" >
                                                            <button type="button" class="btn btn-danger">Sim</button>
                                                        </a>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="editar-{{$func->ID_FUNCAO}}" >
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Editanto {{$func->FUNCAO}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="card-body " method="get" action="{{url('admin/edita-funcao',$func->ID_FUNCAO)}}" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label>DESCRIÇÃO</label>
                                                                        <input  name="descricao" value="{{$func->FUNCAO}}" type="text" class="form-control" ">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="select1">Departamento</label>
                                                                    <select class="form-control select2" name="dpto">
                                                                        @foreach($dptos as $dpto)
                                                                        @if($func->ID_DPTO == $dpto->ID_DPTO )
                                                                            <option selected="true" value="{{$func->ID_DPTO}}" >{{$func->DEPARTAMENTO}}</option>
                                                                        @else
                                                                        <option value="{{$dpto->ID_DPTO}}" >{{$dpto->DESCRICAO}}</option>
                                                                        @endif
                                                                        @endforeach
                                                                    </select>
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
