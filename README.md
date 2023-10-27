# Proyecto de Gestión de Tareas

Este proyecto es una aplicación web de gestión de tareas que permite a los usuarios crear, actualizar, y eliminar tareas, así como asignar etiquetas a las tareas. También incluye una API para realizar estas operaciones de manera programática.

## Características del Proyecto

- **Autenticación:** Los usuarios pueden registrarse e iniciar sesión para administrar sus tareas.
- **Gestión de Tareas:** Los usuarios pueden crear, ver, actualizar y eliminar tareas.
- **Asignación de Etiquetas:** Las tareas pueden tener etiquetas que permiten una mejor organización.
- **API:** Se proporciona una API para interactuar con las tareas y usuarios de manera programática.

## Uso de la Aplicación

### Requisitos

- PHP >= 8
- Composer
- MySQL
- Laravel 10

### Instalación

1. Clona el repositorio: `git clone <URL del repositorio>`
2. Entra al directorio del proyecto: `cd gestion-de-tareas`
3. Instala las dependencias: `composer install`
4. Configura tu archivo `.env` con los detalles de la base de datos.
5. Genera una clave de aplicación: `php artisan key:generate`
6. Ejecuta las migraciones de la base de datos: `php artisan migrate`
7. Inicia el servidor: `php artisan serve`

### Acceso a la Aplicación

Una vez que el servidor esté en funcionamiento, puedes acceder a la aplicación en tu navegador web visitando `http://localhost:8000`. Asegúrate de registrarte o iniciar sesión para comenzar a administrar tus tareas.

## API

### Autenticación

La API utiliza autenticación con tokens de acceso generados a través de la ruta `/sactum/token`. Debes incluir este token en la cabecera de tus solicitudes a la API.

### Recursos

#### Tareas

- **GET `/api/tareas`:** Obtiene una lista de todas las tareas disponibles.
- **GET `/api/tareas/{id}`:** Obtiene detalles de una tarea específica por ID.
- **POST `/api/tareas`:** Crea una nueva tarea proporcionando los detalles necesarios.
- **PUT `/api/tareas/{id}`:** Actualiza una tarea existente proporcionando su ID y los nuevos detalles.
- **DELETE `/api/tareas/{id}`:** Elimina una tarea existente por ID.

#### Usuarios

- **POST `/sactum/token`:** Obtiene un token de autenticación proporcionando tu dirección de correo electrónico y contraseña.

Para obtener más detalles y ejemplos de solicitudes y respuestas, consulta la documentación generada de la API.
