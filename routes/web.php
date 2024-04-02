<?php

use App\Http\Controllers\Avaliacao\AvaliacaoController;
use App\Http\Controllers\Avaliacao\TituloedescricaoController;
use App\Http\Controllers\Empresas\EmpresaController;
use App\Http\Controllers\Empresas\Pessoas\PessoaController;
use App\Http\Controllers\Empresas\Setores\SetoresController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pessoas\parausuarios\ProvasparausuarioController;
use App\Http\Controllers\Usuario\Pararesponder;
use App\Http\Controllers\Usuario\Pararespondercontroller;
use App\Models\Setor;
use App\Models\Tituloedescricao;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'user'])->name('home');


    Route::resources(['titulo.setor.usuario'=> Pararespondercontroller::class],['shallow',true]);
    
});
    /*------------------------------------------
    --------------------------------------------
    All Admin Routes List
    --------------------------------------------
    --------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    // rota para Adm visualizar as provas 
    Route::get('/admin/{titulo}/',[PararesponderController::class ,'show'])->name('visualizar.index.prova');
    // para visualizar a resposta do usuario 
    Route::get('/admin/{titulo}/avaliacao/setor/{user}/usuario', [Pararespondercontroller::class ,'Respostadousuario'])->name('resposta.usuario');
    Route::get('/admin/{titulo}/avaliacao/setor/{user}/usuario/corrigirprova', [Pararespondercontroller::class ,'CorrigirProva'])->name('corrigir.usuario');
    Route::post('/admin/{titulo}/avaliacao/setor/{user}/usuario/corrigirprova/correcaodaprovadoaluno', [Pararespondercontroller::class ,'ProvaCorrigida'])->name('corrigido.usuario.avaliacao');


    Route::resources([
        'empresas' => EmpresaController::class,
        'empresas.setor'=> SetoresController::class,
        'empresas.setor.pessoas'=> PessoaController::class,
        'empresas.setor.pessoas.prova'=> ProvasparausuarioController::class,
    ], ['shallow'=>true]);
    Route::get('/empresasJson', [EmpresaController::class, 'empresaJson'])->name("empresas.json");
    Route::get('/pessoasJson/{setor}/{empresa}', [PessoaController::class, 'indexJson'])->name("pessoa.json");
    Route::get('/setoresJson', [SetoresController::class, 'setorJson'])->name("setor.json");

    Route::resources([
        'titulos' => TituloedescricaoController::class,
        'titulos.avaliacao' => AvaliacaoController::class,
    ], ['shallow' => true]);
    Route::get('/tituloJson', [TituloedescricaoController::class, 'TituloedescriJson'])->name("titulos.json");
   

 /*   Route::resource("empresas",EmpresaController::class)->only(['index','edit','create','store','update'])->missing(function(){
        return redirect()->route("empresas.index");
    });
    
    Route::get('/empresas/buscaporid/{id}', [EmpresaController::class, 'Buscarporid']);
    Route::get('/empresasJson', [EmpresaController::class, 'empresaJson'])->name("empresas.json");*/
});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
/*
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/