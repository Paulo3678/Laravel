<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        // para fazer a busca já trazendo o relacionamento
        $series = Serie::with(['temporadas'])->get();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $serie = Serie::create($request->all());

        /** 
         * Bulk insert
         * 
         */

        $seasons = [];
        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $seasons[] = [
                'series_id' => $serie->id,
                'numero' => $i
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach ($serie->temporadas as $season) {
            for ($j = 1; $j <= $request->episodesPerSeaso; $j++) {
                $episodes[] = [
                    "season_id" => $season->id,
                    "numero" => $j
                ];
            }
        }

        Episode::insert($episodes);


        return to_route('series.index')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }

    // O nome do parâmetro importa
    // Serie $series-> Traz algumas perdas de performance, mas traz uma maior facilidade
    public function destroy(Serie $series, Request $request)
    {
        // Se não existir o laravel não faz nada
        $series->delete();
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Serie $series)
    {
        dd($series->temporadas());
        return view('series.show')->with("serie", $series);
    }


    public function update(Serie $series, SeriesFormRequest $request)
    {
        $series->nome = $request->novoNome;
        $series->save();
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série atualizada com sucesso.");
    }
}
