@extends('master')

@section('Titulo', 'Crear una factura')

@section('contenido')

<div class="container text-center">
    <h1>Crear Factura</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
    @endif

    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearFacturaModal">Crear Nueva factura</button>

    <!-- Modal para crear factura -->
    <div class="modal fade" id="crearFacturaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
                        {!! Form::select('idestado', $estados, null, ['class' => 'form-control']) !!}
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
