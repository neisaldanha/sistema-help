@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content_header')
<h1>Painéis Rotativo</h1>
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
        <strong>OPS!</strong> Ocorreu um erro ao Fechar chamado.
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
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group col-12">
                            <a href="{{url('painel/form-chamado')}}" class="btn btn-success"><i class="fas fa-envelope"> Novo</i>
                            </a>
                        </div>
                        <table id="chamados" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>CHAMADO</th>
                                    <th>TITULO</th>
                                    <th>Abertura</th>
                                    <th>Usuario</th>
                                    <th>STATUS</th>
                                    <th>VISUALIZADO</th>
                                    <th>Atendente</th>
                                    <th>Prioridade</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($chamados as $chamado)
                                <input hidden="" type="text" value=" {{$diferenca = strtotime(date('Y-m-d H:i:s')) - strtotime($chamado->DATA_ABERTURA)}}">
                                <input hidden="" type="text" value=" {{$dias = floor($diferenca / (60 * 60 * 24))}}">

                                @if($dias > 7 && $chamado->STATUS != 'F')
                                <tr style="color: red;">
                                    @elseif($dias <= 7 && $dias> 4 && $chamado->STATUS != 'F')
                                <tr style="color: orange;">
                                    @elseif($dias <= 4 && $chamado->STATUS != 'F')
                                <tr style="color: green;">
                                    @else
                                <tr>
                                    @endif
                                    <th>{{$chamado->NM_CHAMADO}}</th>
                                    <th title="{{$chamado->d_descricao}}">{{mb_strimwidth($chamado->d_descricao, 0, 10,"...")}}</th>
                                    <th>{{date('d/m/Y', strtotime($chamado->DATA_ABERTURA))}}</th>
                                    <td>{{$chamado->USU_LOGIN}}</td>
                                    <td title="@if($chamado->STATUS == 'A') Aberto @elseif($chamado->STATUS == 'E') Em Atendimento @else Finalizado @endif">@if($chamado->STATUS == 'A') Aberto @elseif($chamado->STATUS == 'E') Em Atend... @else Finalizado @endif</td>
                                    @if($chamado->VIEW == 'S')
                                    <td style="color: green;">@if($chamado->VIEW == 'S') SIM @endif</td>
                                    @else
                                    <td style="color: red;">@if($chamado->VIEW == 'N') Não @endif</td>
                                    @endif
                                    <td>{{$chamado->PESSOA_NOME}}</td>
                                    <td>@if($chamado->PRIORIDADE == '1') Alta @elseif($chamado->PRIORIDADE == '2') Média @else Baixa @endif</td>
                                    @if($chamado->PRINT == 1)
                                    <td style="background-color: #00FA9A;">
                                        @else
                                    <td>
                                        @endif
                                        <!--<a href="{{url('painel/edit-chamado',$chamado->ID_CHAMADO)}}" title="Editar" value="" class="btn btn-primary btn-xs"><i class="fas fa-user-edit"></i>  </a>-->

                                        <button type="button" title="Visualizar" data-toggle="modal" data-target="#editar-{{$chamado->ID_CHAMADO}}" class="btn btn-success btn-xs"><i class="far fa-eye"></i></button>
                                        <a title="Interação" href="{{url('painel/create-interacao',$chamado->ID_CHAMADO)}}" class="btn btn-primary btn-xs"><i class="fas fa-user-edit"></i></a>
                                        <!--<a href="{{url('painel/atende-chamado',$chamado->ID_CHAMADO)}}" title="Atender Chamado" value="" class="btn btn-primary btn-xs"><i class="far fa-hand-paper"></i></a>-->
                                        @if($chamado->ID_ATENDENTE != null)
                                            <button type="button" title="Encerrar chamado" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#encerrar-{{$chamado->ID_CHAMADO}}">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                <!-- Modal nunca deve ficar dentro da <tr> pq não aparece no modo mobile e trava a tela -->
                                <div class="modal fade" id="encerrar-{{$chamado->ID_CHAMADO}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Você deseja encerrar o chamado <strong> {{$chamado->d_descricao}}</strong> ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-footer">
                                                <a href="{{url('painel/chamado/encerra',$chamado->ID_CHAMADO)}}">
                                                    <button type="button" class="btn btn-danger">Sim</button>
                                                </a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade print_div" data-backdrop="static" id="editar-{{$chamado->ID_CHAMADO}}">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{$chamado->d_descricao}}</h4>

                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="card-header p-2">
                                                            <ul class="nav nav-pills">
                                                                <li class="nav-item"><a class="nav-link active" href="#activity-{{$chamado->ID_CHAMADO}}" data-toggle="tab">Chamado</a></li>
                                                                <li class="nav-item"><a class="nav-link" href="#timeline-{{$chamado->ID_CHAMADO}}" data-toggle="tab">Interação</a></li>
                                                                <li class="nav-item"><a class="nav-link" href="#newInter-{{$chamado->ID_CHAMADO}}" data-toggle="tab">Nova Interação</a></li>
                                                                <li class="nav-item"><a href="{{url('painel/atende-chamado',$chamado->ID_CHAMADO)}}" title="Atender Chamado" value="" class="btn btn-success">Atender <i class="far fa-hand-paper"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="card-body ">
                                                        <form method="get" action="{{url('painel/update-chamado',$chamado->ID_CHAMADO)}}" enctype="multipart/form-data">
                                                            <div class="tab-content">
                                                                <div class="active tab-pane" id="activity-{{$chamado->ID_CHAMADO}}">
                                                                    <!-- Post -->
                                                                    <div class="post">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <div class="form-group">
                                                                                    <label>TITULO</label>
                                                                                    <input value="{{$chamado->d_descricao}}" type="text" class="form-control" placeholder="Enter ..." disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <label for="select1">Departamento</label>
                                                                                <select class="form-control select2" name="dpto">
                                                                                    @foreach($dptos as $dpto)
                                                                                    @if($chamado->ID_DPTO == $dpto->ID_DPTO )
                                                                                    <option selected="true" value="{{$chamado->ID_DPTO}}">{{$chamado->DEPARTAMENTO}}</option>
                                                                                    @else
                                                                                    <option value="{{$dpto->ID_DPTO}}">{{$dpto->DESCRICAO}}</option>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @if ($nivel == "A" || $nivel == "S")
                                                                            <div class="form-group">
                                                                                <label for="select1">Prioridade</label>
                                                                                <select class="form-control select2" name="prioridade">
                                                                                    @if($chamado->PRIORIDADE == "1")
                                                                                    <option selected="true" value="{{$chamado->PRIORIDADE}}"> Alta </option>
                                                                                    <option value="3">Baixa</option>
                                                                                    <option value="2">Média</option>
                                                                                    @elseif($chamado->PRIORIDADE == "2")
                                                                                    <option selected="true" value="{{$chamado->PRIORIDADE}}"> Média </option>
                                                                                    <option value="3">Baixa</option>
                                                                                    <option value="1">Alta</option>
                                                                                    @elseif($chamado->PRIORIDADE == "3")
                                                                                    <option selected="true" value="{{$chamado->PRIORIDADE}}"> Baixa </option>
                                                                                    <option value="1">Alta</option>
                                                                                    <option value="2">Média</option>
                                                                                    @else
                                                                                    <option value="3">Baixa</option>
                                                                                    <option value="2">Média</option>
                                                                                    <option value="1">Alta</option>
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="card-primary filter-container p-0 row ">
                                                                            @foreach($imgs as $img)
                                                                            @if($chamado->NM_CHAMADO == $img->NM_CHAMADO)
                                                                            <div class="col-sm-1">
                                                                                <a href="{{asset('/storage/'.$img->IMAGEM)}}" data-toggle="lightbox" data-title="{{$img->IMAGEM}}">
                                                                                    <img class="img-fluid mb-1" src=" @if ($img->IMAGEM) {{asset('/storage/'.$img->IMAGEM)}} @endif">
                                                                                </a>
                                                                            </div>
                                                                            @endif
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label>DESCRIÇÃO</label>
                                                                                    <textarea class="form-control" rows="10" placeholder="Enter ..." disabled>{{$chamado->DESCRICAO}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer justify-content-between">
                                                                            <button type="submit" class="btn btn-success">OK</button>
                                                                            <a href="{{url('painel/gera-pdf-descricao',$chamado->ID_CHAMADO)}}" target="_blank" class="btn btn-primary">Imprimir</a>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="timeline-{{$chamado->ID_CHAMADO}}">
                                                                    @foreach($int as $inter)
                                                                    <div class="timeline-item">
                                                                        @if($chamado->ID_CHAMADO == $inter->ID_CHAMADO)
                                                                        <section class="content">
                                                                            <div class="row">
                                                                                <div class="col-12" id="accordion">
                                                                                    <div class="card card-primary card-outline">
                                                                                        <a class="d-block w-100" data-toggle="collapse" href="#int-{{$inter->ID_INTERACAO_CHAMADO}}">
                                                                                            <div class="card-header">
                                                                                                <h4 class="card-title w-100">{{$inter->PESSOA_NOME}}</h4>
                                                                                            </div>
                                                                                        </a>
                                                                                        <div id="int-{{$inter->ID_INTERACAO_CHAMADO}}" class="collapse" data-parent="#accordion">
                                                                                            <div class="card-body">
                                                                                                {{$inter->INT_DESC_CHAMADO}}
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </section>
                                                                        @endif
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                        </form>
                                                        <!-- Nova Interação -->
                                                        <div class="tab-pane" id="newInter-{{$chamado->ID_CHAMADO}}">
                                                            <form method="get" action="{{url('painel/interacao/chamado',$chamado->ID_CHAMADO)}}" enctype="multipart/form-data">
                                                                <div hidden>
                                                                    <select class="form-control select2" name="dpto">
                                                                        @foreach($dptos as $dpto)
                                                                        @if($chamado->ID_DPTO == $dpto->ID_DPTO )
                                                                        <option hidden selected="true" value="{{$chamado->ID_DPTO}}">{{$chamado->DEPARTAMENTO}}</option>
                                                                        @else
                                                                        <option value="{{$dpto->ID_DPTO}}">{{$dpto->DESCRICAO}}</option>
                                                                        @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>Interacao</label>
                                                                            <textarea class="form-control" name="interacao" rows="3" placeholder="Interacao"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input hidden type="tesxt" value="{{$chamado->ID_CHAMADO}}" name="id">
                                                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

@stop