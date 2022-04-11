<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PessoasController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ChamadosController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\FuncaoController;
use App\Http\Controllers\SendEmailController;
//use App\Http\Controllers\API\AccessTokenController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();


Route::post('/auth/check',[UsuarioController::class, 'check'])->name('auth.check');
Route::get('/auth/logout',[UsuarioController::class, 'logout'])->name('auth.logout');




Route::group(['middleware'=>['AuthCheck']], function(){
    Route::get('/auth/login',[UsuarioController::class, 'login'])->name('auth.login');

    // Rotas do Usuário
    Route::get('/admin/home',[UsuarioController::class, 'dashboard']);
    Route::post('/admin/store',[UsuarioController::class, 'store'])->name('auth.save');
    Route::get('/admin/register/{id}',[UsuarioController::class, 'show']);
    Route::get('/admin/usuarios',[UsuarioController::class,'index']);
    Route::get('/storage/app/imagens/{id}',[UsuarioController::class,'index']);
    Route::get('/admin/ver/user/{id}',[UsuarioController::class,'show'])->name('admin.show');
    Route::get('/admin/editar/user/{id}',[UsuarioController::class,'edit'])->name('admin.edit');
    Route::get('/admin/update/{id}',[UsuarioController::class,'update'])->name('admin.update');
    Route::get('/admin/user/delete/{id}',[UsuarioController::class,'destroy'])->name('admin.usuarios');

    // Rotas Administrativo - Departamentos
    Route::get('/admin/departamentos',[DepartamentosController::class,'index']);
    Route::get('/admin/novo-departamento',[DepartamentosController::class,'store']);
    Route::get('/admin/edita-departamento/{id}',[DepartamentosController::class,'update']);
    Route::get('/admin/exclui-departamento/{id}',[DepartamentosController::class,'destroy']);
    
    //Rota Demandas
    
    Route::get('/admin/nova-demanda',[DemandaController::class,'store']);
    Route::get('/admin/edita-demanda/{id}',[DemandaController::class,'update']);
    Route::get('/admin/exclui-demanda/{id}',[DemandaController::class,'destroy']);
    Route::get('/admin/lista-demandas',[DemandaController::class,'index']);

      // Rotas Administrativo - Funções
    Route::get('/admin/funcoes',[FuncaoController::class,'index']);
    Route::get('/admin/nova-funcao',[FuncaoController::class,'store']);
    Route::get('/admin/edita-funcao/{id}',[FuncaoController::class,'update']);
    Route::get('/admin/exclui-funcao/{id}',[FuncaoController::class,'destroy']);

    // Rotas Painel
    Route::get('/painel/lista-pessoas',[PessoasController::class,'index']);
    Route::get('/painel/edit/{id}',[PessoasController::class,'show']);
    Route::post('/painel/store',[PessoasController::class, 'store'])->name('painel.save');
    Route::get('/painel/pessoa/delete/{id}',[PessoasController::class,'destroy'])->name('painel.pessoas');

    //CHAMADOS
    Route::get('/painel/lista-chamados',[ChamadosController::class,'index']);
    Route::get('/painel/lista-chamados-dpto-finalizados',[ChamadosController::class,'chamadosFinalizados']);
    Route::get('/painel/relatorio-chamados-finalizados',[ChamadosController::class,'relatorioFinalizados']);
    Route::get('/painel/form-chamado',[ChamadosController::class,'create']);
    Route::post('/painel/cria-chamado/store',[ChamadosController::class, 'store']);
    Route::get('/painel/interacao/chamado/{id}',[ChamadosController::class,'update']);
    Route::post('/painel/inter-chamado-anexo/',[ChamadosController::class,'update']);
    Route::get('/painel/chamado/encerra/{id}',[ChamadosController::class,'destroy']);
    Route::get('/painel/atende-chamado/{id}',[ChamadosController::class,'edit']);
    Route::get('/painel/update-chamado/{id}',[ChamadosController::class,'updatechamado']);
    Route::get('/painel/create-interacao/{id}',[ChamadosController::class,'show']);
    Route::get('/painel/lista-chamados-dpto',[ChamadosController::class,'chamadosDpto']);
    Route::get('/painel/gera-pdf-descricao/{id}',[ChamadosController::class,'pdfDescricao']);

    // Send E-mails
    Route::get('/email/form-email',[SendEmailController::class,'index']);
    Route::get('/email/send-email/store',[SendEmailController::class, 'send']);

    // AJAX CONTROLLER
    Route::get('get-funcao-pesquisa', [AjaxController::class,'getFuncao']);
    
    // Rotas de Relatórios
    Route::get('painel/relatorio-demandas',[ChamadosController::class,'geraPDF']);
    Route::get('painel/graficos-demandas',[ChamadosController::class,'geraGraficos']);
    Route::get('painel/demandas-setores',[ChamadosController::class, 'relatorios']);
    
    //Route::get('access_token', [AccessTokenController::class,'generate_token']);
    //Route::get('access_token', 'API\AccessTokenController@generate_token');
    
});

