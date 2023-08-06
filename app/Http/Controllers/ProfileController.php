<?php

namespace App\Http\Controllers;

use App\Models\Carregamento;
use App\Models\Cotas;
use App\Models\Explicacao;
use App\Models\Noticia;
use App\Models\User;
use App\Models\Credito;
use App\Models\Associado;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user_id = auth()->user()->id; // Get the ID of the currently authenticated user
        $explicacoes = Explicacao::where('user_id', $user_id)->paginate(2);
        $noticias = Noticia::where('user_id', $user_id)->get();
        $compras = $user->compras()->paginate(2); // Obtém as compras relacionadas ao usuário
        $lastCota = Cotas::latest('created_at')->first();
        $message = session()->get('success'); // Get the success message from the session
        $associados = Associado::all();

        return view('perfil')->with(['explicacoes'=>$explicacoes, 'compras'=>$compras, 'noticias'=>$noticias, 'lastCota'=>$lastCota,'message' => $message,'associados' => $associados]);
    }

    public function store(Request $request)
    {

        $carregamento = new Carregamento();
        $carregamento->user_id = auth()->id();
        $carregamento->valor = $request->valor;
        $carregamento->estado = 'pendente';
        $carregamento->save();

        return redirect()->route('perfil')->with('success', 'O carregamento foi solicitado com sucesso. Aguarde a aprovação do administrador.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|string|email|max:255',
            'telemovel' => 'nullable|string',
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarNome = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images/avatars'), $avatarNome);
            $user->avatar = 'images/avatars/' . $avatarNome; // Atribui o caminho do avatar ao usuário
        }

        // Verifica se o campo email foi enviado e atualiza o valor
        if (isset($validatedData['email'])) {
            $user->email = $validatedData['email'];
        }

        // Verifica se o campo telemovel foi enviado e atualiza o valor
        if (isset($validatedData['telemovel'])) {
            $user->telemovel = $validatedData['telemovel'];
        }

        $user->save();

        return back()->withErrors(['status' => 'As alterações foram salvas com sucesso!']);
    }


    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('explicacoes')
            ->withSuccess(__('Post delete successfully.'));
    }

    public function associar($id){
        // find the user with the given id
        $user = User::find($id);
        $user->associado = 1;
        // save the new associado to the database
        $user->save();

        return redirect()->action([ProfileController::class, 'index'])->with('success', 'Pedido de associado efetuado com sucesso');
    }

}
