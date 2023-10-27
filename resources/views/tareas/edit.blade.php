@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Tarea</h2>

    <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $tarea->nombre }}">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ $tarea->descripcion }}</textarea>
        </div>

        <div class="form-group">
            <label for="fecha_vencimiento">Fecha de Vencimiento</label>
            <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{ $tarea->fecha_vencimiento }}">
        </div>

        <!-- Agregar un campo de selección para el usuario -->
        <div class="form-group">
            <label for="usuario_id">Usuario</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $tarea->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Agregar un campo de selección múltiple para etiquetas -->
        <div class="form-group">
            <label for="etiquetas">Etiquetas</label>
            <select name="etiquetas[]" id="etiquetas" class="form-control" multiple>
                @foreach($etiquetas as $etiqueta)
                    <option value="{{ $etiqueta->id }}" {{ in_array($etiqueta->id, $tarea->etiquetas->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $etiqueta->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
    </form>
</div>
@endsection
