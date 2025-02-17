@extends('layout')
@section('contenido')
    <table class="table table-bordered">
        <tr>
            <th>Nombre lista</th>
            <th>Ver lista</th>
            <th>Eliminar Lista</th>
        </tr>
        @foreach ($listas as $lista)
            <tr>
                <td>{{ $lista->nombre }}</td>
                <td>{!! Form::open(array('action' => array('DAO@obtenerListaPorId') ))!!}
                    {!! Form::hidden('id', $value=$lista->id) !!}
                    {!! Form::submit('Ver lista') !!}
                    {!! Form::close()!!}</td>
                <td>{!! Form::open(array('action' => array('DAO@borrarLista') ))!!}
                    {!! Form::hidden('id', $value=$lista->id) !!}
                    {!! Form::submit('Eliminar lista') !!}
                    {!! Form::close()!!}</td>
        @endforeach
    </table>
    <br><a href="{{ route('mostrarCrearLista') }}">Crear Lista de reproducción</a>
@endsection

