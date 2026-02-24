# 🛠️ API REST PHP – Producto (PUT & DELETE)

API REST desarrollada en **PHP + PostgreSQL** para gestionar la tabla `producto`.

Incluye:

- 🔄 PUT → Actualizar producto
- 🗑️ DELETE → Eliminar producto
- 🔐 Autenticación mediante Bearer Token
- 📦 Respuestas en JSON estructurado

---

## 🗄️ Estructura de la Base de Datos

### 📋 Tabla `producto`

| Campo           | Tipo     | Restricciones |
|-----------------|----------|---------------|
| id              | INT      | PK, NOT NULL  |
| nombre          | VARCHAR  | NOT NULL      |
| precio          | DECIMAL  | NOT NULL      |
| id_fabricante   | INT      | NOT NULL      |

> ⚠️ Todos los campos son obligatorios en el método PUT.

---

# 🔄 Endpoint: PUT /api/producto.php

Actualiza un producto por su `id`.

## 📌 Headers


```http

Authorization: Bearer <token>
Content-Type: application/x-www-form-urlencoded