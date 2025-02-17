@extends('layout')
@section('contenido')
    @if ($mensaje = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $mensaje }}</p>
        </div>
    @endif
    {!! Form::open(array('action' => array('DAO@crearDisco'), 'files' => true ))!!}
    {!! Form::hidden('artista_id', $value=$id) !!}
    <label>Titulo Disco</label><br>
    {!! Form::text('titulo') !!}<br>
    <label>Portada disco</label><br>
    {!! Form::file('url') !!}<br>
    {!! Form::submit('crear') !!}
    {!! Form::close()!!}
    @endsection