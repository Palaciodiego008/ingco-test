<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

/**
     * @OA\Info(
     *      title="Tareas API",
     *      version="1.0",
     *      description="API para el manejo de tareas",
     * )
     */
class TareaApiController extends Controller
{
    public function index()
    {
        $tareas = Tarea::all();
        return response()->json($tareas);
    }

    public function store(Request $request)
    {
        // Obtiene los datos del request
        $data = $request->all();

        if (isset($data['user_id'])) {
            $tarea = Tarea::create([
                'nombre' => $data['nombre'],
                'descripcion' => $data['descripcion'],
                'fecha_vencimiento' => $data['fecha_vencimiento'],
                'user_id' => $data['user_id'],
            ]);

            return response()->json($tarea, 201);
        } else {
            return response()->json(['error' => 'El campo "user_id" es requerido.'], 400);
        }
    }



    public function show($id)
    {
        // Muestra una tarea específica
        $tarea = Tarea::findOrFail($id);
        return response()->json($tarea);
    }

    public function update(Request $request, $id)
    {
        // Actualiza una tarea específica
        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->all());
        return response()->json($tarea, 200);
    }

    public function destroy($id)
    {
        // Elimina una tarea específica
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
        return response()->json(null, 204);
    }
}
