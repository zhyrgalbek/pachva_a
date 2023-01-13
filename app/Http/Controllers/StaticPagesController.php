<?php

namespace App\Http\Controllers;

class StaticPagesController extends Controller
{
    public function request()
    {
        return view('staticPages.request');
    }

    public function servicesPage()
    {
        return view('staticPages.services');
    }

    public function sampleReceivePage()
    {
        return view('staticPages.sampleReceive');
    }

    public function rpas()
    {
        return view('staticPages.rpas');
    }
}
