@extends('master')
@section('Titulo','Crear un cliente')

@section('contenido')


<div class="container text-center">
    <h1>Crear Cliente</h1>

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
    <!--<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearClienteModal">
        Crear Nuevo Cliente
    </button>-->

    <!-- Modal -->
    <div class="modal fade" id="crearClienteModal" tabindex="-1" aria-labelledby="crearClienteModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearClienteModalLabel">Crear Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'clientes.store']) !!}
                    <div class="form-group">
                        {!! Form::text('nombre', null, array(
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => 'Nombre del Cliente'
                        )) 
                        !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('rfc', null, array(
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => 'RFC'
                        )) 
                        !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('direccion', null, array(
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => 'Dirección'
                        )) 
                        !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('telefono', null, array(
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => 'Teléfono'
                        )) 
                        !!}
                    </div>
                    <div class="form-group">
                        {!! Form::email('email', null, array(
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => 'Correo Electrónico'
                        )) 
                        !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    {!! Form::submit('Guardar Cliente', array('class' => 'btn btn-primary')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

