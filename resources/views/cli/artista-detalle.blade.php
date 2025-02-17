
@extends('layout')
@section('contenido')
    <div>Nombre artista: {{$artista->nombre}}</div>
    @if ($seguido==false)
    {!! Form::open(array('action' => array('DAO@crearSeguimiento') ))!!}
    {!! Form::hidden('id', $value=$artista->id) !!}
    {!! Form::hidden('nombre', $value=$artista->nombre) !!}
    {!! Form::submit('Seguir') !!}
    {!! Form::close()!!}
    @else
        {!! Form::open(array('action' => array('DAO@borrarSeguimiento') ))!!}
        {!! Form::hidden('id', $value=$artista->id) !!}
        {!! Form::hidden('nombre', $value=$artista->nombre) !!}
        {!! Form::submit('Dejar de Seguir') !!}
        {!! Form::close()!!}
        @endif
    @if($url!="")
    <div><img src="{{$url}}"></div>
    @endif
    <div>Biografia: {{$artista->biografia}}</div>
    <table class="table table-bordered">
        <tr>
            <th>Titulo</th>
            <th>Ver disco</th>
        </tr>
        @foreach ($discos as $disco)
            <tr>
                <td>{{ $disco->titulo }}</td>
                <td>{!! Form::open(array('action' => array('DAO@obtenerDiscoPorIdFormulario') ))!!}
                    {!! Form::hidden('id', $value=$disco->id) !!}
                    {!! Form::submit('Ver disco') !!}
                    {!! Form::close()!!}</td>
            </tr>
        @endforeach
    </table>
@endsection
