<!-- resources/views/events/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Event</h1>
    <!-- Szerkesztési űrlap vagy más szerkesztési tartalom -->
    <p>Szerkesztési űrlap, ahol meg lehet változtatni az esemény részleteit.</p>
    <p>Példa: Név: {{ $event->name }}</p>
</div>
@endsection