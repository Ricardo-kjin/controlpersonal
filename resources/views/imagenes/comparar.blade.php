@extends('layouts.panel')

@section('content')
<h1>Captura de Foto</h1>

<div class="container">

    <div class="card-body">
        @if (session('success'))
          <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
              <span class="alert-icon align-middle">
                <span class="material-icons text-md">
                thumb_up_off_alt
                </span>
              </span>
              <span class="alert-text">¡ {{session('success')}} !</span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
        @endif
      </div>

    <h2>Captura de Imagen</h2>
    <video id="video" width="640" height="480" autoplay></video>
    <button id="capturar">Capturar Imagen</button>
    <canvas id="canvas" width="640" height="480" style="display:none;"></canvas>
    <form action="{{ route('procesarCaptura') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="number" name="id" id="id" value="{{$id}}" hidden>
        <input type="hidden" name="imagen" id="imagen">
        <button type="submit">Procesar Captura</button>
    </form>
</div>

{{-- <script>
    // Acceder a la cámara web y mostrar el video en el elemento de video
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            const video = document.getElementById('video');
            video.srcObject = stream;
        })
        .catch(error => console.error('Error al acceder a la cámara:', error));

    // Capturar foto al hacer clic en el botón
    const capturarBtn = document.getElementById('capturar');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');

    capturarBtn.addEventListener('click', () => {
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Convertir la imagen en base64 y enviarla al servidor (puedes usar AJAX)
        const imageData = canvas.toDataURL('image/jpeg');
        enviarImagenAlServidor(imageData);
    });

    // Función para enviar la imagen al servidor
    function enviarImagenAlServidor(imagenBase64) {
        // Puedes usar AJAX para enviar la imagen al controlador de Laravel
        // Aquí asumo que tienes una ruta llamada '/subir-imagen' en tu controlador
        fetch('/subir-imagen', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ imagen: imagenBase64 }),
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error('Error al enviar la imagen al servidor:', error));
    }
</script> --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const capturarBtn = document.getElementById('capturar');
        const imagenInput = document.getElementById('imagen');

        // Obtener acceso a la cámara
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                video.srcObject = stream;
            })
            .catch(function (error) {
                console.error('Error al acceder a la cámara: ', error);
            });

        // Capturar imagen al hacer clic en el botón
        capturarBtn.addEventListener('click', function () {
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imagenDataUrl = canvas.toDataURL('image/jpeg'); // Obtener la imagen en formato base64

            // Mostrar la imagen capturada en un elemento de la página (opcional)
            const imagenMostrada = document.createElement('img');
            imagenMostrada.src = imagenDataUrl;
            document.body.appendChild(imagenMostrada);

            // Establecer el valor del campo de formulario oculto con la imagen en formato base64
            imagenInput.value = imagenDataUrl;
        });
    });
</script>
@endsection
