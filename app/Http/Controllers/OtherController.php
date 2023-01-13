<?php

namespace App\Http\Controllers;

use App\Models\Other;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use JoeDixon\Translation\Drivers\Translation;

class OtherController extends Controller
{
    protected $translation;

    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
        $this->middleware('permission:other-list|other-create|other-edit|other-delete', ['only' => ['index','show']]);
        $this->middleware('permission:other-create', ['only' => ['create','store']]);
        $this->middleware('permission:other-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:other-delete', ['only' => ['destroy']]);
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
        $others = Other::where(['type'=>$type])->orderBy('id','DESC')->paginate(8);

        Session::put('type', $type);
        Session::put('page', isset($_GET['page']) ? $_GET['page'] : 1);

        return view('others.index', compact('others', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('others.create');
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
            'title' => 'required',
            'image' => 'required'
        ]);

        $other = Other::create($request->all());

        if ($other->published) {
            $other->published_at = Carbon::now();
            $other->save();
        }

        $locale = App::currentLocale();

        $this->translation->addGroupTranslation($locale, 'other', 'title-'.$other->id, $request->input('title'));
        $this->translation->addGroupTranslation($locale, 'other', 'description-'.$other->id, $request->input('description'));

        return redirect()->route('others.index', ['type'=>Session::get('type', 1)])
            ->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $other = Other::find($id);

        $other->title = Lang::has('other.title-'.$other->id) ? trans('other.title-'.$other->id) : $other->title;
        $other->description = Lang::has('other.description-'.$other->id) ? trans('other.description-'.$other->id) : $other->description;

        return view('others.show', compact('other'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $other = Other::find($id);

        $other->title = Lang::has('other.title-'.$other->id) ? trans('other.title-'.$other->id) : $other->title;
        $other->description = Lang::has('other.description-'.$other->id) ? trans('other.description-'.$other->id) : $other->description;

        return view('others.edit', compact('other'));
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
            'title' => 'required',
            'image' => 'required'
        ]);

        $locale = App::currentLocale();

        $other = Other::find($id);
        if ($locale == 'ru') {
            $other->title = $request->input('title');
            $other->description = $request->input('description');
        }
        $other->type = $request->input('type');
        $other->image = $request->input('image');
        $other->link = $request->input('link');
        if (!$other->published && $request->input('published')) {
            $other->published_at = Carbon::now();
        }
        $other->published = $request->input('published') ? 1 : 0;

        $this->translation->addGroupTranslation($locale, 'other', 'title-'.$other->id, $request->input('title'));
        $this->translation->addGroupTranslation($locale, 'other', 'description-'.$other->id, $request->input('description'));

        $other->save();

        return redirect()->route('others.index', ['type'=>Session::get('type', 1), 'page'=>Session::get('page', 1)])
            ->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Other::find($id)->delete();

        return redirect()->route('others.index', ['type'=>Session::get('type', 1), 'page'=>Session::get('page', 1)])
            ->with('success', 'Item deleted successfully');
    }
}
