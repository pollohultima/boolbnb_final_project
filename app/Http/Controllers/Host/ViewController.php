<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $views = View::all();
        return view('host.views.index', compact('views'));
    }
}