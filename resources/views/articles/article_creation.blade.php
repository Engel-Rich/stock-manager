@extends('base')

@section('article_creation')
    
    <div class="container  display-flex align-content-center">
        <h1 class="display-5">{{ $article == null ? 'Ajouter un nouvel article' : 'Modifier l\'article ' . $article->libelle }}</h1>

    <div class="container py-5 px-5">
        <div class="row">
            <div class="col-lg col-md">
                <form method="POST"
                    action="{{ $article == null ? route('article.store') : route('article.update', $article->id) }}">

                    @csrf
                    @if ($article != null)
                        @method('PUT')
                    @endif
                    @error('error')
                        <div class="m-3 text-danger" >
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="mb-3">
                        <label for="libelle" class="form-label fw-bold">Nom de l'article</label>
                        <input type="text" class="form-control" id="libelle" aria-describedby="classe_name"
                            name="libelle" value="{{ old('libelle', $article?->libelle) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="classe_id" class="form-label fw-bold">Choisir la catégorie </label>
                        <select required class="form-select form-select-md fw-normal" aria-label="Sélectionner une Catégorie"
                            name="categorie_id">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="qantite_par_lot">Quantité par carton</label>
                        <input type="number" class="form-control" id="qantite_par_lot" name="qantite_par_lot"
                            value="{{ old('qantite_par_lot', $article?->qantite_par_lot) }}" required>                        
                    </div>
                   
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="prix_achat_unitaire">Prix d'achat unitaire de la'article</label>
                        <input type="number" class="form-control" id="prix_achat_unitaire" name="prix_achat_unitaire"
                            value="{{ old('prix_achat_unitaire', $article?->prix_achat_unitaire) }}" required>                        
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" for="prix_vente_unitaire">Prix de vente unitaire de la'article</label>
                        <input type="number" class="form-control" id="prix_vente_unitaire" name="prix_vente_unitaire"
                            value="{{ old('prix_vente_unitaire', $article?->prix_vente_unitaire) }}" required>                        
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="prix_achat_par_lot">Prix d'achat du carton</label>
                        <input type="number" class="form-control" id="prix_achat_par_lot" name="prix_achat_par_lot"
                            value="{{ old('prix_achat_par_lot', $article?->prix_achat_par_lot) }}" required>                        
                    </div>
                  
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="prix_vente_par_lot">Prix de vente du carton</label>
                        <input type="number" class="form-control" id="prix_vente_par_lot" name="prix_vente_par_lot"
                            value="{{ old('prix_vente_par_lot', $article?->prix_vente_par_lot) }}" required>                        
                    </div>                    
                    <button type="submit" class="btn btn-outline-primary px-5 ">Valider</button>
                </form>
            </div>
            <div class="col-lg col-md">
                <img src="{{ url('https://i0.wp.com/thierrycausera.fr/wp-content/uploads/2022/12/Logo-Quincaillerie-@4x.png?w=1726&ssl=1') }}" alt="Ajouter un article" class="img-fluid">                
            </div>
        </div>
    </div>
    </div>
@endsection