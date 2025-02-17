
@extends('layout')

@section('contenido')
    @if ($mensaje = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $mensaje }}</p>
        </div>
    @endif
{!! Form::open(array('action' => array('DAO@obtenerArtistaPorNombre') ))!!}
<label>Nombre Artista</label><br>
{!! Form::text('nombre', null, ['id'=>'textoArtista', 'onkeyup'=>'barraBusqueda("textoArtista", "listaArtistas")', 'autocomplete'=>"off"]) !!}
{!! Form::submit('ver artista') !!}
{!! Form::close()!!}
    <ul id="listaArtistas">
        @foreach ($artistas as $artista)
        <li style="display: none" id="busqueda"><a href="{{route("DAO/obtenerArtistaPorNombre", $artista->nombre) }}">{{$artista->nombre}}</a></li>
            @endforeach
    </ul>
{!! Form::open(array('action' => array('DAO@obtenerDiscoPorNombre') ))!!}
<label>Nombre Disco</label><br>
{!! Form::text('nombre', null, ['id'=>'textoDisco', 'onkeyup'=>'barraBusqueda("textoDisco", "listaDiscos")', 'autocomplete'=>"off"]) !!}
{!! Form::submit('ver disco') !!}
{!! Form::close()!!}
    <ul id="listaDiscos">
        @foreach ($discos as $disco)
            <li style="display: none" id="busqueda"><a href="{{route("DAO/obtenerDiscoPorNombre", $disco->titulo) }}">{{$disco->titulo}} ({{\App\Http\Controllers\DAO::obtenerArtistaPorId($disco->artista_id)}})</a></li>
        @endforeach
    </ul>
{!! Form::open(array('action' => array('DAO@obtenerCancionPorNombre') ))!!}
<label>Nombre Cancion</label><br>
{!! Form::text('nombre', null, ['id'=>'textoCancion', 'onkeyup'=>'barraBusqueda("textoCancion", "listaCanciones")', 'autocomplete'=>"off"]) !!}
{!! Form::submit('ver cancion') !!}
{!! Form::close()!!}
    <ul id="listaCanciones">
        @foreach ($canciones as $cancion)
            <li style="display: none" id="busqueda"><a href="{{route("DAO/obtenerCancionPorNombre", $cancion->titulo) }}">{{$cancion->titulo}} ({{\App\Http\Controllers\DAO::obtenerArtistaCancion($cancion->disco_id)}})</a></li>
        @endforeach
    </ul>
    {!! Form::open(array('action' => array('DAO@obtenerListasPorNombre') ))!!}
    <label>Nombre Lista</label><br>
    {!! Form::text('nombre', null, ['id'=>'textoLista', 'onkeyup'=>'barraBusqueda("textoLista", "listaListas")', 'autocomplete'=>"off"]) !!}
    {!! Form::submit('ver listas') !!}
    {!! Form::close()!!}
    <ul id="listaListas">
        @foreach ($listas as $lista)
            <li style="display: none" id="busqueda"><a href="{{route("DAO/obtenerListasPorNombre", $lista->nombre) }}">{{$lista->nombre}}</a></li>
        @endforeach
    </ul>
    @endsection
