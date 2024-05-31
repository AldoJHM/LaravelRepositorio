<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('auth', ['except'=>'index']);
    }

    public function index(Request $request)
    {
        $productos = Productos::all();
        return view('productos.index', compact('productos'));
    }
}
