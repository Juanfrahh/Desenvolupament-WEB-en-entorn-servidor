@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Editar película {{ $id }}</h1>
            <div class="card">
                <div class="card-body">
                    <p>Formulario para editar la película con ID: {{ $id }}</p>
                    <a href="{{ url('catalog') }}" class="btn btn-secondary">Volver al catálogo</a>
                    <a href="{{ url('catalog/show/' . $id) }}" class="btn btn-info">Ver detalle</a>
                </div>
            </div>
        </div>
    </div>
@endsection