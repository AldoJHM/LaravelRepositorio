@extends('master')

@section('titulo', 'Listado de Productos')
@section('contenido')
<div class="container text-center">
    <br>
    <h1>Listado de Productos</h1>
    <table class="table table-striped table-bordered table-hover">
        <br>
        <div class="container">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nombre</th>
                        <th scope="col" class="text-center">Precio</th>
                        <th scope="col" class="text-center">Cantidad</th>
                        <th scope="col" class="text-center">Agregar</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí deberías agregar tus filas de datos si tienes alguna -->
                    @foreach($productos as $producto)
                        <tr>
                            <td class="text-center">{{$producto->nombre}}</td>
                            <td class="text-center">{{$producto->precio}}</td>
                            <td class="text-center">{{$producto->cantidad}}</td>
                            <td class="text-center">
                                <a href="{{ route('carrito-agregar',$producto->id) }}">
                                    <i class="bi bi-cart-plus-fill"></i>           
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>
        @endsection
    </table>
</div>