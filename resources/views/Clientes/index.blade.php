@extends('master')
@section('titulo', "Clientes")
@section('contenido')

<br>
@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
    @endif
<div class="container text-center">
    <br>
    <h1>Lista de Clientes</h1>
    <br>
    {!! Form::open(['route'=>'clientes.index','method'=>'GET','class'=>'navbar-form']) !!}
        <div class="form-group">
            {!! Form::text('nombre',null,['class'=>'form-control', 'id'=>'nombre','placeholder'=>'Buscar Nombre']) !!}
            <br>
            {!! Form::submit('Buscar clientes',array('class'=>'btn btn-primary')) !!}
        </div>
    {!! Form::close() !!}
    <div class="container">

        <table class="table table-dark table-borderless">
            <thead>
                <tr>
                    <th scope="col">Actualizar</th>
                    <th scope="col">Eliminar</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">RFC</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>

            <tbody>
                @foreach($clientes as $cliente)
                <tr>
                    <td>
                        <a class="btn btn-warning" href="{{ route('clientes.edit', $cliente->id) }}">
                            <i class="bi bi-pencil-square edit-btn"></i>
                        </a>
                    </td>
                    <td>
                        {!! Form::open(['route' => ['clientes.destroy', $cliente->id], 'method' => 'DELETE']) !!}
                        <button onclick="return confirm('¿Eliminar cliente?')" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->rfc }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->email }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
        <!-- <a class="btn btn-primary" href="{{route('clientes.create')}}">Crear cliente</a> -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearClienteModal">
        Crear Nuevo Cliente
        </button>
        <br><br><br><br>
        {{ $clientes->links() }}
        

    </div>

    <br>
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
