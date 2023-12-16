{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

@extends('layouts.panel')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Boton para pagar</h6>
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
                    <form method="post" id="FormPagoFacil" action="https://checkout.pagofacil.com.bo/es/pay" enctype="multipart/form-data" class="form">
                        @csrf {{-- Agrega el token CSRF de Laravel --}}
                        <input name="tcParametros" id="tcParametros" type="hidden" value="{{$tcParametros}}">
                        <input name="tcCommerceID" id="tcCommerceID" type="hidden" value="{{$Commerceid}}">
                        <button type="submit" class="btn btn-primary" id="btnpagar">Pagar</button>
                    </form>


                </div>
            </div>
        </div>
    </div>


@endsection

