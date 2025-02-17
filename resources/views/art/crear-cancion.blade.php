@extends('layout')
@section('contenido')
    @if ($mensaje = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $mensaje }}</p>
        </div>
    @endif
    {!! Form::open(array('action' => array('DAO@crearCancion'), 'files' => true ))!!}
    {!! Form::hidden('id', $value=$id) !!}
    <label>Numero Cancion</label><br>
    {!! Form::text('numeroCancion') !!}<br>
    <label>Titulo Cancion</label><br>
    {!! Form::text('titulo') !!}<br>
    <label>Artista colaborador 1</label><br>
    {!! Form::text('artistaColaborador_id') !!}<br>
    <label>Artista colaborador 2</label><br>
    {!! Form::text('artistaColaborador2_id') !!}<br>
    <label>Url</label><br>
    {!! Form::file('url', ['accept'=>'.mp3']) !!}<br>
    {!! Form::submit('crear') !!}
    {!! Form::close()!!}
@endsection