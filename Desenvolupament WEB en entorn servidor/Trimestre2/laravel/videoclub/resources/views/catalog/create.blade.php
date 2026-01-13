@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Añadir película</h1>
            <div class="card">
                <div class="card-body">
                    <p>Formulario para crear una nueva película</p>
                    <a href="{{ url('catalog') }}" class="btn btn-secondary">Volver al catálogo</a>
                </div>
            </div>
        </div>
    </div>
@endsection