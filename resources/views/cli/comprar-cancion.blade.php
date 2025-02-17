@extends('layout')
@section('contenido')
    @if ($mensaje = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $mensaje }}</p>
        </div>
    @endif
    {!! Form::open(array('action' => array('DAO@insertarCompra') ))!!}
    {!! Form::hidden('id', $value=$cancion_id) !!}
    <label>Numero Cuenta</label><br>
    {!! Form::text('numeroCuenta', $value=$numeroCuenta) !!}<br>
    {!! Form::submit('comprar') !!}
    {!! Form::close()!!}
    @endsection
