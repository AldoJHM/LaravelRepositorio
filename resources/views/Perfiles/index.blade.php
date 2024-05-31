@extends('master')

@section('titulo', 'Listado de Perfiles')

@section('contenido')
<div class="container text-center">
    <br>
    <h1>Listado de Perfiles</h1>
    <br>
    <hr>
    <br>
    {!! Form::open(['route'=>'perfiles.index','method'=>'GET','class'=>'navbar-form']) !!}
        <div class="form-group">
            {!! Form::text('nombre',null,['class'=>'form-control', 'id'=>'nombre','placeholder'=>'Buscar puesto']) !!}
            <br>
            {!! Form::submit('Buscar Perfil',array('class'=>'btn btn-primary')) !!}
        </div>
    {!! Form::close() !!}
    
    <br>
    <div class="container">
        <table class="table table-success table-striped">
            <!-- Encabezados de la tabla -->
            <thead>
                <tr>
                    <th scope="col">Actualizar</th>
                    <th scope="col">Eliminar</th>
                    <th scope="col">Número</th>
                    <th scope="col">Nombre</th>
                </tr>
            </thead>
            <tbody>
                <!-- Filas de la tabla -->
                @foreach($perfiles as $perfil)
                <tr>
                    <td>
                        <!-- Botón de editar -->
                        <a class="btn btn-warning" href="{{ route('perfiles.edit', $perfil->id) }}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                    <td>
                        <!-- Botón de eliminar -->
                        {!! Form::open(['route' => ['perfiles.destroy', $perfil->id], 'method' => 'DELETE']) !!}
                            <button type="submit" onClick="return confirm('Eliminar perfil?')" class="btn btn-danger">
                                <i class="bi bi-backspace-fill"></i>
                            </button>
                        {!! Form::close() !!}
                    </td>
                    <!-- Datos del perfil -->
                    <td>{{ $perfil->id }}</td>
                    <td>{{ $perfil->nombre }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearPerfilModal">Crear Nuevo Perfil</button>
    <br>
    <!-- Paginación -->
    <div class="text-center">
        {{ $perfiles->links() }}
    </div>
</div>
<br><br>

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
@endsection
