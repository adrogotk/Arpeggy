@extends('layout')
@section('contenido')
    <table class="table table-bordered">
        <tr>
            <th>Artista</th>
        </tr>
        @foreach ($artistas as $artista)
            <tr>
                <td> <a href="{{route("DAO/obtenerArtistaPorNombre", \App\Http\Controllers\DAO::obtenerArtistaPorId($artista->artista_id)) }}">{{ \App\Http\Controllers\DAO::obtenerArtistaPorId($artista->artista_id) }}</a></td>
        @endforeach
    </table>
@endsection
