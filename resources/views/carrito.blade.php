@extends('master')

@section('titulo', 'Carrito')
@section('contenido')
<div class="container text-center">
    <br>
    <h1>Carrito de Articulos</h1>
    <p>
        <a href="{{ route('carrito-vaciar') }}" class="btn btn-danger">Vaciar Carrito<i class="bi bi-trash"></i></a>
    </p>
    <table class="table table-striped table-bordered table-hover">
        <br>
        <div class="container">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nombre</th>
                        <th scope="col" class="text-center">Precio</th>
                        <th scope="col" class="text-center">Cantidad</th>
                        <th scope="col" class="text-center">Total</th>
                        <th scope="col" class="text-center">Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí deberías agregar tus filas de datos si tienes alguna -->
                    @foreach($carrito as $item)
                        <tr>
                            <td class="text-center">{{$item->nombre}}</td>
                            <td class="text-center">{{number_format($item->precio, 0)}}</td>
                            <td class="text-center">
                                <input type="number" min="1" max="50" value="{{$item->cantidad}}"
                                    id="producto_{{ $item->id }}">
                                <a href="#" class="btn btn-warning btn-update-item"
                                    data-href="{{ route('carrito-actualizar', $item->id) }}" data-id="{{ $item->id }}">
                                    <i class="bi bi-arrow-repeat"></i>
                                </a>
                            </td>
                            <td class="text-center">{{ $item->precio * $item->cantidad }}</td>
                            <td class="text-center">
                                <a href="{{ route('carrito-borrar', $item->id) }}">
                                    <i class="bi bi-x-square-fill"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if(count($carrito) > 0)
                <h5><span class="alert alert-success d-inline-block">Total: ${{ number_format($total, 0) }}</span></h5>
            @else
                <h5><span class="alert alert-warning d-inline-block">No hay productos en el carrito</span></h5>
            @endif
            <hr>

            <p><a class="btn btn-info" href="{{ route('productos.index') }}">
                    <i class="fa fa-chevron-circle-left"></i> Seguir Agregando</a>
                @if(count($carrito))
                    <a class="btn btn-success" href="{{ route('ordenar') }}"> Ordenar <i class="fa fa-chevron-circle-right"></i></a>
                @endif
            </p>
        </div>
        <br>
        @endsection
    </table>
</div>