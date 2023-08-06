<?php

namespace App\Http\Controllers;

use App\Models\Compras;
use App\Models\Disponibilidade;
use App\Models\Explicacao;
use App\Models\User;
use Illuminate\Http\Request;

class ExplicacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $explicacoes = Explicacao::paginate(8);

        return view('explicacoes')->with(['explicacoes' => $explicacoes ]);
    }

    public function comprarExplicacao($explicacaoId)
    {
        $explicacao = Explicacao::findOrFail($explicacaoId);
        $aluno = auth()->user();

        // Resto do código da função comprar

        // Verificar se o número máximo de alunos já foi atingido
        if ($explicacao->compras()->count() >= $explicacao->max_alunos) {
            throw new \Exception('Não é possível comprar a explicação. O número máximo de alunos já foi atingido.');
        }

        // Verificar se o aluno já comprou a explicação
        if ($explicacao->compras()->where('user_id', $aluno->id)->exists()) {
            throw new \Exception('Não é possível comprar a explicação. O aluno já comprou esta explicação.');
        }

        // Verificar se o aluno tem créditos suficientes
        if ($aluno->credito < $explicacao->preco) {
            throw new \Exception('Não é possível comprar a explicação. Créditos insuficientes.');
        }

        // Deduzir o preço da explicação dos créditos do aluno
        $aluno->credito -= $explicacao->preco;
        $aluno->save();

        // Restante do código para criar a compra

        // Criar uma nova compra para o aluno
        $compra = new Compras();
        $compra->explicacao_id = $explicacao->id;
        $compra->user_id = $aluno->id;
        $compra->save();

        return redirect()->route('perfil'); // Redirecionar para a rota de perfil
    }

    public function createExplicacao(Request $request)
    {
        $explicacao = new Explicacao();
        $explicacao->disciplina = $request->input('disciplina');
        $explicacao->max_alunos = $request->input('max_alunos');
        $explicacao->descricao = $request->input('descricao');
        $explicacao->preco = $request->input('preco');
        $explicacao->user_id = auth()->user()->id;
        $explicacao->save();

        // get days and hours from the request
        $days = $request->input('days');
        $hours = $request->input('hours');

        // Loop over each day and hour and create a new disponibilidade for each
        for ($i = 0; $i < count($days); $i++) {
            $disponibilidade = new Disponibilidade();
            $disponibilidade->dia = $days[$i];
            $disponibilidade->hora = $hours[$i];
            $disponibilidade->explicacao_id = $explicacao->id;
            $disponibilidade->save();
        }

        return redirect()->route('explicacoes')->with('success', 'Explicação criada com sucesso.');
    }

    public function updateExplicacoesMain(Request $request, $id)
    {
        $explicacao = Explicacao::with('disponibilidades')->where('id', $id)->first();

        $explicacao->disciplina = $request->input('disciplina');
        $explicacao->max_alunos = $request->input('max_alunos');
        $explicacao->descricao = $request->input('descricao');
        $explicacao->preco = $request->input('preco');
        $explicacao->save();

        foreach ($explicacao->disponibilidades as $disponibilidade) {
            $disponibilidade->dia = $request->input('dia_' . $disponibilidade->id);
            $disponibilidade->hora = $request->input('hora_' . $disponibilidade->id);
            $disponibilidade->save();
        }

        return redirect()->route('explicacoes')->with('success', 'Explicação atualizada com sucesso.');
    }

    public function updateExplicacoesPerfil(Request $request, $id)
    {
        $explicacao = Explicacao::with('disponibilidades')->where('id', $id)->first();

        $explicacao->disciplina = $request->input('disciplina');
        $explicacao->max_alunos = $request->input('max_alunos');
        $explicacao->descricao = $request->input('descricao');
        $explicacao->preco = $request->input('preco');
        $explicacao->save();

        foreach ($explicacao->disponibilidades as $disponibilidade) {
            $disponibilidade->dia = $request->input('dia_' . $disponibilidade->id);
            $disponibilidade->hora = $request->input('hora_' . $disponibilidade->id);
            $disponibilidade->save();
        }

        return redirect()->action('App\Http\Controllers\ProfileController@index')->with('success', 'Explicação criada com sucesso.');
    }

    public function deleteExplicacaoMain(Explicacao $explicacao)
    {
        // obter o valor do atributo id do objeto Explicacao e atribuindo-o à variável $explicacaoId
        $explicacaoId = $explicacao->id;

        // para apagar todas as instâncias da tabela disponibilidades onde o campo explicacao_id corresponde ao valor de $explicacaoId.
        // Em outras palavras, está a excluir todas as disponibilidades associadas à explicação cujo id foi passado como parâmetro
        Disponibilidade::where('explicacao_id', $explicacaoId)->delete();

        // Apaga a  Explicacao
        $explicacao->delete();

        return redirect()->route('explicacoes.index')->with('success', 'Explicação editada com sucesso.');
    }

    public function deleteExplicacaoPerfil(Explicacao $explicacao)
    {
        // Retrieve the explicacao_id
        $explicacaoId = $explicacao->id;

        // Delete disponibilidades with the matching explicacao_id
        Disponibilidade::where('explicacao_id', $explicacaoId)->delete();

        // Delete the Explicacao
        $explicacao->delete();

        return redirect()->action('App\Http\Controllers\ProfileController@index')->with(['success' => 'Explicação apagada com sucesso.']);
    }

    public function search(Request $request)
    {
        // Recupera o termo de pesquisa
        $query = $request->input('query');

        // Inicia a consulta
          $explicacoes = Explicacao::query()
            ->where('disciplina', 'LIKE', "%{$query}%")
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            });

        // Verifica se existe um parâmetro de ordenação
        if ($request->has('sort')) {
            if ($request->input('sort') === 'price_asc') {
                $explicacoes->orderBy('preco');
            } elseif ($request->input('sort') === 'price_desc') {
                $explicacoes->orderBy('preco', 'desc');
            }
        }

        // Executa a consulta e retorna os resultados
        return view('explicacoes.explicacoesFiltro')->with('explicacoes', $explicacoes->paginate(8));
    }

}
