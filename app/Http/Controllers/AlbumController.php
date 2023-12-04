<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AlbumController extends Controller
{
    public function index(): View
    {
        return view('album.index');
    }

    public function edit(): View
    {
        return view('album.edit');
    }

    public function create(): View
    {
        return view('album.create');
    }
}
