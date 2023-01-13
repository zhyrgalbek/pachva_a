<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use JoeDixon\Translation\Drivers\Translation;

class NewsController extends Controller
{
    protected $translation;

    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
        $this->middleware('permission:news-list|news-create|news-edit|news-delete', ['only' => ['index','show']]);
        $this->middleware('permission:news-create', ['only' => ['create','store']]);
        $this->middleware('permission:news-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:news-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = 1;
        $type = $request->input('type') ?: $type;
        $articles = Article::where(['type'=>$type])->orderBy('id','DESC')->paginate(8);

        Session::put('type', $type);
        Session::put('page', isset($_GET['page']) ? $_GET['page'] : 1);

        return view('news.index', compact('articles', 'type'));
    }

    public function list(Request $request)
    {
        $type = 1;
        $type = $request->input('type') ?: $type;
        $articles = Article::where(['type'=>$type, 'published' => 1])->orderBy('id','DESC')->paginate(8);
        return view('news.index', compact('articles', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'photo' => 'required',
            'title' => 'required',
            'summary' => 'required',
            'body' => 'required'
        ]);

        $article = Article::create($request->all());

        if ($article->published) {
            $article->published_at = Carbon::now();
            $article->save();
        }

        $locale = App::currentLocale();

        $this->translation->addGroupTranslation($locale, 'news', 'title-'.$article->id, $request->input('title'));
        $this->translation->addGroupTranslation($locale, 'news', 'summary-'.$article->id, $request->input('summary'));
        $this->translation->addGroupTranslation($locale, 'news', 'body-'.$article->id, $request->input('body'));

        return redirect()->route('news.index', ['type'=>Session::get('type', 1)])
            ->with('success', 'News created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        $article->title = Lang::has('news.title-'.$article->id) ? trans('news.title-'.$article->id) : $article->title;
        $article->summary = Lang::has('news.summary-'.$article->id) ? trans('news.summary-'.$article->id) : $article->summary;
        $article->body = Lang::has('news.body-'.$article->id) ? trans('news.body-'.$article->id) : $article->body;

        return view('news.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        $article->title = Lang::has('news.title-'.$article->id) ? trans('news.title-'.$article->id) : $article->title;
        $article->summary = Lang::has('news.summary-'.$article->id) ? trans('news.summary-'.$article->id) : $article->summary;
        $article->body = Lang::has('news.body-'.$article->id) ? trans('news.body-'.$article->id) : $article->body;

        return view('news.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type' => 'required',
            'photo' => 'required',
            'title' => 'required',
            'summary' => 'required',
            'body' => 'required'
        ]);

        $locale = App::currentLocale();

        $article = Article::find($id);
        if ($locale == 'ru') {
            $article->title = $request->input('title');
            $article->summary = $request->input('summary');
            $article->body = $request->input('body');
        }
        $article->type = $request->input('type');
        $article->photo = $request->input('photo');
        if (!$article->published && $request->input('published')) {
            $article->published_at = Carbon::now();
        }
        $article->published = $request->input('published') ? 1 : 0;

        $this->translation->addGroupTranslation($locale, 'news', 'title-'.$article->id, $request->input('title'));
        $this->translation->addGroupTranslation($locale, 'news', 'summary-'.$article->id, $request->input('summary'));
        $this->translation->addGroupTranslation($locale, 'news', 'body-'.$article->id, $request->input('body'));

        $article->save();

        return redirect()->route('news.index', ['type'=>Session::get('type', 1), 'page'=>Session::get('page', 1)])
            ->with('success', 'News updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();

        return redirect()->route('news.index', ['type'=>Session::get('type', 1), 'page'=>Session::get('page', 1)])
            ->with('success', 'News deleted successfully');
    }

    public function detail($id)
    {
        $article = Article::find($id);

        if (!$article->published) {
            abort(404);
        }

        $article->title = Lang::has('news.title-'.$article->id) ? trans('news.title-'.$article->id) : $article->title;
        $article->summary = Lang::has('news.summary-'.$article->id) ? trans('news.summary-'.$article->id) : $article->summary;
        $article->body = Lang::has('news.body-'.$article->id) ? trans('news.body-'.$article->id) : $article->body;

        return view('news.show', compact('article'));
    }
}
