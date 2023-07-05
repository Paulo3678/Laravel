<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreate;
use App\Models\Series;
use Illuminate\Http\Request;
use App\Events\SeriesCreated;
use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Request $request)
    {
        $series = Series::all();
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
        $coverPath = $request->file('cover')->store('series_cover', 'public');
        $request->coverPath = $coverPath;
        SeriesCreate::dispatch($request); 
           
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$request->nome}' adicionada com sucesso");
    }

    public function destroy(Series $series)
    {
        $series->delete();

        

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso");
    }
}
