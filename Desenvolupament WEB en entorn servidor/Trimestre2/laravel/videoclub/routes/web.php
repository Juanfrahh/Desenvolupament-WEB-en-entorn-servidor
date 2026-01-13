<?php

use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', function () {
    return 'Página principal';
});

// Login de usuario
Route::get('login', function () {
    return 'Login de usuario';
});

// Logout de usuario
Route::get('logout', function () {
    return 'Logout de usuario';
});

// Listado de películas
Route::get('catalog', function () {
    return 'Listado de películas';
});

// Vista detalle de película
Route::get('catalog/show/{id}', function ($id) {
    return "Vista detalle de la película $id";
});

// Formulario de creación de película
Route::get('catalog/create', function () {
    return 'Formulario de creación de película';
});

// Formulario de edición de película
Route::get('catalog/edit/{id}', function ($id) {
    return "Modificar la película $id";
});