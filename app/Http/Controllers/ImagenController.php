<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\User;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
    private static $idcliente=0;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        // dd($id);
        $imagen = Imagen::where('user_id',$id)->first();
        $clienteId= $id;
        // return view('imagenes.comparar',compact('clienteId'))
        // dd($imagen);
        // dd($imagen);
        return view('imagenes.create', compact('imagen','clienteId'));
        // return view('imagenes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Lógica para validar y guardar la imagen en la base de datos
        // Aquí deberías verificar que el usuario tiene el rol correcto antes de permitir la acción.

        $user = auth()->user();

        // Verificar el rol del usuario
        if ($user->role == 'cliente') {
            // Validar y guardar la imagen
            $request->validate([
                'url_imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $directorio = storage_path('app/public/imagenes');
            // dd($directorio);
            if (!file_exists($directorio)) {
                mkdir($directorio, 0755, true);
            }

            $path=$request->file('url_imagen')->storeAs('public/imagenes',request('url_imagen')->getClientOriginalName());
            $imagen = new Imagen();
            $imagen->url_imagen = request('url_imagen')->getClientOriginalName(); // Almacenar la imagen en la carpeta 'public/imagenes'
            $imagen->user_id = $user->id;
            $imagen->save();

            return redirect()->back()->with('success', 'Imagen subida correctamente.');
        } else {
            return redirect()->back()->with('error', 'No tienes permisos para subir imágenes.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Imagen $imagen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imagen $imagen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Imagen $imagen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Imagen $imagen)
    {
        //
    }

    public function compararImagenes(Request $request)
    {
        return view('imagenes.comparar');
    }

    public function mostrarCaptura(String $id)
    {
        self::$idcliente=$id;
        // $clienteId= $this->idcliente;
        return view('imagenes.comparar',compact('id'));
        // return response()->json(['mensaje' => 'Imagen recibida y procesada con éxito']);
        // Resto de la lógica de comparación...
    }
    public function procesarCaptura(Request $request)
    {
    // Obtener la imagen capturada del formulario
    $imagenCapturadaBase64 = $request->input('imagen');

    // Guardar la imagen capturada temporalmente
    $rutaImagenTemp = $this->guardarImagenTemporal($imagenCapturadaBase64);

    // Comparar con AWS Rekognition
    $similarity = $this->compararCarasConRekognition($rutaImagenTemp, $request->id);

    // Si la similitud es alta, marcar la ubicación como visitada
    if ($similarity >= 70) {
        $this->marcarUbicacionComoVisitada($request->id);
    }

    // Eliminar la imagen temporal después de procesarla
    unlink($rutaImagenTemp);

    // Redireccionar a la vista con un mensaje
    return redirect('/ver_rutas')->with('success', 'Captura procesada con éxito');
}

private function guardarImagenTemporal($imagenBase64)
{
    $directorioTemp = storage_path('app/temp');
    if (!file_exists($directorioTemp)) {
        mkdir($directorioTemp, 0755, true);
    }
    $rutaImagenTemp = $directorioTemp . '/captura.jpg';
    file_put_contents($rutaImagenTemp, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenBase64)));
    return $rutaImagenTemp;
}

private function compararCarasConRekognition($rutaImagen, $userId)
{
    $rutaI1 = storage_path('app/public/imagenes');
    $foto = Imagen::where('user_id', $userId)->first();
    $rutaImagenCliente = $rutaI1.'/'.$foto->url_imagen;

    $rekognition = new RekognitionClient([
        'region' => 'us-east-1',
        'version' => 'latest',
        'credentials' => [
            'key' => 'TU_ACCESS_KEY',
            'secret' => 'TU_SECRET_KEY',
        ],
    ]);

    $result = $rekognition->compareFaces([
        'SimilarityThreshold' => 70,
        'SourceImage' => [
            'Bytes' => file_get_contents($rutaImagenCliente),
        ],
        'TargetImage' => [
            'Bytes' => file_get_contents($rutaImagen),
        ],
    ]);

    return $result['FaceMatches'][0]['Similarity'];
}

private function marcarUbicacionComoVisitada($userId)
{
    $cliente = User::find($userId);
    $ubicacionCliente = $cliente->ubicacions->first();
    if ($ubicacionCliente) {
        foreach ($ubicacionCliente->rutas as $ruta) {
            $ruta->pivot->update([
                'estado_visita' => 'visitado',
                'updated_at' => now()
            ]);
        }
    }
}
}
