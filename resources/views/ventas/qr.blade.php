{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">IMAGEN QR</h6>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible text-white fade show" role="alert">
                                <span class="alert-icon align-middle">
                                    <span class="material-icons text-md">
                                        warning
                                    </span>
                                </span>
                                <span class="alert-text"><strong>Por favor!!</strong> {{ $error }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach
                    @else
                    @endif
                </div>
                <div class="card-body">
                    <!-- Mostrar la imagen aquí si la variable está definida -->
                    <div class="card-body">
                        <!-- Mostrar la imagen aquí si la variable está definida -->
                        @isset($imagenQrDeVentas)
                            <img src="{{ $imagenQrDeVentas }}" alt="Imagen QR">
                        @endisset
                        <a href="{{url('/ventas')}}" type="button" class="btn btn-outline-success" title="Regresar"><i class="material-icons">arrow_back</i> Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


