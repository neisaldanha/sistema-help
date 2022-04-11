@extends('layouts.admin')

@section('title', 'Cadatro-Usuário')

@section('content_header')

@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
              <!--
              <div class="col-md-3">
                <a href="mailbox.html" class="btn btn-primary btn-block mb-3">Back to Inbox</a>

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Folders</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item active">
                        <a href="#" class="nav-link">
                          <i class="fas fa-inbox"></i> Inbox
                          <span class="badge bg-primary float-right">12</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-envelope"></i> Sent
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-file-alt"></i> Drafts
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="fas fa-filter"></i> Junk
                          <span class="badge bg-warning float-right">65</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-trash-alt"></i> Trash
                        </a>
                      </li>
                    </ul>
                  </div>
                  
                </div>
                
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Labels</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                
                  <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-circle text-danger"></i> Important</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-circle text-warning"></i> Promotions</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-circle text-primary"></i> Social</a>
                      </li>
                    </ul>
                  </div>
                  
                </div>
              
              </div>
                -->
                <div class="container-fluid">
                    @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>OPS!</strong> Ocorreu um erro !.
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
                        <strong>Sucesso!</strong>E-mail enviado com sucesso!
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
                <!-- /.col -->
                <div class="col-md-12">
                  <form method="get" action="{{url('email/send-email/store')}}">
                      
                        <div class="card card-primary card-outline">
                          <div class="card-header">
                            <h3 class="card-title">Novo E-mail</h3>
                          </div>
                          
                              <!-- /.card-header -->
                            <div class="card-body">
                              <div class="form-group">
                                <input class="form-control" name="nome" placeholder="Seu Nome">
                              </div>
                              <div class="form-group">
                                <input class="form-control" name="email" placeholder="E-mail">
                              </div>
                              <div class="form-group">
                                  <textarea id="compose-textarea11111"  name="message" class="form-control" rows='5' placeholder="Mensagem...." ></textarea>
                              </div>
                              <!--
                              <div class="form-group">
                                <div class="btn btn-default btn-file">
                                  <i class="fas fa-paperclip"></i> Attachment
                                  <input type="file" name="attachment">
                                </div>
                                <p class="help-block">Max. 32MB</p>
                              </div>
                              -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                              <div class="float-right">
                                <button title="Enviar E-mail" type="submit" class="btn btn-primary"><i class="far fa-envelope "></i> Enviar</button>
                                <button hidden type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
                                <button hidden type="submit" class="btn btn-primary"><i class="far fa-envelope "></i> Enviar</button>
                              </div>
                              
                              <button hidden type="reset" class="btn btn-default"> Discard</button>
                            </div>
                          <!-- /.card-footer -->
                        </div>
                  </form>
                </div>
              <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content --> 
@stop

@section('css')
   
@stop

@section('js')

@stop


