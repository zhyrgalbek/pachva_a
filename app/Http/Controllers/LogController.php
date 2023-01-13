<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Support\Facades\Session;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:log-list', ['only' => ['index']]);
    }
    public function index()
    {
        $data = LogActivity::orderBy('id','DESC')->paginate(10);

        Session::put('page', isset($_GET['page']) ? $_GET['page'] : 1);

        return view('logs.index', compact('data'));
    }

    public function show(LogActivity $log)
    {
        return view('logs.show', compact('log'));
    }
}
