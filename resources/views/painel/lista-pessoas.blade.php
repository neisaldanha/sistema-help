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
                <strong>OPS!</strong> Ocorreu um erro ao Deletar.
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
                <strong>Sucesso!</strong> Usuário deletado com sucesso.
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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        <div class="form-group col-12">
                            <a  href="{{url('painel/edit',0)}}" class="btn btn-success"><i class="fas fa-user-plus"> Novo</i></a> 
                        </div>
                            <table id="geral" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Imagem</th>
                                        <th>Nome</th>
                                        <th>Usuario</th>
                                        <th>Acesso</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $usu)
                                        <tr>
                                            <th>
                                              <img src=" @if ($usu->PESSOA_FOTO) {{asset('/storage/'.$usu->PESSOA_FOTO)}}  @else {{asset('/imagens/facisb_logo.png')}} @endif" width="64px">
                                            </th> 
                                            <th>{{$usu->PESSOA_NOME}}</th>
                                            <td>{{$usu->EMAIL}}</td>
                                            <td>@if ($usu->PESSOA_STATUS == "A") Ativo @else Inativo @endif </td>
                                            <td>
                                                <a href="{{url('painel/edit',$usu->ID_PESSOA)}}" title="Editar" value="" class="btn btn-primary btn-xs"><i class="fas fa-user-edit"></i>  </a>
                                                <a href="#" title="Visualizar" class="btn btn-info btn-xs" title="Fotos"><i class="fa fa-camera"></i></a>
                                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#editar-{{$usu->ID_PESSOA}}">
                                                  <i class="fas fa-trash-alt"></i> 
                                                </button>
                                            </td>
                                        </tr>
                                      <!-- Modal nunca deve ficar dentro da <tr> pq não aparece no modo mobile e trava a tela -->
                                      <div class="modal fade" id="editar-{{$usu->ID_PESSOA}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Você vai excluir <strong> {{$usu->PESSOA_NOME}}</strong> ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <a href="{{url('painel/pessoa/delete',$usu->ID_PESSOA)}}">
                                                      <button type="button" class="btn btn-danger">Sim</button>
                                                    </a>
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
  
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
@stop

@section('css')
   
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
