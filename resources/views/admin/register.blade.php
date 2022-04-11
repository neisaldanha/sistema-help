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
                     <h3 class="card-title">@if(isset($user)) Atualizar {{$user->USU_LOGIN}} @else Cadastrar novo usuário @endif</h3>
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
                     
                     <input type="text" hidden class="form-control" placeholder="id" id="id" value="{{isset($user) ? $user->ID_USUARIO : 0}}" name="id">
                     <div class="form-group">
                        <label for="select1">Nome</label>
                        <select @if(isset($user)) readonly @endif class="form-control"name="pessoa" id="selects">
                        @if (isset($user))
                           <option value=" {{$user->ID_PESSOA}}" >{{$pessoa}}</option>
                        @else
                           @foreach($pessoas as $p)
                           <option value=" {{$p->ID_PESSOA}}" > {{$p->PESSOA_NOME}}</option>
                           @endforeach
                        @endif
                        </select>
                     </div>
                     <div class="form-group">
                        
                        <input class="form-control" placeholder="Login" id="usuario" value="{{isset($user) ? $user->USU_LOGIN : ''}}" name="usuario">

                     </div>
                     
                     <div class="form-group">
                        <input type="password" class="form-control" placeholder="Digite a senha" id="senha" value="{{isset($user) ? $user->SENHA : ''}}" name="password">
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                     </div>
                     @if ($nivel == "A")
                     <div class="form-group">
                        <label for="select1">Tipo de acesso</label>
                        <select  class="form-control select2" name="tipo" id="selects">
                            @if (isset($user) && $user->USU_NIVEL == "A")
                                <option selected="true" value="{{$user->USU_NIVEL}}">Administrador</option>
                                <option value="S">Supervisor</option>
                                <option value="C">Comum</option>
                            @elseif(isset($user) && $user->USU_NIVEL == "C")
                                <option selected="true" value="{{$user->USU_NIVEL}}">Comum</option>
                                <option value="A">Administrador</option>
                                <option value="S">Supervisor</option>
                            @elseif(isset($user) && $user->USU_NIVEL == "S")
                                <option selected="true" value="{{$user->USU_NIVEL}}">Supervisor</option>
                                <option value="A">Administrador</option>
                                <option value="C">Comum</option>
                            @else
                                <option value="A">Administrador</option>
                                <option value="S">Supervisor</option>
                                <option value="C">Comum</option>
                            @endif
                        </select>
                     </div>
                     @endif
                     <div class="form-group">  
                        <button type="submit" class="btn btn-success">{{isset($user) ? 'Atualizar' : 'Cadastrar'}}</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
</section>   
@stop

@section('css')
   
@stop

@section('js')
  
@stop


