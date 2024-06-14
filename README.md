# Guía para instalar el proyecto en servidor local

## Requisitos
- Un servidor local que soporte PHP 8.x. Se recomienda [Laragon](https://laragon.org/).

## Pasos para la instalación

1. **Descargar o importar el proyecto**
   - Ubicar el proyecto en la carpeta correspondiente del servidor local (`www` / `htdocs`).

2. **Iniciar el servidor**

3. **Crear la base de datos**
   - Crear una base de datos (vía phpMyAdmin) con el nombre `rn_laravel_02`.

4. **Configurar las credenciales**
   - Actualizar las credenciales de la base de datos en el archivo `.env`.

5. **Correr las migraciones**
   - Abrir una consola y navegar hasta la carpeta del proyecto.
   - Ejecutar el siguiente comando para correr las migraciones:
     ```bash
     php artisan migrate
     ```

6. **Ejecutar los seeders**
   - Ejecutar los seeders para agregar datos de muestra a la base de datos:
     ```bash
     php artisan db:seed
     ```

7. **Abrir el proyecto en el navegador**
   - Abrir el navegador y acceder al proyecto utilizando la URL correspondiente a la configuración local (por ejemplo, `http://localhost/rn-laravel-02`).

## Credenciales de prueba
- **Usuario:** admin@admin.com
- **Contraseña:** admin




## API Endpoints

**Base URL:** http://localhost/rn-laravel-02/api/v1


* **GET /products**
    * Listado de productos.
* **GET /categories**
    * Listado de categorías.
* **GET /product-tags**
    * Listado de etiquetas de producto.