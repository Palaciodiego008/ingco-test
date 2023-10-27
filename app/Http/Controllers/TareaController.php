<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Http\Request;


class TareaController extends Controller
{

    public function index()
    {
        $tareas = Tarea::all();
        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        $users = User::all();
        $etiquetas = Etiqueta::all();

        return view('tareas.create', compact('users', 'etiquetas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha_vencimiento' => 'required|date',
            'user_id' => 'required',
            'etiquetas' => 'array|required',
        ]);

        $tarea = new Tarea([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'fecha_vencimiento' => $request->input('fecha_vencimiento'),
        ]);

        $tarea->usuario()->associate(User::find($request->input('user_id')));
        $tarea->save();
        $tarea->etiquetas()->sync($request->input('etiquetas'));

        return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente.');
    }



    public function edit($id)
    {
        $tarea = Tarea::find($id);

        $this->authorize('update', $tarea);

        $users = User::all();
        $etiquetas = Etiqueta::all();

        return view('tareas.edit', compact('tarea', 'users', 'etiquetas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha_vencimiento' => 'required|date',
            'user_id' => 'required',
            'etiquetas' => 'array',
        ]);

        $tarea = Tarea::find($id);

        $this->authorize('update', $tarea);

        // Actualiza la tarea con los datos del formulario
        $tarea->update($request->except('etiquetas'));

        // Asigna el usuario a la tarea
        $tarea->usuario()->associate(User::find($request->user_id));

        // Asigna las etiquetas a la tarea
        $tarea->etiquetas()->sync($request->etiquetas);

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada exitosamente.');
    }



    public function destroy($id)
    {
        $tarea = Tarea::find($id);

        $this->authorize('delete', $tarea);

        $tarea->delete();

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada exitosamente.');
    }


    public function taskByUser($id)
    {

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('tareas.index')->with('error', 'Usuario no encontrado');
        }


        $tareas = $user->tareas;

        return view('tareas.tareas_usuario', compact('user', 'tareas'));
    }
}
