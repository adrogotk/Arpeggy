@extends('layout')
@section('contenido')
    {!! Form::open(array('action' => array('DAO@actualizarNombreLista') ))!!}
    {!! Form::hidden('id', $value=$lista->id) !!}
    <label>Nombre Lista</label><br>
    {!! Form::text('nombre', $value=$lista->nombre) !!}
    {!! Form::submit('Cambiar Nombre') !!}
    {!! Form::close()!!}
    <table class="table table-bordered">
        <tr>
            <th>Artista Cancion</th>
            <th>Titulo Cancion</th>
            <th>Disco Cancion</th>
            <th>Eliminar Cancion de lista</th>
        </tr>
        @if($canciones!=null)
        @foreach ($canciones as $cancion)
            <tr>
                <td> <a href="{{route("DAO/obtenerArtistaPorNombre", \App\Http\Controllers\DAO::obtenerArtistaCancion($cancion->disco_id)) }}">{{ \App\Http\Controllers\DAO::obtenerArtistaCancion($cancion->disco_id) }}</a></td>
                <td><a href="{{route("DAO/obtenerCancionPorNombre",$cancion->titulo ) }}">{{$cancion->titulo}}</a></td>
                <td><a href="{{route("DAO/obtenerDiscoPorNombre", \App\Http\Controllers\DAO::obtenerDiscoNombre($cancion->disco_id) ) }}">{{ \App\Http\Controllers\DAO::obtenerDiscoNombre($cancion->disco_id)  }}</a></td>
                <td>{!! Form::open(array('action' => array('DAO@borrarCancionLista') ))!!}
                    {!! Form::hidden('id', $value=$lista->id) !!}
                    {!! Form::hidden('cancion_id', $value=$cancion->id) !!}
                    {!! Form::submit('Eliminar cancion') !!}
                    {!! Form::close()!!}</td>
        @endforeach
            @endif
    </table>
@endsection
