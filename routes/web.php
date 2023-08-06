<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


//Guest------------------------------------------------------------------------------------------------
//Pagina Explicações
Route::get('/', [App\Http\Controllers\ExplicacaoController::class, 'index'])->name('explicacoes');
//Pagina Noticias
Route::get('/noticias', [App\Http\Controllers\NoticiaController::class, 'index'])->name('noticias');
//Search Explicações
Route::get('/search', [App\Http\Controllers\ExplicacaoController::class, 'search'])->name('explicacoes.search');


//Autenticação---------------------------------------------------------------------------------------------------
// Login Routes...
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// Password Reset Routes...
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

//Registo
Route::get('/confirmacao', [App\Http\Controllers\Auth\RegisterController::class, 'confirmacao'])->name('confirmacao');


//Perfil Global----------------------------------------------------------------------------------------------------
//Verificar se está logado
Route::middleware(['web', 'auth'])->group(function () {

    //Route::resource('perfil', App\Http\Controllers\ProfileController::class);
    //Pagina Perfil
    Route::get('perfil', [App\Http\Controllers\ProfileController::class, 'index'])->name('perfil');
    //Update User
    Route::put('/perfil/{user}',[App\Http\Controllers\ProfileController::class,'update'])->name('perfil.update');
    //Associar utilizador
    Route::post('/perfil/associar/{id?}',[App\Http\Controllers\ProfileController::class,'associar'])->name('perfil.associar');

    //Route::get('/perfil/{user}', [App\Http\Controllers\ProfileController::class, 'delete'])->name('perfil.delete');
});


//Administrador
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//DashBoard-----------------------------------------------------------------------------------------------------
//Pagina Dashboard
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');


//Users---------------------------------------------------------------------------------------------------------
//Main Page
    Route::get('/dashboard/users', [App\Http\Controllers\AdminController::class, 'userslist'])->name('admin.users.list');
//Desativar User
    Route::post('/dashboard/{id?}/deactivate', [App\Http\Controllers\AdminController::class, 'deactivateUser'])->name('admin.users.deactivate');
//Aprovar Professores
    Route::post('/dashboard/{user}/approve', [App\Http\Controllers\AdminController::class, 'approveUser'])->name('admin.users.approve');
//Rejeitar User
    Route::post('/dashboard/{user}/reject', [App\Http\Controllers\AdminController::class, 'rejectUser'])->name('admin.users.reject');


//Noticias------------------------------------------------------------------------------------------------------
//Gerir Noticias
    Route::get('/dashboard/noticias', [App\Http\Controllers\AdminController::class, 'noticiasList'])->name('admin.noticias.list');;
//Noticias Editar
    Route::post('/dashboard/{noticia}', [App\Http\Controllers\AdminController::class, 'noticiaEdit'])->name('admin.noticias.edit');
//Noticias Apagar
    Route::post('/dashboard/{id?}', [App\Http\Controllers\AdminController::class, 'noticiaDelete'])->name('admin.noticias.delete');

//Associados----------------------------------------------------------------------------------------------------------
//Associados Listar
    Route::get('/associados', [App\Http\Controllers\AdminController::class, 'associadosList'])->name('admin.associados.list');
    //Associados Aceitar
    Route::post('/associado/aceitar/{id?}', [App\Http\Controllers\AdminController::class, 'associadoApprove'])->name('admin.associado.approve');
    //Associados Remover
    Route::post('/associado/remover/{id?}', [App\Http\Controllers\AdminController::class, 'associadoRemove'])->name('admin.associado.remove');


//Carregamentos
//Carregamento Aprovar
    Route::post('/carregamentos/{carregamento}/approve', [App\Http\Controllers\AdminController::class, 'carregamentoApprove'])->name('admin.carregamento.approve');
//Carregamento Rejeitar
    Route::post('/carregamentos/{carregamento}/reject', [App\Http\Controllers\AdminController::class, 'carregamentoRemove'])->name('admin.carregamento.remove');

});


//Funções Professor
Route::middleware(['auth', 'professor'])->prefix('professor')->group(function () {

    //Gerir Explicações
    Route::prefix('/explicacoes')->group(function () {
        Route::get('/', [App\Http\Controllers\ExplicacaoController::class, 'index'])->name('explicacoes.index');
        Route::post('/', [App\Http\Controllers\ExplicacaoController::class, 'createExplicacao'])->name('explicacoes.create');
        Route::post('/{explicacao}', [App\Http\Controllers\ExplicacaoController::class, 'updateExplicacoesMain'])->name('explicacoes.updateMain');
        Route::post('perfil/{explicacao}', [App\Http\Controllers\ExplicacaoController::class, 'updateExplicacoesPerfil'])->name('explicacoes.updatePerfil');
        Route::delete('/{explicacao}', [App\Http\Controllers\ExplicacaoController::class, 'deleteExplicacaoMain'])->name('explicacoes.deleteMain');
        Route::delete('perfil/{explicacao}', [App\Http\Controllers\ExplicacaoController::class, 'deleteExplicacaoPerfil'])->name('explicacoes.deletePerfil');

        //Filter intervention
        Route::get('/explicacoes/filter', [App\Http\Controllers\ExplicacaoController::class, 'filtrar'])->name('explicacoes.filtrar');
    });

    //Gerir Noticias
    Route::prefix('/noticias')->group(function () {
        Route::resource('noticias', App\Http\Controllers\NoticiaController::class);
        Route::get('/{noticia}/edit', [App\Http\Controllers\NoticiaController::class, 'edit'])->name('noticia_edit');
        Route::post('/', [App\Http\Controllers\NoticiaController::class, 'store'])->name('noticias.store');
        Route::delete('/{noticia}', [App\Http\Controllers\NoticiaController::class, 'destroy'])->name('noticia_delete');
    });

});

//Funções do aluno
Route::middleware(['auth', 'aluno'])->prefix('aluno')->group(function () {
    Route::post('/perfil/carregar', [App\Http\Controllers\ProfileController::class, 'store'])->name('carregar');
    Route::post('/explicacoes/{explicacao}/comprar', [App\Http\Controllers\ExplicacaoController::class, 'comprarExplicacao'])->name('explicacoes.comprar');
});
