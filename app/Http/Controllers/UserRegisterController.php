<?php

namespace App\Http\Controllers;

use App\Models\TemporaryUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserRegisterController extends Controller
{
    protected function index(){
        return view('vendor.UserRegister');
    }
}
