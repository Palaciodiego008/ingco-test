@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Listado de Tareas</h2>
    <a href="{{ route('tareas.create') }}" class="btn btn-primary mb-2">Crear Nueva Tarea</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha de Creación</th>
                <th>Fecha de Vencimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tareas as $tarea)
            <tr>
                <td>{{ $tarea->id }}</td>
                <td>{{ $tarea->nombre }}</td>
                <td>{{ $tarea->descripcion }}</td>
                <td>{{ $tarea->created_at->format('Y-m-d H:i:s') }}</td>
                <td>{{ $tarea->fecha_vencimiento }}</td>
                <td>
                    @can('update', $tarea)
                        <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    @endcan

                    @can('delete', $tarea)
                        <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">Eliminar</button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
