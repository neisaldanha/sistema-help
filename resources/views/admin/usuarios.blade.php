@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Usuarios</h1>
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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group col-10">
                  <a  href="{{url('admin/register',0)}}" class="btn btn-success"><i class="fas fa-user-plus"> Usuário</i>
                  </a> 
                </div>
                <table id="geral" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>Imagem</th>
                      <th>Nome</th>
                      <th>USUARIO</th>
                      <th>EMAIL</th>
                      <th>NIVEL</th>
                      <th>Ações</th>
                  </tr>
                  </thead>
                  <tbody>
                   
                  @foreach($users as $use)
                    <tr>
                        <th>
                        <img src=" @if ($use->PESSOA_FOTO) {{asset('/storage/'.$use->PESSOA_FOTO)}}  @else {{asset('/imagens/facisb_logo.png')}} @endif" width="64px">
                        </th> 
                        <td>{{$use->PESSOA_NOME}}</td>
                        <th>{{$use->USU_LOGIN}}</th>
                        <td>{{$use->EMAIL}}</td>
                        <td>@if ($use->USU_NIVEL == "A") Administrador @elseif($use->USU_NIVEL == "C") Comum @else Supervisor @endif </td>
                        <td>
                          <a href="{{url('admin/ver/user',$use->ID_USUARIO)}}" title="Editar" value="" class="btn btn-primary btn-xs"><i class="fas fa-user-edit"></i>  </a>
                          <a href="#" title="Visualizar" class="btn btn-info btn-xs" title="Fotos"><i class="fa fa-camera"></i></a>
                            <!-- Button trigger modal -->
                          <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#editar-{{$use->ID_USUARIO}}">
                            <i class="fas fa-trash-alt"></i> 
                          </button>
                            
                        </td>
                    </tr>
                    <!-- Modal nunca deve ficar dentro da <tr> pq não aparece no modo mobile e trava a tela -->
                    <div class="modal fade" id="editar-{{$use->ID_USUARIO}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Você vai excluir <strong> {{$use->USU_LOGIN}}</strong> ?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          
                            <div class="modal-footer">
                            <a href="{{url('admin/user/delete',$use->ID_USUARIO)}}" title="Excluir"  >
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@stop

@section('css')
   
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
