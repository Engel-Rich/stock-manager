@extends('base')

@section('home')
<div class="row">
    <div class="col-md-6">
        <h1 class="display-5"> Liste des articles disponibles </h1>
    </div>
    <div class="col">
        <a href="{{ route('article.create') }}">
            <button class="btn btn-outline-primary "> Ajouter un article</button>
        </a>
    </div>
    <div class="col pe-5">
        <input type="text" id="name" class="form-control" placeholder="Rechercher">
    </div>
</div>

<div id="article-list">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col" class="display-7 fw-bold col-md-3">Désignation</th> <!-- Plus large -->
                <th scope="col" class="display-7 fw-bold col-md-2">Qte en stock</th>
                <th scope="col" class="display-7 fw-bold col-md-2">Qte par packet</th>
                <th scope="col" class="display-7 fw-bold col-md-2">Nbr.packet</th>
                <th scope="col" class="display-7 fw-bold col-md-2">P.achat.U</th>
                <th scope="col" class="display-7 fw-bold col-md-2">P.achat.Packet</th>
                <th scope="col" class="display-7 fw-bold col-md-2">P.vente.U</th>
                <th scope="col" class="display-7 fw-bold col-md-2">P.vente.Packet</th>
                <th scope="col" class="display-7 fw-bold col-md-2">Action</th>
                <th scope="col" class="display-7 fw-bold col-md-2">Mouvements</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
            <tr>
                <td class="col-md-6">{{$article->libelle }}</td>            
                <td class="col-md-2">{{ $article->quantite?:'0' }}</td>
                <td class="col-md-2">{{ $article->qantite_par_lot }}</td>
                <td class="col-md-2">{{ $article->quantite_carton?:'0' }}</td>
                <td class="col-md-2">{{ $article->prix_achat_unitaire }}</td>
                <td class="col-md-2">{{ $article->prix_vente_unitaire }}</td>            
                <td class="col-md-2">{{ $article->prix_achat_par_lot }}</td>
                <td class="col-md-2">{{ $article->prix_vente_par_lot }}</td>
                <td class="col-md-2"><a href="{{route('article.edit', $article)}}">Editer</a></td>
                <td class="col-md-2"><a href="{{route('article.mouvements', $article)}}">Voir</a></td>
            </tr>
            @endforeach                            
        </tbody>
    </table>
</div>

{{ $articles->links() }}
@endsection

@section('style_table')
<style>
    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6; /* Couleur de la bordure */
    }
</style>
@endsection

@section('recherche_script')
<script>
     $(document).ready(function() {
        $('#name').on('input', function() {
            var searchQuery = $(this).val();                        
            $.ajax({
                url: '{{ route('article.index') }}',
                type: 'GET',
                data: { search: searchQuery },
                success: function(data) {
                    $('#article-list').html($(data).find('#article-list').html());
                },
                error: function(xhr) {
                    console.error("An error occurred: " + xhr.status + " " + xhr.statusText);
                }
            });
        });
    });
</script>
@endsection