@extends('base')

@section('article_creation')
    <div class="container  display-flex align-content-center">
        <h1 class="display-5">{{ $article->libelle }}</h1>
        <div class="container">
            <div class="row">
                <div class="col-lg col-md">
                    <h3 class="display-6">{{ 'Effectuer  un mouvementy' }}</h3>
                    <form method="POST" action="{{ route('article.transactions') }}">
                        @csrf
                        @error('error')
                            <div class="m-3 text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                        <div class="mb-3">
                            <label for="sense" class="form-label fw-bold">Sens</label>
                            <select required class="form-select form-select-md fw-normal"
                                aria-label="Sélectionner une Catégorie" name="sense">
                                @foreach ([['value' => 1, 'libelle' => 'Achat'], ['value' => 0, 'libelle' => 'Vente']] as $item)
                                    <option value="{{ $item['value'] }}">{{ $item['libelle'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" for="quantite_carton">Nombre de carton</label>
                            <input type="number" class="form-control" id="quantite_carton"
                                value="{{ old('quantite_carton') }}" name="quantite_carton" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" for="quantite_article">Nombre d'unité suplémentaire</label>
                            <input type="number" class="form-control" id="quantite_article" name="quantite_article"
                                value="{{ old('quantite_article') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" for="amount">Montant du mouvement</label>
                            <input type="number" class="form-control" id="amount" name="amount"
                                value="{{ old('amount') }}" required>
                        </div>

                        <button type="submit" class="btn btn-outline-primary px-5 ">Valider</button>
                    </form>
                </div>
                <div class="col-lg col-md">
                    <h3 class="display-6">{{ 'Historique des transactions' }}</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="display-7 fw-bold col-md-3">Date</th>
                                <th scope="col" class="display-7 fw-bold col-md-2">Type</th>
                                <th scope="col" class="display-7 fw-bold col-md-2">Nbre.Cartons</th>
                                <th scope="col" class="display-7 fw-bold col-md-2">Quantité.Sup</th>
                                <th scope="col" class="display-7 fw-bold col-md-2">Montant.FCFA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td class="col-md-6">
                                        {{ DateTime::createFromFormat('Y-m-d H:i:s', $transaction->created_at)->format('D d M Y H:m') }}
                                    </td>
                                    <td class="col-md-2">{{ $transaction->sense == 1 ? 'Achat' : 'Vente' }}</td>
                                    <td class="col-md-2">{{ $transaction->quantite_carton }}</td>
                                    <td class="col-md-2">{{ $transaction->quantite_article }}</td>
                                    <td class="col-md-2">{{ $transaction->amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                        {{ $transactions->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
