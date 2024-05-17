# IncubaTech System

Sistema de control y gestión de incubaciones desarrollado por el grupo de trabajo BitBusters de la Univesidad Mariano Gálvez sede Chiquimula. Este proyecto utiliza Laravel para el Backend y Tailwind CSS, Font Awesome y Alpine.js para el frontend.

## Requisitos previos

Antes de comenzar, asegúrate de tener instalado lo siguiente en tu sistema:

- PHP (versión 7.4 o superior)
- Composer
- Node.js (versión 12 o superior)
- NPM (versión 6 o superior)

## Instalación

Sigue estos pasos para configurar el proyecto en tu entorno local:

1. Clona este repositorio en tu máquina local:
    ```sh
    git clone https://github.com/Jio7g/incubatech.git
    ```
2. Accede al directorio del proyecto:
    ```sh
    cd incubatech
    ```
3. Instala las dependencias de PHP utilizando Composer:
    ```sh
    composer install
    ```
4. Copia el archivo `.env.example` y renómbralo a `.env`:
    ```sh
    cp .env.example .env
    ```
5. Genera una nueva clave de aplicación:
    ```sh
    php artisan key:generate
    ```
6. Configura la conexión a la base de datos en el archivo `.env` con tus credenciales:
    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```
7. Ejecuta las migraciones de la base de datos:
    ```sh
    php artisan migrate
    ```
8. Crea el primer usuario como superusuario para poder acceder al sistema (usando Tinker):
    ```sh
    php artisan tinker
    ```
    Luego, en la consola interactiva de Tinker:
    ```php
    use App\Models\User;
    $user = new User();
    $user->nombre = 'Admin';
    $user->correo = 'admin@example.com';
    $user->password = Hash::make('Admin321');
    $user->rol = 'SuperUsuario';
    $user->save();
    ```
9. Crea un enlace simbólico para el almacenamiento:
    ```sh
    php artisan storage:link
    ```

## Ejecución

Una vez que hayas completado los pasos de instalación, puedes ejecutar el proyecto de la siguiente manera:

1. Inicia el servidor de desarrollo de Laravel:
    ```sh
    php artisan serve
    ```
2. Accede al proyecto en tu navegador web:
    [http://localhost:8000](http://localhost:8000)

## Dependencias

Este proyecto utiliza las siguientes dependencias principales:

- Laravel (framework PHP)
- Tailwind CSS (framework CSS utility-first)
- Font Awesome (biblioteca de iconos)
- Alpine.js (biblioteca JavaScript)

Puedes encontrar más detalles sobre las dependencias en los archivos `composer.json` y `package.json`.

## Contribución

Si deseas contribuir a este proyecto, por favor sigue estos pasos:

1. Haz un fork del repositorio.
2. Crea una nueva rama con tu funcionalidad o corrección de errores.
3. Realiza tus cambios y asegúrate de que el proyecto siga funcionando correctamente.
4. Envía una solicitud de extracción (pull request) describiendo tus cambios.

## Licencia

Este proyecto está licenciado bajo la [Licencia MIT](https://opensource.org/licenses/MIT).
