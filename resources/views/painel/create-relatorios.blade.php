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
                     <h3 class="card-title">Gerar Relatório por Setor</h3>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                        </button>
                     </div>
                  </div>
                  <form class="card-body" target="_blank" method="get" action="{{url('painel/graficos-demandas')}}" enctype="multipart/form-data">
                                         
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Departamentos</label>
                                <select class="form-control select2" name="dpto">
		                              @foreach($dptos as $dpto)
		                                 <option value="{{$dpto->ID_DPTO}}" >{{$dpto->DESCRICAO}}</option>
		                              @endforeach
		                          </select>
                            </div>
                        </div>
                        
                    <div class="form-group">  
                        <button type="submit" class="btn btn-success">Gerar</button>
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


