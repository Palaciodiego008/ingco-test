@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Tarea</h2>

    <form action="{{ route('tareas.update', $tarea->id) }}" method="PUT">
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

        <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
    </form>
</div>
@endsection
