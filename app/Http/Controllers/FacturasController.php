<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Factura;
use App\Models\Cliente;
use App\Models\FormaPago;
use App\Models\EstadoFactura;
use App\Mail\FacturaCreada;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class FacturasController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'admin']);
    }

     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $estadosfacturas = EstadoFactura::orderBy('nombre','asc') ->pluck('nombre','id');
    $clientes = Cliente::orderBy('nombre','asc') ->pluck('nombre','id');
    $formaspago = FormaPago::orderBy('nombre','asc') ->pluck('nombre','id');

    $facturas = Factura::Buscador($request->numero)->orderBy('numero', 'asc' )->simplepaginate(2);

    //$facturas = Factura::all();

    return view('facturas.index', compact('clientes', 'estadosfacturas','formaspago','facturas'));
    
    }
        /**
     * Show the form for creating a new resource.
     */
   public function create(Request $request)
   {
       $estados = EstadoFactura::orderBy('nombre','asc')->pluck('nombre','id');
       $clientes = Cliente::orderBy('nombre','asc')->pluck('nombre','id');
       $formaspago = FormaPago::orderBy('nombre','asc')->pluck('nombre','id');
       $estadosfacturas = EstadoFactura::orderBy('nombre','asc')->pluck('nombre','id'); // Añadir esta línea
   
       $facturas = Factura::Buscador($request->numero)->orderBy('numero', 'asc')->simplepaginate(2);
   
       return view('facturas.create', compact('clientes', 'estados', 'formaspago', 'facturas', 'estadosfacturas')); // Añadir 'estadosfacturas' aquí
   }
   

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $this->validate($request, [
        'numero' => 'required',
        'detalles' => 'required',
        'valor' => 'required',
        'archivo' => 'required',
        'idcliente' => 'required',
        'idforma' => 'required',
        'idestado' => 'required' 
    ]);

     //Cambia el nombre y guarda el archivo
     $now = new \DateTime();
     $fecha = $now->format('Ymd-His');
     $numero = $request->get('numero');
     $archivo = $request->file('archivo');
     $nombre = " ";


     if($archivo){
         $extension = $archivo->getClientOriginalExtension();
         $nombre = "factura-".$numero."-".$fecha.".".$extension;
         \Storage::disk('local')->put($nombre, \File::get($archivo));
     }

    $factura = Factura::create([
        'numero' => $request->get('numero'),
        'detalles' => $request->get('detalles'),
        'valor' => $request->get('valor'),
        'archivo' => $nombre,
        'idcliente' => $request->get('idcliente'),
        'idforma' => $request->get('idforma'),
        'idestado' => $request->get('idestado'),
    ]);

    //Generar Mail de notificación
    $numerofactura = $request->get('numero');
    $valorfactura = $request->get('valor');

    //Obtener el email del usuario que se encuentra logueado
    $emailto = Auth::user()->email;
    Mail::to($emailto)->send(new FacturaCreada($numerofactura, $valorfactura));

    $mensaje = $factura?'Factura creada con exito':'La factura no pudo crearse';
    return redirect()->route('facturas.index')->with('mensaje', $mensaje);
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
    
 public function edit($id)
 {
     $factura = Factura::findOrFail($id);
     $clientes = Cliente::orderBy('nombre','asc')->pluck('nombre','id');
     $estados = EstadoFactura::orderBy('nombre','asc')->pluck('nombre','id');
     $formas = FormaPago::orderBy('nombre','asc')->pluck('nombre','id');
     return view('facturas.editar', compact('factura', 'clientes', 'estados', 'formas'));
 }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $factura = Factura::findOrFail($id);

    // Validación
    $request->validate([
        'numero' => 'required',
        'valor' => 'required',
        'detalles' => 'required',
        'idcliente' => 'required',
        'idforma' => 'required',
        'idestado' => 'required',
        'archivo' => 'nullable|file|mimes:jpeg,png,pdf',
    ]);

    // Actualización de los datos de la factura
    $factura->numero = $request->input('numero');
    $factura->valor = $request->input('valor');
    $factura->detalles = $request->input('detalles');
    $factura->idcliente = $request->input('idcliente');
    $factura->idforma = $request->input('idforma');
    $factura->idestado = $request->input('idestado');

    if ($request->hasFile('archivo')) {
        // Elimina el archivo anterior si existe
        if ($factura->archivo) {
            Storage::delete('archivos/' . $factura->archivo);
        }

        // Guarda el nuevo archivo en 'archivos'
        $fileName = 'factura-' . $factura->id . '-' . now()->format('Ymd-His') . '.' . $request->file('archivo')->getClientOriginalExtension();
        $request->file('archivo')->move(public_path('archivos'), $fileName);
        $factura->archivo = $fileName;
    } else {
        // Mantén el archivo actual si no se sube uno nuevo
        $factura->archivo = $request->input('archivo_actual');
    }

    $factura->save();

    return redirect()->route('facturas.index')->with('success', 'Factura actualizada correctamente');
}

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $factura = factura::find($id);
        $factura->delete();

        return redirect()->route('facturas.index');
    }

}