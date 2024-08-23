<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use DB;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Categorie;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = $request->input('search');
        $articleList = Article::where('libelle', 'like', "%$query%")->paginate();

        $articleList->getCollection()->transform(function ($value) {
            $value->quantite_carton = Transaction::where('article_id', $value->id)->where('sense', 1)->sum('quantite_carton') - Transaction::where('article_id', $value->id)->where('sense', 0)->sum('quantite_carton');
            $value->quantite = Transaction::where('article_id', $value->id)->where('sense', 1)->sum('quantite_article') - Transaction::where('article_id', $value->id)->where('sense', 0)->sum('quantite_article');
            return $value;
        });
        return view('articles.index', ['articles' => $articleList]);        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('articles.article_creation', ['article' => null, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $datavalidated = $request->validate([
                "libelle" => "string|required|unique:articles,libelle",
                "categorie_id" => "required|exists:categorie,id",
                "qantite_par_lot" => "required|numeric",
                "prix_achat_unitaire" => "required|numeric",
                "prix_vente_unitaire" => "required|numeric",
                "prix_achat_par_lot" => "required|numeric",
                "prix_vente_par_lot" => "required|numeric",

            ]);
            $datavalidated['description'] = $request->libelle;
            DB::table('articles')->insert($datavalidated);
            return redirect()->route('article.index');
        } catch (\Throwable $th) {
            return back()->withErrors([
                'error' => $th->getMessage(),
            ])->withInput();
        }
        // dd(request()->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {

        $categories = Categorie::all();
        return view('articles.article_creation', ['article' => $article, 'categories' => $categories]);
    }
    public function mouvements(Article $article)
    {
        $transactions = Transaction::where('article_id', $article->id)->paginate(perPage: 10);
        // dd($transactions);
        return view('articles.mouvements', ['article' => $article, 'transactions' => $transactions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $article)
    {
        // dd($article);

        try {
            $datavalidated = $request->validate([
                "libelle" => "string",
                "categorie_id" => "exists:categorie,id",
                "qantite_par_lot" => "numeric",
                "prix_achat_unitaire" => "numeric",
                "prix_vente_unitaire" => "numeric",
                "prix_achat_par_lot" => "numeric",
                "prix_vente_par_lot" => "numeric",
            ]);
            $datavalidated['description'] = $request->libelle;
            DB::table('articles')->where('id', $article)->update($datavalidated);
            return redirect()->route('article.index');
        } catch (\Throwable $th) {
            return back()->withErrors([
                'error' => $th->getMessage(),
            ])->withInput();
        }
    }
    public function transactions(Request $request)
    {

        // dd($request->all());
        try {
            $requestValidator = [
                "article_id" => "required|exists:articles,id",
                "quantite_carton" => "required|numeric",
                "sense" => "required|in:0,1",
                "quantite_article" => "required|numeric",
                "amount" => "required|numeric",
            ];
            $article = Article::find($request->article_id);
            if ($article->qantite_par_lot <= $request->quantite_article) {
                return back()->withErrors([
                    'error' => "La quantité d'article doit être inférieure à la quantité par lot qui est de " . $article->qantite_par_lot,
                ])->withInput();
            }
            $datavalidated = $request->validate($requestValidator);
            Transaction::create($datavalidated);
            return redirect()->route('article.index');
        } catch (\Throwable $th) {
            return back()->withErrors([
                'error' => $th->getMessage(),
            ])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
