@extends('layout')
@section('contenido')
    <table class="table table-bordered">
        <tr>
            <th>Posicion</th>
            <th>Artista</th>
            <th>Titulo</th>
            <th>Disco</th>
        </tr>
        @if($canciones!=null)
@foreach ($canciones as $cancion)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td> <a href="{{route("DAO/obtenerArtistaPorNombre", \App\Http\Controllers\DAO::obtenerArtistaCancion($cancion->disco_id)) }}">{{ \App\Http\Controllers\DAO::obtenerArtistaCancion($cancion->disco_id) }}</a></td>
        <td><a href="{{route("DAO/obtenerCancionPorNombre",$cancion->titulo ) }}">{{$cancion->titulo}}</a></td>
        <td><a href="{{route("DAO/obtenerDiscoPorNombre", \App\Http\Controllers\DAO::obtenerDiscoNombre($cancion->disco_id) ) }}">{{ \App\Http\Controllers\DAO::obtenerDiscoNombre($cancion->disco_id)  }}</a></td>
    </tr>
@endforeach
        @endif
    </table>
    @endsection