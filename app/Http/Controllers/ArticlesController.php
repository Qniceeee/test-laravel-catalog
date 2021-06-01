<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class ArticlesController
 * @package App\Http\Controllers
 */
class ArticlesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(5);

        return view('articles.index', compact('articles'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $article = Article::find($id);

        return view('articles.edit', compact('article'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'article_name' => 'required|',
            'article_text' => 'required|'
        ]);

        try {
            $article = Article::find($id);

            $article->update($request->all());
            return redirect()->route('articles.index')->with('info', "Article № {$id} update successfully.");

        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('articles.index')->with('error', 'An error occured while update the article. Error code{$e->getCode()}');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'article_name' => 'required|',
            'article_text' => 'required|'
        ]);

        try {
            $article_name = $request->input('article_name');
            $article_text = $request->input('article_text');
            $filteredArticleName = filter_var($article_name, FILTER_SANITIZE_STRIPPED);
            $filteredArticleText = filter_var($article_text, FILTER_SANITIZE_STRIPPED);

            $article = new Article([
                'article_name' => $filteredArticleName,
                'article_text' => $filteredArticleText
            ]);
            $article->save();

            return redirect()->route('articles.index')->with('info', 'Article created successfully.');

        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('articles.index')->with('error', 'An error occured while creating the article. Error code {$e->getCode()}');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $article = Article::find($id);

        return view('articles.show', compact('article'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        $article->delete();

        return redirect()->route('articles.index')->with('info', "Article №{$id} delete successfully");
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(3);

        return view('home', compact('articles'));
    }
}
