@extends('layout')
@section('contenido')
    <div>Nombre Lista: {{$lista->nombre}}</div><br>
    <table class="table table-bordered">
        <tr>
            <th>Artista Cancion</th>
            <th>Titulo Cancion</th>
            <th>Disco Cancion</th>
        </tr>
        @if($canciones!=null)
            @foreach ($canciones as $cancion)
                <tr>
                    <td> <a href="{{route("DAO/obtenerArtistaPorNombre", \App\Http\Controllers\DAO::obtenerArtistaCancion($cancion->disco_id)) }}">{{ \App\Http\Controllers\DAO::obtenerArtistaCancion($cancion->disco_id) }}</a></td>
                    <td><a href="{{route("DAO/obtenerCancionPorNombre",$cancion->titulo ) }}">{{$cancion->titulo}}</a></td>
                    <td><a href="{{route("DAO/obtenerDiscoPorNombre", \App\Http\Controllers\DAO::obtenerDiscoNombre($cancion->disco_id) ) }}">{{ \App\Http\Controllers\DAO::obtenerDiscoNombre($cancion->disco_id)  }}</a></td>
            @endforeach
        @endif
    </table>
@endsection
