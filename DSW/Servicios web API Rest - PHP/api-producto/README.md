# 🛠️ API REST PHP – Producto (PUT & DELETE)

API REST desarrollada en **PHP + PostgreSQL** para gestionar la tabla `producto`.

Este proyecto implementa endpoints seguros utilizando:
- 🔄 Método PUT (actualizar producto)
- 🗑️ Método DELETE (eliminar producto)
- 🔐 Autenticación mediante Bearer Token
- 📦 Respuestas en JSON estructurado
- ⚡ Manejo correcto de códigos HTTP

---

## 🚀 Tecnologías Utilizadas

- PHP (PDO)
- PostgreSQL
- API REST
- JSON
- Postman
- Arquitectura modular básica

---

## 📁 Estructura del Proyecto

```
api-producto/
│
├── api/
│   └── producto.php
│
├── config/
│   └── database.php
│
├── middleware/
│   └── auth.php
│
└── README.md
```

---

## 🗄️ Base de Datos

### 📋 Tabla `producto`

| Campo           | Tipo     | Restricciones |
|-----------------|----------|---------------|
| id              | INT      | PK, NOT NULL  |
| nombre          | VARCHAR  | NOT NULL      |
| precio          | DECIMAL  | NOT NULL      |
| id_fabricante   | INT      | NOT NULL      |

### 📌 Script SQL

```sql
CREATE TABLE producto (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL NOT NULL,
    id_fabricante INT NOT NULL
);
```

---

## ⚙️ Configuración del Proyecto

### 1️⃣ Configurar la conexión a la base de datos

Editar el archivo:

```
config/database.php
```

Y colocar tus credenciales:

```php
private $host = "localhost";
private $db_name = "tu_base";
private $username = "tu_usuario";
private $password = "tu_password";
```

---

### 2️⃣ Colocar el proyecto en el servidor local

Ejemplo en entorno Linux:

```
/var/www/html/api-producto
```

Acceso desde navegador o Postman:

```
http://localhost/api/producto.php
```

---

## 🔐 Autenticación

La API requiere un header de autorización:

```http
Authorization: Bearer miclave123
```

Si el token no es válido, devuelve:

```json
{
  "error": "Token inválido"
}
```

Código HTTP: `401 Unauthorized`

---

# 🔄 Endpoint: PUT – Actualizar Producto

```
PUT /api/producto.php
```

### 📌 Headers

```http
Authorization: Bearer miclave123
Content-Type: application/x-www-form-urlencoded
```

### 📌 Body (x-www-form-urlencoded)

```txt
id=1
nombre=Nuevo Producto
precio=99.99
id_fabricante=2
```

### 📌 Respuestas posibles

| Código | Significado |
|--------|------------|
| 200    | Producto actualizado correctamente |
| 400    | Datos incompletos |
| 401    | Token inválido |
| 500    | Error interno del servidor |

### ✅ Respuesta exitosa

```json
{
  "mensaje": "Producto actualizado correctamente."
}
```

---

# 🗑️ Endpoint: DELETE – Eliminar Producto

```
DELETE /api/producto.php?id=1
```

### 📌 Header requerido

```http
Authorization: Bearer miclave123
```

### 📌 Respuestas posibles

| Código | Significado |
|--------|------------|
| 200    | Producto eliminado correctamente |
| 400    | ID no proporcionado |
| 401    | Token inválido |
| 500    | Error interno del servidor |

### ✅ Respuesta exitosa

```json
{
  "mensaje": "Producto eliminado correctamente."
}
```

---

# 🧪 Pruebas con Postman

### 🔄 PUT

1. Seleccionar método `PUT`
2. URL: `http://localhost/api/producto.php`
3. Agregar headers
4. Enviar body como `x-www-form-urlencoded`
5. Click en **Send**

---

### 🗑️ DELETE

1. Seleccionar método `DELETE`
2. URL: `http://localhost/api/producto.php?id=1`
3. Agregar header Authorization
4. Click en **Send**

---

# 🎯 Buenas Prácticas Implementadas

- ✔ Uso de prepared statements (PDO)
- ✔ Separación de responsabilidades (config, middleware, endpoint)
- ✔ Validación del método HTTP
- ✔ Uso correcto de códigos HTTP
- ✔ Respuestas JSON consistentes
- ✔ Manejo básico de autenticación

---

# 🔮 Mejoras Futuras

- Implementar JWT real
- Agregar métodos GET y POST
- Validación avanzada de datos
- Logs de auditoría
- Paginación
- Versionado de API

---

# 👨‍💻 Autor

Desarrollado por **Marco Gabriel Goitia Lazarte*  
Proyecto académico enfocado en prácticas profesionales y aprendizaje de arquitectura REST.