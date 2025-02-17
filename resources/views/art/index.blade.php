@extends('layout')
@section('contenido')
    {!! Form::open(array('action' => array('DAO@editarPerfil') ))!!}
    <label>Nombre Usuario</label><br>
    {!! Form::text('name', $value=auth()->user()->name) !!}<br>
    <label>Email</label><br>
    {!! Form::email('email', $value=auth()->user()->email) !!}<br>
    {!! Form::submit('Cambiar perfil') !!}
    {!! Form::close()!!}
    @if($url!="")
        <div><img src="{{$url}}"></div>
    @endif
    {!! Form::open(array('action' => array('DAO@actualizarImagenArtista'), 'files' => true  ))!!}
    {!! Form::file('urlImagen') !!}<br>
    {!! Form::submit('Añadir Imagen de perfil') !!}<br>
    {!! Form::close()!!}

    {!! Form::open(array('action' => array('DAO@actualizarArtista') ))!!}
    <label>Nombre Artista</label><br>
    {!! Form::text('nombre', $value=$artista->nombre) !!}<br>
    <label>Biografia</label>
    {!! Form::textArea('biografia', $value=$artista->biografia, ['class' => 'form-control', 'rows' => 8]) !!}
    {!! Form::submit('Cambiar datos') !!}
    {!! Form::close()!!}

    <table class="table table-bordered">
        <tr>
            <th>Titulo</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        @foreach ($discos as $disco)
            <tr>
                <td>{{ $disco->titulo }}</td>
                <td>{!! Form::open(array('action' => array('DAO@mostrarDiscoEditar') ))!!}
                    {!! Form::hidden('id', $value=$disco->id) !!}
                    {!! Form::submit('editar disco') !!}
                    {!! Form::close()!!}</td>
                <td>
                    {!! Form::open(array('action' => array('DAO@borrarDisco') ))!!}
                    {!! Form::hidden('id', $value=$disco->id) !!}
                    {!! Form::submit('borrar') !!}
                    {!! Form::close()!!}
                </td>
            </tr>
        @endforeach
    </table>
    {!! Form::open(array('action' => array('DAO@mostrarCrearDisco') ))!!}
    {!! Form::hidden('artista_id', $value=$artista->id) !!}
    {!! Form::submit('Añadir Disco') !!}
    {!! Form::close()!!}
    @endsection
