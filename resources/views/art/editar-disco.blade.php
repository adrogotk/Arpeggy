@php
    use App\Http\Controllers\DAO;
@endphp
@extends('layout')
@section('contenido')
    <div>Titulo</div>
    {!! Form::open(array('action' => array('DAO@actualizarTituloDisco') ))!!}
    {!! Form::hidden('id', $value=$disco->id) !!}
    {!! Form::text('titulo', $value=$disco->titulo) !!}
    {!! Form::submit('Cambiar Titulo') !!}
    {!! Form::close()!!}
    @if($url!="")
        <div><img src="{{$url}}"></div>
    @endif
    {!! Form::open(array('action' => array('DAO@actualizarImagenDisco'), 'files' => true  ))!!}
    {!! Form::hidden('id', $value=$disco->id) !!}<br>
    {!! Form::file('urlImagen') !!}<br>
    {!! Form::submit('Elegir Portada disco') !!}
    {!! Form::close()!!}
    <table class="table table-bordered">
        <tr>
            <th>Numero Cancion</th>
            <th>Titulo</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        @foreach ($canciones as $cancion)
            <tr>
                <td>{{ $cancion->numeroCancion }}</td>
                <td>{{ $cancion->titulo }}</td>
                <td>{!! Form::open(array('action' => array('DAO@mostrarCancionEditar') ))!!}
                    {!! Form::hidden('cancionId', $value=$cancion->id) !!}
                    {!! Form::submit('editar cancion') !!}
                    {!! Form::close()!!}</td>
                <td>
                    {!! Form::open(array('action' => array('DAO@borrarCancion') ))!!}
                    {!! Form::hidden('id', $value=$disco->id) !!}
                    {!! Form::hidden('idCancion', $value=$cancion->id) !!}
                    {!! Form::submit('borrar') !!}
                    {!! Form::close()!!}
                </td>
            </tr>
        @endforeach
    </table>
    {!! Form::open(array('action' => array('DAO@mostrarCrearCancion') ))!!}
    {!! Form::hidden('id', $value=$disco->id) !!}
    {!! Form::submit('Añadir cancion') !!}
    {!! Form::close()!!}<br>
    {!! Form::open(array('action' => array('DAO@obtenerPaginaPrincipal') ))!!}
    {!! Form::submit('Ir a la pagina principal') !!}
    {!! Form::close()!!}
@endsection
