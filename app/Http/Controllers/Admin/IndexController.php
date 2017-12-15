<?php

namespace App\Http\Controllers\Admin;

use App\Tools\AreaCache;
use Illuminate\Http\Request;

use App\Http\Requests\IndexRequest;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.public.index');

    }
}
