<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        if (!Session::has('carrito'))
            Session::put('carrito', array());
    }

    public function show()
    {
        $carrito = Session::get('carrito');
        //return $carrito;
        $total = $this->total();

        return view('carrito', compact('carrito', 'total'));
    }

    public function add($id)
    {
        $carrito = Session::get('carrito', []);
        $productos = Productos::find($id);

        $productos->cantidad = 1;

        if ($productos) {
            $carrito[$productos->id] = $productos;
            Session::put('carrito', $carrito);
        } else {
            return redirect()->route('carrito.index')->with('error', 'Producto no encontrado');
        }

        return redirect()->route('carrito.index');
    }

    public function delete($id){
        $carrito = Session::get('carrito', []);
        unset($carrito[$id]);
        Session::put('carrito', $carrito);

        return redirect()->route('carrito.index');
    }

    public function trash(){
        Session::forget('carrito');
        return redirect()->route('carrito.index');
    }

    public function update($id, $cantidad){
        $carrito = Session::get('carrito');
        $productos = Productos::find($id);
        $carrito[$productos->id]->cantidad = $cantidad;

        Session::put('carrito', $carrito);
        return redirect()->route('carrito.index');
    }

    public function total(){
        $carrito = Session::get('carrito');

        $total = 0;

        foreach($carrito as $item){
            $total += $item->precio*$item->cantidad;
        }

        return $total;
    }

    public function guardarPedido()
    {
        $carrito = Session::get('carrito');
        if (count($carrito)) {
            $now = new \DateTime();
            $numero = $now->format('Ymd-His');
            foreach ($carrito as $producto) {
                $this->guardarItem($producto, $numero);
            }
            // Vaciar el carrito después de guardar el pedido
            Session::forget('carrito');
            $mensaje = 'Pedido realizado con éxito';
        }

        return redirect()->route('carrito.index')->with('mensaje', $mensaje);
    }

    protected function guardarItem($producto, $numero){
        $productoguardado = Pedido::create([
            'numero' => $numero,
            'idproducto' => $producto->id,
            'cantidad' => $producto->cantidad,
            'precio' => $producto->precio
        ]);
    }
}
