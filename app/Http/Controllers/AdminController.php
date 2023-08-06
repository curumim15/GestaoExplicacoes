<?php

namespace App\Http\Controllers;

use App\Mail\Aprovado;
use App\Mail\Rejeitado;
use App\Models\Associado;
use App\Models\Carregamento;
use App\Models\Noticia;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function dashboard()
    {
        $userCount = User::where('estado', 1 )->count();
        $associadosCount= Associado::all()->count();
        $users = User::all();
        $carregamentos = Carregamento::where('estado', 'pendente')->get();

        //dd($carregamentos);
        $associados = Associado::all();

       //dd( $users);

        return view('admin.dashboard')->with(['userCount'=>$userCount, 'associadosCount'=>$associadosCount, 'users'=>$users, 'carregamentos'=>$carregamentos, 'associados'=>$associados ]);
    }

//Users--------------------------------------------------------------------------------------------

    public function userslist()
    {
        $users = User::where('estado', '!=', 0 )->get();
        $roles = Role::all();

        return view('admin.users', compact('users', 'roles'));
    }

    public function approveUser(User $user)
    {
        // Update the user's status to approved
        $user->estado = true;
        $user->save();

        // Redirect back to the users list
        return redirect()->back()->with('success', 'Utilizador aprovado com sucesso');
    }

    public function rejectUser(User $user)
    {

        $user->delete();

        // Redirect back to the users list
        return redirect()->back()->with('success', 'Utilizador removido com sucesso');
    }


//Carregamentos----------------------------------------------------------------------------------
    public function carregamentoApprove(Request $request, Carregamento $carregamento)
    {
        $carregamento->estado = 'aprovado';
        $carregamento->save();

        // Atualizar o crédito do usuário
        $user = $carregamento->user;
        $user->credito += $carregamento->valor;
        $user->save();

        return redirect()->back()->with('success', 'Carregamento aprovado com sucesso.');
    }

    public function carregamentoRemove(Request $request, Carregamento $carregamento)
    {
        $carregamento->estado = 'rejeitado';
        $carregamento->save();

        return redirect()->back()->with('success', 'Carregamento rejeitado com sucesso.');
    }

//Associados----------------------------------------------------------------------------------

    public function associadosList()
    {
        $users = User::whereHas('associados')->get();

        return view('admin.associados')->with('users', $users);
    }

//Associados Aceitar
    public function associadoApprove($id)
    {

       // dd($id);

        $associado = new Associado();

        $associado->user_id = $id;
        $associado->estado = 1;

        $associado->save();

        $user = User::findOrFail($id);
        $user->associado = 0;
        $user->save();


        // Redirect back to the users list
        return redirect()->back()->with('success', 'Utilizador aprovado com sucesso');
    }

    public function associadoRemove($id)
    {
        $user = User::findOrFail($id);
        $user->associado = 0;
        $user->save();

        // Redirect back to the users list
        return redirect()->back()->with('success', 'Utilizador rejeitado com sucesso');
    }

//Noticias----------------------------------------------------------------------------------------

    public function noticiasList()
    {
        $noticias = Noticia::all();
        return view('admin.noticias', compact('noticias'));
    }


}
