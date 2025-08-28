# Proyecto Laravel con Docker

Este es un proyecto de desarrollo basado en Laravel con un entorno completamente dockerizado.

## Descripción del Proyecto

Este proyecto utiliza Docker para crear un entorno de desarrollo local consistente y reproducible para una aplicación Laravel. Incluye contenedores para Nginx, PHP, y una base de datos, todos orquestados por Docker Compose.

## Estructura de Directorios

El proyecto está organizado de la siguiente manera:

```
.
├── docker-compose.yml      # Archivo de orquestación de Docker.
├── Dockerfile              # Dockerfile para construir la imagen de la aplicación.
├── nginx.conf              # Archivo de configuración de Nginx.
├── laravel/                # Directorio raíz de la aplicación Laravel.
│   ├── app/                # Contiene el núcleo de la aplicación.
│   ├── bootstrap/          # Scripts de arranque de la aplicación.
│   ├── config/             # Archivos de configuración de la aplicación.
│   ├── database/           # Migraciones y seeders de la base de datos.
│   ├── public/             # Punto de entrada de la aplicación (index.php).
│   ├── resources/          # Vistas, assets (CSS, JS) y archivos de idioma.
│   ├── routes/             # Definición de las rutas de la aplicación.
│   ├── storage/            # Archivos de caché, logs y subidas.
│   ├── tests/              # Pruebas de la aplicación.
│   └── vendor/             # Dependencias de Composer.
└── nginx/
    └── nginx.conf          # Configuración del servidor web Nginx.
```

## Cómo Empezar

Sigue estos pasos para poner en marcha el entorno de desarrollo.

### Prerrequisitos

Asegúrate de tener instalados los siguientes programas:

*   [Docker](https://www.docker.com/get-started)
*   [Docker Compose](https://docs.docker.com/compose/install/)

### Instalación

1.  **Clona el repositorio:**

    ```bash
    git clone <URL-DEL-REPOSITORIO>
    cd <NOMBRE-DEL-DIRECTORIO>
    ```

2.  **Configura el archivo de entorno de Laravel:**

    Dentro del directorio `laravel/`, copia el archivo `.env.example` a `.env`.

    ```bash
    cp laravel/.env.example laravel/.env
    ```

    Abre `laravel/.env` y configura las variables de la base de datos para que coincidan con los servicios definidos en `docker-compose.yml`. Por ejemplo:

    ```
    DB_CONNECTION=mysql
    DB_HOST=db          # Nombre del servicio de la base de datos en docker-compose.yml
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=rootpassword
    ```

3.  **Construye y levanta los contenedores de Docker:**

    Desde el directorio raíz del proyecto, ejecuta:

    ```bash
    docker-compose up -d --build
    ```

4.  **Instala las dependencias de Composer:**

    Una vez que los contenedores estén en ejecución, entra al contenedor de la aplicación para instalar las dependencias de PHP.

    ```bash
    docker-compose exec app composer install
    ```

5.  **Genera la clave de la aplicación:**

    ```bash
    docker-compose exec app php artisan key:generate
    ```

6.  **Ejecuta las migraciones de la base de datos:**

    ```bash
    docker-compose exec app php artisan migrate
    ```

## Uso

Una vez completada la instalación, la aplicación Laravel estará disponible en tu navegador en [http://localhost](http://localhost) (o en el puerto que hayas configurado en `docker-compose.yml`).

### Comandos Útiles de Artisan

Puedes ejecutar cualquier comando de `artisan` a través de Docker Compose:

```bash
# Ver la lista de rutas
docker-compose exec app php artisan route:list

# Ejecutar los seeders de la base de datos
docker-compose exec app php artisan db:seed

# Entrar a Tinker
docker-compose exec app php artisan tinker
```

## Ejecución de Pruebas

Para ejecutar el conjunto de pruebas de PHPUnit, utiliza el siguiente comando:

```bash
docker-compose exec app php artisan test
```

## Construido Con

*   [Laravel](https://laravel.com/) - El framework de PHP.
*   [Docker](https://www.docker.com/) - Plataforma de contenedores.
*   [Nginx](https://www.nginx.com/) - Servidor web.
