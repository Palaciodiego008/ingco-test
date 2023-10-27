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

        return view('tareas.create', compact('users','etiquetas'));
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
        $users = User::all();
        $etiquetas = Etiqueta::all();
        return view('tareas.edit', compact('tarea', 'users','etiquetas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha_vencimiento' => 'required|date',
            'user_id' => 'required',
            'etiquetas' => 'array', // Asegúrate de que el campo de etiquetas sea un arreglo
        ]);

        $tarea = Tarea::find($id);

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
        Tarea::find($id)->delete();

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada exitosamente.');
    }
}
