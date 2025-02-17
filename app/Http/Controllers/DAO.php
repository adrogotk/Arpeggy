<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Artista;
use App\Disco;
use App\Cancion;
use App\Compra;
use App\Lista_reproduccion;
use App\Canciones_lista;
use App\Seguimiento;
//use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DAO extends Controller
{
    public function obtenerInicioLaravel(){
        if (isset(auth()->user()->id)){
            return self::obtenerPaginaPrincipal();
        }
        return view('welcome');
    }
    public function obtenerPaginaPrincipal(){
        if (auth()->user()->esArtista == 1) {
            //self::crearArtista();
            $artista=self::obtenerArtista();
            $id=$artista->id;
            if ($artista->urlImagen==null){
                $url="";
            }
            else {
                $url = Storage::url($artista->urlImagen);
            }
            $discos=self::obtenerDiscosArtista($id);
            return view('art.index', compact('artista', 'discos', 'url'));
        }
        $artistas=Artista::all();
        $discos=Disco::all();
        $canciones=Cancion::all();
        $listas= DB::table('lista_reproduccion')->select('nombre')
            ->groupBy('nombre')
            ->get();
        return view('cli.index', compact('artistas', 'discos', 'canciones', 'listas'));


    }
    public function irAPerfil(){
        return view('cli.ver-perfil');
    }
    public function editarPerfil(Request $request){
        $user=auth()->user();
        $user->update($request->all());
        return self::obtenerPaginaPrincipal();
    }
    public function obtenerArtistaPorNombre(Request $request)
    {
        $nombre=$request->nombre;
        $artista = Artista::where('nombre', '=', $nombre)->first();
        if ($artista==null){
            return redirect()->route('index')->with('error', 'no existe el artista');
        }
        if ($artista->urlImagen==null){
            $url="";
        }
        else {
            $url = Storage::url($artista->urlImagen);
        }
        $artistaSeguido=Seguimiento::where('user_id', '=', auth()->user()->id)->where('artista_id', '=', $artista->id)->first();
        if ($artistaSeguido==null){
            $seguido=false;
        }
        else{
            $seguido=true;
        }
        $discos=self::obtenerDiscosArtista($artista->id);
        return view('cli.artista-detalle', compact('artista', 'discos', 'url', 'seguido'));
    }
    public static function obtenerArtistaPorId($id){
        $artista=Artista::findOrFail($id);
        $nombreArtista=$artista->nombre;
        return $nombreArtista;
    }
    public static function obtenerArtistaCancion($id){
        $disco=self::obtenerDiscoPorId($id);
        $artista=self::obtenerArtistaPorId($disco->artista_id);
        return $artista;
    }
    public static function crearArtista($data){
        $nombre=$data['name'];
        //$id = DB::getPdo()->lastInsertId();
        $datos=[
            'idUsuario' => DB::getPdo()->lastInsertId(),
            'nombre' => $nombre,
            'biografia' => null];
        Artista::create($datos);
    }
    public function actualizarArtista(Request $request){
        $artista=self::obtenerArtista();
        $artista->update($request->all());
        return self::obtenerPaginaPrincipal();
    }
    public function actualizarImagenArtista(Request $request){
        $artista=self::obtenerArtista();
        $urlImagen=$request->file("urlImagen");
        $nombre=$artista->urlImagen;
        if (isset($urlImagen)) {
            $nombreEspacios = $urlImagen->getClientOriginalName();
            $nombre = trim($nombreEspacios);
            //$urlImagen->store("public");
            $urlImagen->move("storage", $nombre);
        }
        $datos=[
            'urlImagen' => $nombre
        ];
        $artista->update($datos);
        return self::obtenerPaginaPrincipal();
    }
    public function obtenerDiscosArtista($id){
        $discos=Disco::where('artista_id', '=', $id)->get();
        return $discos;
    }
    public function obtenerDiscoPorNombre(Request $request)
    {
        $nombre=$request->nombre;
        $disco = Disco::where('titulo', '=', $nombre)->first();
        if ($disco==null){
            return redirect()->route('index')->with('error', 'no existe el disco');
        }
        $nombreArtista= self::obtenerArtistaPorId($disco->artista_id);
        $canciones=self::obtenerCancionesDisco($disco->id);
        if ($disco->urlImagen==null){
            $url="";
        }
        else {
            $url = Storage::url($disco->urlImagen);
        }
        return view('cli.disco-detalle', compact('disco', 'nombreArtista', 'canciones', 'url'));
    }
    public function obtenerDiscoPorIdFormulario(Request $request){
        $disco=Disco::findOrFail($request->id);
        $canciones=self::obtenerCancionesDisco($disco->id);
        $nombreArtista= self::obtenerArtistaPorId($disco->artista_id);
        if ($disco->urlImagen==null){
            $url="";
        }
        else {
            $url = Storage::url($disco->urlImagen);
        }
        return view('cli.disco-detalle', compact('disco', 'nombreArtista', 'canciones', 'url'));
    }
    public static function obtenerDiscoNombre($id){
        $disco=self::obtenerDiscoPorId($id);
        return $disco->titulo;
    }
    public function mostrarDiscoEditar(Request $request){
        $disco=self::obtenerDiscoPorId($request->id);
        $id=$disco->id;
        $canciones=self::obtenerCancionesDisco($id);
        if ($disco->urlImagen==null){
            $url="";
        }
        else {
            $url = Storage::url($disco->urlImagen);
        }
        return view('art.editar-disco', compact('disco', 'canciones', 'url'));
    }
    public function mostrarCrearDisco(Request $request){
        $id=$request->artista_id;
        return view('art.crear-disco', compact('id'));
    }
    public function crearDisco(Request $request){
        if ($request->titulo==""){
            return redirect()->route('DAO/mostrarCrearDisco', $request->artista_id )->with('error', 'Introduce todos los datos');
        }
        $archivo=$request->file("url");
        if (isset($archivo)){
            $nombreConEspacios=$archivo->getClientOriginalName();
            $imagen=trim($nombreConEspacios);
            $archivo->move("storage", $imagen);
        }
        else{
            $imagen=null;
        }
        $datos=[
            'artista_id' => $request->artista_id,
            'titulo' => $request->titulo,
            'urlImagen'=>$imagen,
        ];
        Disco::create($datos);
        return self::obtenerPaginaPrincipal();
    }
    public function actualizarTituloDisco(Request $request){
        $disco=self::obtenerDiscoPorId($request->id);
        $disco->update($request->all());
        return self::mostrarDiscoEditar($request);
    }
    public function actualizarImagenDisco(Request $request){
        $disco=self::obtenerDiscoPorId($request->id);
        $urlImagen=$request->file("urlImagen");
        $nombre=$disco->urlImagen;
        if (isset($urlImagen)) {
            $nombreEspacios = $urlImagen->getClientOriginalName();
            $nombre = trim($nombreEspacios);
            //$urlImagen->store("public");
            $urlImagen->move("storage", $nombre);
        }
        $datos=[
            'urlImagen' => $nombre
        ];
        $disco->update($datos);
        return self::mostrarDiscoEditar($request);
    }
    public function borrarDisco(Request $request){
        $disco=self::obtenerDiscoPorId($request->id);
        $disco->delete();
        return self::obtenerPaginaPrincipal();
    }
    public function obtenerCancionPorNombre(Request $request)
    {
        $nombre=$request->nombre;
        $cancion = Cancion::where('titulo', '=', $nombre)->first();
        if ($cancion==null){
            return redirect()->route('index')->with('error', 'no existe la cancion');
        }
        $disco=self::obtenerDiscoPorId($cancion->disco_id);
        $tituloDisco=$disco->titulo;
        $nombreArtista= self::obtenerArtistaPorId($disco->artista_id);
        //$url=Storage::url($cancion->url);
        $artistasColaboradores=$this->obtenerArtistasColaboradores($cancion);
        $listasReproduccion=self::obtenerListasReproduccion();
        return view('cli.cancion-detalle', compact('cancion', 'nombreArtista', 'tituloDisco', 'artistasColaboradores', 'numeroCuenta', 'listasReproduccion'));
    }
    public function obtenerCancionPorIdFormulario(Request $request){
        $cancion=Cancion::findOrFail($request->id);
        $disco=self::obtenerDiscoPorId($cancion->disco_id);
        $tituloDisco=$disco->titulo;
        $nombreArtista= self::obtenerArtistaPorId($disco->artista_id);
        //$url=Storage::url($cancion->url);
        $artistasColaboradores=$this->obtenerArtistasColaboradores($cancion);
        $listasReproduccion=self::obtenerListasReproduccion();
        return view('cli.cancion-detalle', compact('cancion', 'nombreArtista', 'tituloDisco', 'artistasColaboradores', 'listasReproduccion'));
    }
    public static function obtenerArtistasColaboradores($cancion){
        $artistasColaboradores=null;
        if ($cancion->artistaColaborador_id!=null){
            $artistasColaboradores[0]=self::obtenerArtistaColaborador($cancion->artistaColaborador_id);
            if ($cancion->artistaColaborador2_id!=null){
                $artistasColaboradores[1]=self::obtenerArtistaColaborador($cancion->artistaColaborador2_id);
            }
        }
        return $artistasColaboradores;
    }
    public function mostrarCancionEditar(Request $request){
        $cancion=self::obtenerCancionPorId($request->cancionId);
        $artistasColaboradores=self::obtenerArtistasColaboradores($cancion);
        $artistaColaborador1Nombre="";
        $artistaColaborador2Nombre="";
        if (isset($artistasColaboradores[0])){
            $artistaColaborador1Nombre=$artistasColaboradores[0]->nombre;
            if (isset($artistasColaboradores[1])){
                $artistaColaborador2Nombre=$artistasColaboradores[1]->nombre;
            }
        }
        return view('art.editar-cancion', compact('cancion', 'artistaColaborador1Nombre', 'artistaColaborador2Nombre'));
    }
    public function mostrarCrearCancion(Request $request){
        $id=$request->id;
        return view('art.crear-cancion', compact('id'));
    }
    public function crearCancion(Request $request){
        $archivo=$request->file("url");
        if ($request->numeroCancion==""||$request->titulo==""||$archivo==null){
            return redirect()->route('DAO/mostrarCrearCancion', $request->id )->with('error', 'Introduce todos los datos');
        }
        $nombreConEspacios=$archivo->getClientOriginalName();
        $nombre=trim($nombreConEspacios);
        $archivo->move("storage", $nombre);
        $artistaColaborador_id=null;
        $artistaColaborador2_id=null;
        if ($request->artistaColaborador_id!=""){
            $artistaColaborador=self::obtenerIdArtista($request->artistaColaborador_id);
            if ($artistaColaborador==null){
                return redirect()->route('DAO/mostrarCrearCancion', $request->id )->with('error', 'no existe el artista colaborador');
            }
            $artistaColaborador_id=$artistaColaborador;
        }
        if ($request->artistaColaborador2_id!=""){
            $artistaColaborador2=self::obtenerIdArtista($request->artistaColaborador2_id);
            if ($artistaColaborador2==null){
                return redirect()->route('DAO/mostrarCrearCancion', $request->id )->with('error', 'no existe el artista colaborador');
            }
            $artistaColaborador2_id=$artistaColaborador2;
        }
        $datos=[
            'disco_id' => $request->id,
            'numeroCancion' => $request->numeroCancion,
            'titulo' => $request->titulo,
            'url'=>$nombre,
            'artistaColaborador_id'=>$artistaColaborador_id,
            'artistaColaborador2_id'=>$artistaColaborador2_id
        ];
        Cancion::create($datos);
        return self::mostrarDiscoEditar($request);
    }
    public function actualizarCancion(Request $request){
        $cancion=self::obtenerCancionPorId($request->cancionId);
        $artistaColaborador_id=null;
        $artistaColaborador2_id=null;
        $archivo=$request->file("url");
        $nombre=$cancion->url;
        if (isset($archivo)) {
            $nombreEspacios = $archivo->getClientOriginalName();
            $nombre = trim($nombreEspacios);
            //$archivo->store("public");
            $archivo->move("storage", $nombre);
        }
        if ($request->artistaColaborador_id!=""){
            $artistaColaborador=self::obtenerIdArtista($request->artistaColaborador_id);
            if ($artistaColaborador==null){
                return redirect()->route('DAO/mostrarCancionEditar', $cancion->id )->with('error', 'no existe el artista colaborador');
            }
            $artistaColaborador_id=$artistaColaborador;
        }
        if ($request->artistaColaborador2_id!=""){
            $artistaColaborador2=self::obtenerIdArtista($request->artistaColaborador2_id);
            if ($artistaColaborador2==null){
                return redirect()->route('DAO/mostrarCancionEditar', $cancion->id )->with('error', 'no existe el artista colaborador');
            }
            $artistaColaborador2_id=$artistaColaborador2;
        }
        $datos=[
            'numeroCancion' => $request->numeroCancion,
            'titulo' => $request->titulo,
            'url' => $nombre,
            'artistaColaborador_id'=>$artistaColaborador_id,
            'artistaColaborador2_id'=>$artistaColaborador2_id
        ];
        $cancion->update($datos);
        return self::mostrarDiscoEditar($request);
    }
    public function borrarCancion(Request $request){
        $cancion=self::obtenerCancionPorId($request->idCancion);
        $cancion->delete();
        return self::mostrarDiscoEditar($request);
    }
    public function obtenerPaginaComprar(Request $request){
        $cancion_id=$request->id;
        $numeroCuenta=self::obtenerNumeroCuenta();
        return view ('cli.comprar-cancion', compact('cancion_id', 'numeroCuenta'));
    }
    public function insertarCompra(Request $request){
        if ($request->numeroCuenta==""){
            return redirect()->route('DAO/obtenerPaginaComprar', $request->id )->with('error', 'Introduce todos los datos');
        }
        $cancion=self::obtenerCancionPorId($request->id);
        $url=$cancion->url;
        $datos=[
            'user_id' => auth()->user()->id,
            'cancion_id' => $cancion->id,
            'numeroCuenta'=> $request->numeroCuenta];
        Compra::create($datos);
        //return self::obtenerPaginaPrincipal();
        return view ('cli.descargar-cancion', compact('url'));
    }
    public function irATopCanciones(){
        $descargas=DB::table('compra')
            ->select(DB::raw('count(*) as total'), 'cancion_id')
            ->groupBy('cancion_id')
            ->orderBy('total', 'desc')
            ->get();
        $canciones=null;
        foreach ($descargas as $n=>$descarga){
            $canciones[$n]=self::obtenerCancionPorId($descarga->cancion_id);
        }
        return view ('cli.top-canciones', compact('canciones'));
    }
    public function irAListasReproduccion(){
        $listas=Lista_reproduccion::where('user_id', '=', auth()->user()->id)->get();
        return view ('cli.editar-listas', compact('listas'));
    }
    public function obtenerListasPorNombre(Request $request)
    {
        $nombre=$request->nombre;
        $listas = Lista_reproduccion::where('nombre', '=', $nombre)->get();
        if (!isset($listas[0])){
            return redirect()->route('index')->with('error', 'no existe ninguna lista con ese nombre');
        }
        return view('cli.listas-detalle', compact('listas'));
    }
    public function obtenerListaPorId(Request $request){
        $lista=Lista_reproduccion::find($request->id);
        $canciones=self::obtenerCancionesLista($lista->id);
        if ($lista->user_id==auth()->user()->id) {
            return view('cli.editar-lista', compact('lista', 'canciones'));
        }
        else{
            return view('cli.lista-detalle', compact('lista', 'canciones'));
        }
    }
    public function mostrarCrearLista(){
        return view('cli.crear-lista');
    }
    public function crearLista(Request $request){
        if ($request->nombre==""){
            return redirect()->route('DAO/mostrarCrearLista')->with('error', 'Introduce todos los datos');
        }
        $datos=[
            'user_id' => auth()->user()->id,
            'nombre' => $request->nombre,
        ];
        Lista_reproduccion::create($datos);
        return self::irAListasReproduccion();
    }
    public function borrarLista(Request $request){
        $lista=Lista_reproduccion::find($request->id);
        $lista->delete();
        return self::irAListasReproduccion();
    }
    public function actualizarNombreLista(Request $request){
        $lista=Lista_reproduccion::find($request->id);
        $datos=[
            "nombre" => $request->nombre
        ];
        $lista->update($datos);
        return self::obtenerListaPorId($request);
    }
    public function insertarCancionesLista(Request $request){
        //$lista=Lista_reproduccion::where('id', '=', $request->lista())->first();
        $datos=[
            'lista_id' => $request->lista,
            'cancion_id' => $request->id,
        ];
        Canciones_lista::create($datos);
        return self::obtenerCancionPorIdFormulario($request);
    }
    public function borrarCancionLista(Request $request){
        /*$cancionLista=Canciones_lista::where('lista_id', '=', $request->id)->where('cancion_id', '=', $request->cancion_id)->first();
        $cancionLista->delete();*/
        DB::delete('delete from canciones_lista where lista_id = ? AND cancion_id=?',[$request->id, $request->cancion_id]);
        return self::obtenerListaPorId($request);
    }
    public function irAArtistasSeguidos(){
        $artistas=Seguimiento::where('user_id', '=', auth()->user()->id)->get();
        return view("cli.artistas-seguidos", compact('artistas'));
    }
    public function irAArtistasSeguidosCanciones(){
        $artistas=Seguimiento::where('user_id', '=', auth()->user()->id)->get();
        $discos=null;
        $numeroDiscos=0;
        $numeroCanciones=0;
        $canciones=null;
        $cancionesLista=null;
        foreach ($artistas as $n=>$artista){
            $discos[$n]=self::obtenerDiscosArtista($artista->artista_id);
        }
        foreach ($discos as $n=>$discosArtista){
            foreach($discosArtista as $n2=>$disco) {
                $canciones[$numeroDiscos + $n2] = self::obtenerCancionesDisco($disco->id);
            }
            $numeroDiscos+=sizeof($discosArtista);
        }
        foreach ($canciones as $n=>$cancionesDisco){
            foreach($cancionesDisco as $n2=>$cancion) {
                $cancionesLista[$numeroCanciones + $n2]=$cancion;
            }
            $numeroCanciones+=sizeof($cancionesDisco);
        }
        foreach ($cancionesLista as $n => $cancion) {
            $fechasCreacion[$n] = $cancion['created_at'];
        }
        array_multisort($fechasCreacion, SORT_DESC, $cancionesLista);
        return view ('cli.artistas-seguidos-canciones', compact('cancionesLista'));
    }
    public function crearSeguimiento(Request $request){
        $datos=[
            'user_id' => auth()->user()->id,
            'artista_id' => $request->id,
        ];
        Seguimiento::create($datos);
        return self::obtenerArtistaPorNombre($request);
    }
    public function borrarSeguimiento(Request $request){
        DB::delete('delete from seguimiento where user_id = ? AND artista_id=?',[auth()->user()->id, $request->id]);
        return self::obtenerArtistaPorNombre($request);
    }
    private function obtenerArtista(){
        $id=auth()->user()->id;
        $artista =  Artista::where('idUsuario', '=', $id)->firstOrFail();
        return $artista;
    }
    private function obtenerIdArtista($nombre){
        $artista = Artista::where('nombre', '=', $nombre)->first();
        if ($artista==null){
            return null;
        }
        return $artista->id;
    }
    private static function obtenerArtistaColaborador($id){
        $artista=Artista::findOrFail($id);
        return $artista;
    }
    private static function obtenerDiscoPorId($id){
        $disco=Disco::findOrFail($id);
        return $disco;
    }
    private function obtenerCancionPorId($id){
        $cancion=Cancion::findOrFail($id);
        return $cancion;
    }
    private function obtenerCancionesDisco($id){
        $canciones=Cancion::where('disco_id', '=', $id)->get()->sortBy("numeroCancion");
        return $canciones;
    }
    private function obtenerNumeroCuenta(){
        $ultimaCompraUsuario=Compra::where('user_id', '=', auth()->user()->id)->orderByDesc('created_at')->first();
        if ($ultimaCompraUsuario==null){
            $numeroCuenta="";
        }
        else{
            $numeroCuenta=$ultimaCompraUsuario->numeroCuenta;
        }
        return $numeroCuenta;
    }
    private function obtenerListasReproduccion(){
        $listas=Lista_reproduccion::where('user_id', '=', auth()->user()->id)->get();
        if (isset($listas[0])){
            return $listas;
        }
        else{
            $datos=[
                'user_id' => auth()->user()->id,
                'nombre' => "Lista por defecto"
            ];
            Lista_reproduccion::create($datos);
            return null;
        }
    }
    private function obtenerCancionesLista($id){
        $cancionesLista=Canciones_lista::where('lista_id', '=', $id)->get();
        $canciones=null;
        foreach ($cancionesLista as $n=>$cancion){
            $canciones[$n]=self::obtenerCancionPorId($cancion->cancion_id);
        }
        return $canciones;
    }
}
