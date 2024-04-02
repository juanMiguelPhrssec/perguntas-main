<?php

namespace App\Http\Controllers;

use App\Models\ProvaparaUsuario;
use App\Models\Resposta;
use App\Models\Tituloedescricao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user()
    {
        $possuiprova = ProvaparaUsuario::where('pessoas_id', auth()->id())->count();

        $prova = ProvaparaUsuario::where('pessoas_id', auth()->id())->first();
        $titulo = $prova ? $prova->nome_aval : null;
        $user = User::find(auth()->id());
        $setor = $user->setors_id;
 
        
       // $setor = ProvaparaUsuario::where('setor_id', $setorId)->first();

        
        



        return view('home', compact('possuiprova', 'titulo','setor'));
    }
    public function adminHome()
    {

        $provas = Tituloedescricao::where('Admin_id', true)->count();
        $statusprovaAvaliado = ProvaparaUsuario::count();



        $statusprova = User::count();
        
        return view('dashboard', compact('provas','statusprovaAvaliado', 'statusprova'));
    }
}
