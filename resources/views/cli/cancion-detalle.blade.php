@extends('layout')
@section('contenido')
    <div>Nombre Artista: {{$nombreArtista}}</div>
    {!! Form::open(array('action' => array('DAO@obtenerArtistaPorNombre') ))!!}
    {!! Form::hidden('nombre', $value=$nombreArtista) !!}
    {!! Form::submit('Ver artista') !!}
    {!! Form::close()!!}
    <div>Titulo Disco: {{$tituloDisco}}</div>
    {!! Form::open(array('action' => array('DAO@obtenerDiscoPorNombre') ))!!}
    {!! Form::hidden('nombre', $value=$tituloDisco) !!}
    {!! Form::submit('ver disco') !!}
    {!! Form::close()!!}
    <div>Numero Cancion: {{$cancion->numeroCancion}}</div>
    <div>Titulo Cancion: {{$cancion->titulo}}
    @if ($artistasColaboradores!=null)
        @foreach($artistasColaboradores as $artista)
            ft: <a href="{{route("DAO/obtenerArtistaPorNombre",$artista->nombre ) }}">{{$artista->nombre}}</a>
            @endforeach
        @endif
    </div>
    <audio controls controlsList="nodownload">
        <source src='{{ asset("storage/$cancion->url" )}}' type="audio/mpeg">
    </audio><br>
    {!! Form::open(array('action' => array('DAO@obtenerPaginaComprar') ))!!}
    {!! Form::hidden('id', $value=$cancion->id) !!}
    {!! Form::submit('Comprar') !!}<br>
    {!! Form::close()!!}
    <button type="button" id="botonModal" data-toggle="modal" data-target="#modalLista">Añadir a lista de reproduccion</button>
    <div class="modal fade" id="modalLista" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p>Escoge la lista a la que quieras añadirla</p>
            </div>
            <div class="modal-body">
        {!! Form::open(array('action' => array('DAO@insertarCancionesLista') ))!!}
        @if($listasReproduccion!=null)
            {!! Form::select('lista', $listasReproduccion->pluck('nombre', 'id'))!!}<br>
            @else
            {!! Form::select('lista', array('Lista por defecto' => 'Lista por defecto'))!!}<br>
         @endif
        {!! Form::hidden('id', $value=$cancion->id) !!}
        {!! Form::submit('Añadir') !!}
        {!! Form::close()!!}
            </div>
        </div>
    </div>
@endsection
