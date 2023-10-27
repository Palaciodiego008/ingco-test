<?php

use App\Http\Controllers\TareaApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/**
 * @OA\PathItem(path="/api")
 */


/**
 * @OA\Post(
 *     path="/sactum/token",
 *     tags={"Autenticación"},
 *     summary="Obtener un token de autenticación",
 *     description="Obtén un token de autenticación válido proporcionando tu dirección de correo electrónico (email) y contraseña (password).",
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="email", type="string", format="email", example="usuario@example.com"),
 *             @OA\Property(property="password", type="string", example="contraseña"),
 *         ),
 *     ),
 *     @OA\Response(response=200, description="Token de autenticación generado exitosamente"),
 *     @OA\Response(response=401, description="Credenciales inválidas"),
 * )
 */
Route::post('/sactum/token', function(Request $request){
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required']
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('token', $token, 60*24); // 1 day
        return response(["token"=>$token], Response::HTTP_OK)->withoutCookie($cookie);
    }else{
        return response(["error"=>"Invalid credentials"], Response::HTTP_UNAUTHORIZED);
    }
});

/**
 * @OA\PathItem(path="/api")
 */
Route::group(['middleware' => ['auth:sanctum']], function () {
    /**
 * @OA\Get(
 *     path="/tareas",
 *     tags={"Tareas"},
 *     summary="Obtener una lista de tareas",
 *     description="Obtén una lista de todas las tareas disponibles.",
 *     security={{"passport": {}}},
 *     @OA\Response(response=200, description="Listado de tareas"),
 *     @OA\Response(response=401, description="No autorizado"),
 * )
 */
    Route::get('/tareas', [TareaApiController::class, 'index']);

    /**
 * @OA\Get(
 *     path="/tareas/{id}",
 *     tags={"Tareas"},
 *     summary="Obtener una tarea específica",
 *     description="Obtén detalles de una tarea específica proporcionando su ID.",
 *     security={{"passport": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la tarea",
 *         @OA\Schema(type="integer"),
 *     ),
 *     @OA\Response(response=200, description="Tarea encontrada"),
 *     @OA\Response(response=401, description="No autorizado"),
 *     @OA\Response(response=404, description="Tarea no encontrada"),
 * )
 */
    Route::get('/tareas/{id}', [TareaApiController::class, 'show']);

    /**
 * @OA\Post(
 *     path="/tareas",
 *     tags={"Tareas"},
 *     summary="Crear una nueva tarea",
 *     description="Crea una nueva tarea proporcionando los detalles de la tarea, incluyendo nombre, descripción, fecha de vencimiento y el ID del usuario.",
 *     security={{"passport": {}}},
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="nombre", type="string", example="Nombre de la tarea"),
 *             @OA\Property(property="descripcion", type="string", example="Descripción de la tarea"),
 *             @OA\Property(property="fecha_vencimiento", type="string", format="date", example="2023-10-28"),
 *             @OA\Property(property="user_id", type="integer", example=2),
 *         ),
 *     ),
 *     @OA\Response(response=201, description="Tarea creada exitosamente"),
 *     @OA\Response(response=401, description="No autorizado"),
 *     @OA\Response(response=400, description="Solicitud incorrecta"),
 * )
 */
    Route::post('/tareas', [TareaApiController::class, 'store']);

    /**
 * @OA\Put(
 *     path="/tareas/{id}",
 *     tags={"Tareas"},
 *     summary="Actualizar una tarea existente",
 *     description="Actualiza una tarea existente proporcionando su ID y los nuevos detalles de la tarea.",
 *     security={{"passport": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la tarea",
 *         @OA\Schema(type="integer"),
 *     ),
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="nombre", type="string", example="Nuevo nombre de la tarea"),
 *             @OA\Property(property="descripcion", type="string", example="Nueva descripción de la tarea"),
 *             @OA\Property(property="fecha_vencimiento", type="string", format="date", example="2023-10-30"),
 *             @OA\Property(property="user_id", type="integer", example=2),
 *         ),
 *     ),
 *     @OA\Response(response=200, description="Tarea actualizada exitosamente"),
 *     @OA\Response(response=401, description="No autorizado"),
 *     @OA\Response(response=404, description="Tarea no encontrada"),
 * )
 */
    Route::put('/tareas/{id}', [TareaApiController::class, 'update']);

    /**
 * @OA\Delete(
 *     path="/tareas/{id}",
 *     tags={"Tareas"},
 *     summary="Eliminar una tarea",
 *     description="Elimina una tarea existente proporcionando su ID.",
 *     security={{"passport": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la tarea",
 *         @OA\Schema(type="integer"),
 *     ),
 *     @OA\Response(response=204, description="Tarea eliminada exitosamente"),
 * )
 */
    Route::delete('/tareas/{id}', [TareaApiController::class, 'destroy']);
});
