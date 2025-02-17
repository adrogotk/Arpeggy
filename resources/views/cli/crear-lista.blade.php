@extends('layout')
@section('contenido')
    @if ($mensaje = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $mensaje }}</p>
        </div>
    @endif
    {!! Form::open(array('action' => array('DAO@crearLista') ))!!}
    <label>Nombre Lista</label><br>
    {!! Form::text('nombre') !!}
    {!! Form::submit('crear') !!}
    {!! Form::close()!!}
@endsection
