@extends('layout')
@section('contenido')
    <div>Nombre Artista: {{$nombreArtista}}</div>
    {!! Form::open(array('action' => array('DAO@obtenerArtistaPorNombre') ))!!}
    {!! Form::hidden('nombre', $value=$nombreArtista) !!}
    {!! Form::submit('Ver artista') !!}
    {!! Form::close()!!}
    <div>Titulo: {{$disco->titulo}}</div>
    @if($url!="")
        <div><img src="{{$url}}"></div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Numero Cancion</th>
            <th>Titulo</th>
            <th>Ver Cancion</th>
        </tr>
        @foreach ($canciones as $cancion)
            <tr>
                <td>{{ $cancion->numeroCancion }}</td>
                <td>{{ $cancion->titulo }}</td>
                <td>{!! Form::open(array('action' => array('DAO@obtenerCancionPorIdFormulario') ))!!}
                    {!! Form::hidden('id', $value=$cancion->id) !!}
                    {!! Form::submit('ver cancion') !!}
                    {!! Form::close()!!}</td>
        @endforeach
    </table>
@endsection
