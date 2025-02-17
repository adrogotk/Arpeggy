@extends('layout')
@section('contenido')
    <table class="table table-bordered">
        <tr>
            <th>Artista</th>
            <th>Titulo</th>
            <th>Disco</th>
        </tr>
        @if($cancionesLista!=null)
            @foreach ($cancionesLista as $cancion)
                <tr>
                    <td> <a href="{{route("DAO/obtenerArtistaPorNombre", \App\Http\Controllers\DAO::obtenerArtistaCancion($cancion->disco_id)) }}">{{ \App\Http\Controllers\DAO::obtenerArtistaCancion($cancion->disco_id) }}</a></td>
                    <td><a href="{{route("DAO/obtenerCancionPorNombre",$cancion->titulo ) }}">{{$cancion->titulo}}</a></td>
                    <td><a href="{{route("DAO/obtenerDiscoPorNombre", \App\Http\Controllers\DAO::obtenerDiscoNombre($cancion->disco_id) ) }}">{{ \App\Http\Controllers\DAO::obtenerDiscoNombre($cancion->disco_id)  }}</a></td>
                </tr>
            @endforeach
        @endif
    </table>
@endsection
