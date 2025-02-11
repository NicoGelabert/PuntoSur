<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $query = Article::query();

        return $this->renderArticle($query);
    }

    public function view(Article $article)
    {
        $article->load(['authors']);
        // $articles = article::all();
        return view('news.view', [
            'article' => $article,
        ]);
    }

    private function renderArticle(Builder $query)
    {
        $search = \request()->get('search');
        $sort = \request()->get('sort', '-updated_at');

        if ($sort) {
            $sortDirection = 'asc';
            if ($sort[0] === '-') {
                $sortDirection = 'desc';
            }
            $sortField = preg_replace('/^-?/', '', $sort);

            $query->orderBy($sortField, $sortDirection);
        }
        $articles = $query
            ->where('published', '=', 1)
            ->where(function ($query) use ($search) {
                /** @var $query \Illuminate\Database\Eloquent\Builder */
                $query->where('articles.title', 'like', "%$search%")
                    ->orWhere('articles.description', 'like', "%$search%");
            })

            ->paginate(5);

        return view('news.index', [
            'articles' => $articles
        ]);

    }
}
