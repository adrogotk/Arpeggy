@extends('layout')
@section('contenido')
{!! Form::open(array('action' => array('DAO@editarPerfil') ))!!}
<label>Nombre</label><br>
{!! Form::text('name', $value=auth()->user()->name) !!}<br>
<label>Email</label><br>
{!! Form::email('email', $value=auth()->user()->email) !!}<br>
{!! Form::submit('Cambiar perfil') !!}
{!! Form::close()!!}
    @endsection
