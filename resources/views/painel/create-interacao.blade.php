@extends('layouts.admin')

@section('title', 'Cadatro-Usuário')

@section('content_header')

@stop  

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

@section('content')
 <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
               <div class="card-header">
                     <h3 class="card-title">Interacao com o chamado - {{$chamados->NM_CHAMADO}}</h3>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                        </button>
                     </div>
                  </div>
                <form class="card-body " method="POST" action="{{url('painel/inter-chamado-anexo')}}" enctype="multipart/form-data">
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
                    <input hidden="" type="text" name="dpto" value="{{$dpto}}" />
                    <div id="imagem" class="row">
                      <div class="">
                          <input  type='file'  name='arquivo[]' multiple>
                       </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Interacao</label>
                                <textarea class="form-control" name="interacao" rows="3" placeholder="Interacao" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">  
                        <input hidden type="tesxt" value="{{$chamados->ID_CHAMADO}}" name="id">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
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


