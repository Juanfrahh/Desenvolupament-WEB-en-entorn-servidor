@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Listado de películas</h1>
            <a href="{{ url('catalog/create') }}" class="btn btn-primary mb-3">
                Añadir película
            </a>
            <p>Aquí se mostrará el catálogo de películas</p>
        </div>
    </div>
@endsection