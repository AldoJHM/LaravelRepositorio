@extends('master')

@section('titulo', 'Listado de Facturas')

@section('contenido')
<div class="container text-center">
    <br>
    <h1>Listado de Facturas</h1>
    <br>
    <div class="container">
        <!-- Formulario de búsqueda -->
        {!! Form::open(['route'=>'facturas.index','method'=>'GET','class'=>'navbar-form']) !!}
        <div class="form-group">
            {!! Form::text('numero',null,['class'=>'form-control', 'placeholder'=>'Buscar número de factura']) !!}
            <br>
            {!! Form::submit('Buscar Factura',array('class'=>'btn btn-primary')) !!}
        </div>
        {!! Form::close() !!}
        <br>
        <table class="table table-dark table-borderless">
            <thead>
                <tr>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                    <th>Número</th>
                    <th>Cliente</th>
                    <th>RFC</th>
                    <th>Valor</th>
                    <th>Archivo</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facturas as $factura)
                <tr>
                    <td>
                        <a class="btn btn-warning" href="{{ route('facturas.edit', $factura->id) }}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                    <td>
                        {!! Form::open(['route' => ['facturas.destroy', $factura->id], 'method' => 'DELETE']) !!}
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar factura?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        {!! Form::close() !!}
                    </td>
                    <td>{{ $factura->numero }}</td>
                    <td>{{ $factura->cliente->nombre}}</td>
                    <td>{{ $factura->cliente->rfc}}</td>
                    <td>${{number_format($factura->valor)}}</td>
                    <td><img src="{{asset('archivos/'.$factura->archivo.'')}}" width="150"></td>
                    <td>{!! $factura->detalles !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <a class="btn btn-success" href="#" style="max-width: 100px; max-height: 100px;" data-bs-toggle="modal" data-bs-target="#crearFacturaModal">Crear Nueva factura</a>
    <br>
    <!-- Paginación -->
    <div class="text-center">
        {{ $facturas->links() }}
    </div>
    
</div>

<!-- Modal para la creación de factura -->
<div class="modal fade" id="crearFacturaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Factura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para crear una factura -->
                {!! Form::open(['route' => 'facturas.store', 'files' => true]) !!}
                    <div class="form-group">
                        {!! Form::text('numero', null, array(
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => 'Número de Factura'
                        )) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::textarea('detalles', null, array(
                            'id' => 'editor',
                            'class' => 'form-control ckeditor',
                            'required' => 'required',
                            'placeholder' => 'Detalles'
                        )) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::text('valor', null, array(
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => 'Valor'
                        )) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::file('archivo', array(
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => 'Archivo'
                        )) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('idcliente', 'Cliente:') !!}
                        {!! Form::select('idcliente', $clientes, null, ['class'=> 'form-control']) !!}
                    </div>

                    <div class="form-group">    
                        {!! Form::label('idforma', 'Forma de Pago:') !!}
                        {!! Form::select('idforma', $formaspago, null, ['class'=> 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('idestado', 'Estado Factura:') !!}
                        {!! Form::select('idestado', $estadosfacturas, null, ['class' => 'form-control']) !!}
                    </div>

            </div>
            <div class="modal-footer">
                <!-- Botón para cerrar el modal -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <!-- Botón para enviar el formulario -->
                {!! Form::submit('Guardar Factura', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
