@extends('layout')
@section('contenido')
    <a href='{{ asset("storage/$url" )}}' onclick="location.href='{{route("index") }}';" download> Descargar cancion</a>
@endsection