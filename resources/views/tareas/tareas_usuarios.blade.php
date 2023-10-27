@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tareas de {{ $user->name }}</h2>

    <ul>
        @foreach ($tareas as $tarea)
            <li>{{ $tarea->nombre }}</li>
        @endforeach
    </ul>
</div>
@endsection
