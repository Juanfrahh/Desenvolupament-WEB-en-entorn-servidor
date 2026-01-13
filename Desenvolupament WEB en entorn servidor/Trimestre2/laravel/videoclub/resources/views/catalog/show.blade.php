@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Detalle de la película {{ $id }}</h1>
            <div class="card">
                <div class="card-body">
                    <p>Vista de detalle de la película con ID: {{ $id }}</p>
                    <a href="{{ url('catalog') }}" class="btn btn-secondary">Volver al catálogo</a>
                    <a href="{{ url('catalog/edit/' . $id) }}" class="btn btn-warning">Editar</a>
                </div>
            </div>
        </div>
    </div>
@endsection