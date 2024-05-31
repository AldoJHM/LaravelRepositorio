@extends('master')
@section('titulo','Editar un cliente')

@section('contenido')
    <div class="container text-center">
        <h1>Editar Cliente</h1>
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

        {!! Form::model($cliente, ['route' => ['clientes.update', $cliente->id], 'method' => 'PUT']) !!}
            <div class="form-group">
                {!! Form::label('nombre', 'Nombre del cliente') !!}
                {!! Form::text('nombre', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'Nombre del cliente...']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('rfc', 'RFC') !!}
                {!! Form::text('rfc', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'RFC del cliente...']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('direccion', 'Dirección') !!}
                {!! Form::text('direccion', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'Dirección del cliente...']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('telefono', 'Teléfono') !!}
                {!! Form::text('telefono', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'Teléfono del cliente...']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Correo Electrónico') !!}
                {!! Form::email('email', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'Correo Electrónico del cliente...']) !!}
            </div>
            <br>
            {!! Form::submit('Guardar Cliente', ['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}
        <hr>
    </div>
@endsection
