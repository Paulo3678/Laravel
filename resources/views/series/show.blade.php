<x-layout title="Atualizar série">
    <form action="{{ route('series.update', $serie->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="novoNome">Novo nome: </label>
        <div class="form-group d-flex align-items-center">
            <input type="text" name="novoNome" id="novoNome" class="form-control" value="{{ $serie->nome }}">
            <button class="btn btn-success my-2 mx-2">Atualizar</button>
        </div>

    </form>
</x-layout>
