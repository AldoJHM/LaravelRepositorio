<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Perfil;

class PerfilesController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$perfiles = DB::table('perfiles')->get();
        $perfiles= Perfil::Buscador($request->nombre)->orderBy('id', 'asc')->simplepaginate(2);
        return view('Perfiles.index', ['perfiles' => $perfiles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('perfiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
            $this->validate($request,[
                'nombre'=>'required|unique:perfiles'
            ]);

            $perfil = Perfil::create([
                    'nombre'=>$request->get('nombre')
            ]);

            return redirect()->route('perfiles.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $perfil = Perfil::find($id);
        return view('perfiles.editar', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'nombre'=>'required|unique:perfiles'
        ]);

        $perfil = Perfil::find($id);
        $perfil->nombre = $request->get("nombre");
        $perfil->save();

        return redirect()->route('perfiles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perfil = Perfil::find($id);
        $perfil->delete();

        return redirect()->route('perfiles.index');
    }
}
