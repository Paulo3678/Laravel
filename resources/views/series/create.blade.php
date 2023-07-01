<x-layout title="Nova Série">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('series.store') }}" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" autofocus id="nome" name="nome" class="form-control" value="{{ old('nome') }}">
            </div>
            <div class="col-2">
                <label for="seasonsQty" class="form-label">Número de temporadas:</label>
                <input type="text" id="seasonsQty" name="seasonsQty" class="form-control" value="{{ old('nome') }}">
            </div>
            <div class="col-2">
                <label for="episodesPerSeaso" class="form-label">Eps / Temporada :</label>
                <input type="text" id="episodesPerSeaso" name="episodesPerSeaso" class="form-control" value="{{ old('nome') }}">
            </div>

        </div>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>
