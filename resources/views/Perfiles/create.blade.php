@extends('master')
@section('titulo','Crear un perfil')

@section('contenido')
<div class="container text-center">
    <h1>Crear Perfil</h1>
    <br>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Modal para la creación de perfil -->
    <div class="modal fade" id="crearPerfilModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para crear un perfil -->
                    {!! Form::open(['route' => 'perfiles.store']) !!}
                        <div class="form-group">
                            {!! Form::text('nombre', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'Nombre del perfil...']) !!}
                        </div>
                </div>
                <div class="modal-footer">
                    <!-- Botón para cerrar el modal -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <!-- Botón para enviar el formulario -->
                    {!! Form::submit('Guardar Perfil', ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Botón para abrir el modal de creación de perfil -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearPerfilModal">Crear Nuevo Perfil</button>
    <hr>
</div>
@endsection
