<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use JoeDixon\Translation\Drivers\Translation;

class PostController extends Controller
{
    protected $translation;

    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
        $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index','store']]);
        $this->middleware('permission:post-create', ['only' => ['create','store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::orderBy('id','DESC')->paginate(10);

        Session::put('page', isset($_GET['page']) ? $_GET['page'] : 1);

        return view('posts.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'title' => 'required|unique:posts,title',
            'description' => 'required'
        ]);

        Post::create(['title' => $request->input('title'), 'description' => $request->input('description')]);

        $locale = App::currentLocale();

        $this->translation->addGroupTranslation($locale, 'post', $request->input('title'), $request->input('description'));

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        $post->description = Lang::has('post.'.$post->title) ? trans('post.'.$post->title) : $post->description;

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        $post->description = Lang::has('post.'.$post->title) ? trans('post.'.$post->title) : $post->description;

        return view('posts.edit', compact('post'));
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
            'title' => 'required',
            'description' => 'required'
        ]);

        $locale = App::currentLocale();

        $post = Post::find($id);
        $post->title = $request->input('title');
        if ($locale == 'ru')
            $post->description = $request->input('description');

        $this->translation->addGroupTranslation($locale, 'post', $post->title, $request->input('description'));

        $post->save();

        return redirect()->route('posts.index', ['page'=>Session::get('page', 1)])
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();

        return redirect()->route('posts.index', ['page'=>Session::get('page', 1)])
            ->with('success', 'Post deleted successfully');
    }

    public function page($page)
    {
        $post = Post::where('title', $page)->firstOrFail();

        $post->description = Lang::has('post.'.$post->title) ? trans('post.'.$post->title) : $post->description;

        return view('posts.page', compact('post'));
    }
}
