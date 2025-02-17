@extends('layout')
@section('contenido')
    @if ($mensaje = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $mensaje }}</p>
        </div>
    @endif
    {!! Form::open(array('action' => array('DAO@actualizarCancion'), 'files' => true ))!!}
    {!! Form::hidden('cancionId', $value=$cancion->id) !!}
    {!! Form::hidden('id', $value=$cancion->disco_id) !!}
    <label>Numero Cancion</label><br>
    {!! Form::number('numeroCancion', $value=$cancion->numeroCancion) !!}<br>
    <label>Titulo Cancion</label><br>
    {!! Form::text('titulo', $value=$cancion->titulo) !!}<br>
    <label>Artista colaborador 1</label><br>
    {!! Form::text('artistaColaborador_id', $value=$artistaColaborador1Nombre) !!}<br>
    <label>Artista colaborador 2</label><br>
    {!! Form::text('artistaColaborador2_id', $value=$artistaColaborador2Nombre) !!}<br>
    <label>Cambiar URL</label><br>
    {!! Form::file('url', ['accept'=>'.mp3']) !!}<br>
    {!! Form::submit('Editar cancion') !!}
    {!! Form::close()!!}
@endsection
