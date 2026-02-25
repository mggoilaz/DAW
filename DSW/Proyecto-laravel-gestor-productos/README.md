# 🛒 Proyecto Laravel – GestorProductos

## 📌 Descripción

Proyecto desarrollado con el framework Laravel como primera toma de contacto con la arquitectura MVC (Modelo-Vista-Controlador).

La aplicación se conecta a la base de datos `tienda` y muestra el contenido de la tabla `producto` cuando el usuario accede a la URL principal.

---

## 🎯 Objetivos

- Comprender la arquitectura MVC.
- Crear y configurar un proyecto Laravel.
- Conectar Laravel con una base de datos PostgreSQL.
- Implementar rutas mediante `web.php`.
- Crear un controlador, un modelo y una vista.
- Mostrar datos dinámicos utilizando Blade.

---

## 🛠 Tecnologías utilizadas

- Laravel
- PHP
- PostgreSQL
- Composer
- Blade
- Servidor integrado de Laravel

---

## 🧱 Estructura MVC implementada

- **Modelo:** `ModeloProductos`  
  Asociado a la tabla `producto`.

- **Controlador:** `ControladorProductos`  
  Contiene la función `MuestraProductos()` que obtiene los datos y los envía a la vista.

- **Vista:** `VistaProductos`  
  Muestra el listado de productos utilizando directivas Blade.

---

## 🌐 Ruta principal

```php
Route::get('/', [ControladorProductos::class, 'MuestraProductos'])->name('Productos');
```

---

## ▶️ Ejecución del proyecto

Para iniciar el servidor de desarrollo:

```bash
php artisan serve
```

Acceder desde el navegador a:

```
http://localhost:8000
```

---

## 📈 Posible ampliación

- Mostrar un único producto mediante su identificador en la URL.
- Añadir más vistas.
- Implementar operaciones CRUD completas.

---