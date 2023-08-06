<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::orderBy('created_at', 'desc')->paginate(6);
        return view('noticias.index', compact('noticias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'assunto' => 'required',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $noticia = new Noticia();
        $noticia->titulo = $request->input('titulo');
        $noticia->assunto = $request->input('assunto');
        $noticia->descricao = $request->input('descricao');
        $noticia->user_id = auth()->user()->id;


        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $imagemNome = time() . '.' . $imagem->getClientOriginalExtension();
            $caminhoDestino = public_path('images/noticias');
            $imagem->move($caminhoDestino, $imagemNome);
            $imagemPath = 'images/noticias/' . $imagemNome;
            $noticia->imagem = $imagemPath;
        }

        $noticia->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $noticia = Noticia::findOrFail($id);

        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'assunto' => 'required',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $noticia->titulo = $request->titulo;
        $noticia->assunto = $request->input('assunto');
        $noticia->descricao = $request->descricao;
        $noticia->save();

        if ($request->hasFile('imagem')) {
            // Excluir a imagem antiga, se necessário
            if ($noticia->imagem) {
                Storage::delete($noticia->imagem);
            }

            // Fazer upload da nova imagem
            $caminhoImagem = $request->imagem->store('public/images/noticias');
            $noticia->imagem = $caminhoImagem;
        }

        return back()->with('success', 'As alterações foram salvas com sucesso!');
    }

    public function delete($id)
    {
        $noticia = Noticia::findOrFail($id);

        if ($noticia->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
