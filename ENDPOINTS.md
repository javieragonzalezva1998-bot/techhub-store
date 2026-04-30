# 📡 ENDPOINTS — TechHub Store

Este proyecto usa un **front controller** con enrutamiento por parámetros GET. Todas las rutas tienen la estructura base:

```
http://localhost/techhub-store/index.php?controller=<controlador>&action=<acción>
```

---

## 📌 Índice

- [🏠 Inicio](#-inicio)
- [🔐 Autenticación](#-autenticación-authcontroller)
- [🛍️ Productos (Catálogo público)](#️-productos-catálogo-público--productocontroller)
- [🛒 Carrito de Compras](#-carrito-de-compras--carritocontroller)
- [📦 Órdenes](#-órdenes--ordencontroller)
- [⚙️ Administración de Productos](#️-administración-de-productos--adminproductocontroller)

---

## 🏠 Inicio

| Método | URL | Descripción |
|--------|-----|-------------|
| `GET` | `http://localhost/techhub-store/` | Página principal — redirige al catálogo de productos |
| `GET` | `http://localhost/techhub-store/index.php` | Equivalente al anterior |

> Por defecto, el controlador es `producto` y la acción es `index`.

---

## 🔐 Autenticación — `AuthController`

| Método | URL | Acción | Descripción | Acceso |
|--------|-----|--------|-------------|--------|
| `GET` | `index.php?controller=auth&action=loginForm` | `loginForm` | Muestra el formulario de inicio de sesión | Público |
| `POST` | `index.php?controller=auth&action=login` | `login` | Procesa el login del usuario | Público |
| `GET` | `index.php?controller=auth&action=registerForm` | `registerForm` | Muestra el formulario de registro | Público |
| `POST` | `index.php?controller=auth&action=register` | `register` | Procesa el registro de un nuevo usuario | Público |
| `GET` | `index.php?controller=auth&action=logout` | `logout` | Cierra la sesión del usuario | Autenticado |

### 🔑 Parámetros del Login (`POST`)

```
email     → string  (requerido) — Ejemplo: admin@techhub.cl
password  → string  (requerido) — Ejemplo: 123456
```

### 🆕 Parámetros del Registro (`POST`)

```
nombre    → string  (requerido) — Nombre completo del usuario
email     → string  (requerido) — Correo electrónico válido
password  → string  (requerido) — Mínimo 6 caracteres
```

### 📤 Respuestas

| Caso | Resultado |
|------|-----------|
| Login exitoso | Redirige a `index.php` (inicio) y guarda sesión `$_SESSION["usuario"]` |
| Login fallido | Redirige al formulario con `$_SESSION["error"]` |
| Registro exitoso | Redirige al login con `$_SESSION["success"]` |
| Registro fallido | Redirige al formulario con `$_SESSION["error"]` |

---

## 🛍️ Productos (Catálogo público) — `ProductoController`

| Método | URL | Acción | Descripción | Acceso |
|--------|-----|--------|-------------|--------|
| `GET` | `index.php?controller=producto&action=index` | `index` | Lista todos los productos del catálogo | Público |
| `GET` | `index.php?controller=producto&action=show&id={id}` | `show` | Muestra el detalle de un producto | Público |
| `GET` | `index.php?controller=producto&action=buscarAjax&q={termino}` | `buscarAjax` | Búsqueda de productos (responde JSON) | Público |

### 🔍 Parámetros de búsqueda AJAX

```
q   → string  (opcional) — Término de búsqueda (nombre del producto)
```

### 📤 Respuesta JSON de `buscarAjax`

```json
[
  {
    "id": 1,
    "nombre": "Notebook Lenovo IdeaPad",
    "descripcion": "Notebook ideal para estudio...",
    "precio": "499990.00",
    "stock": 10,
    "categoria": "Notebooks",
    "imagen": "notebook-lenovo.jpg"
  }
]
```

---

## 🛒 Carrito de Compras — `CarritoController`

| Método | URL | Acción | Descripción | Acceso |
|--------|-----|--------|-------------|--------|
| `GET` | `index.php?controller=carrito&action=index` | `index` | Muestra el carrito de compras actual | Público |
| `GET` | `index.php?controller=carrito&action=agregar&id={id}` | `agregar` | Agrega un producto al carrito | Público |
| `GET` | `index.php?controller=carrito&action=agregar&id={id}&ajax=1` | `agregar` | Agrega un producto (respuesta JSON para AJAX) | Público |
| `GET` | `index.php?controller=carrito&action=eliminar&id={id}` | `eliminar` | Elimina un producto del carrito | Público |
| `GET` | `index.php?controller=carrito&action=vaciar` | `vaciar` | Vacía completamente el carrito | Público |
| `GET` | `index.php?controller=carrito&action=finalizar` | `finalizar` | Confirma la compra y genera una orden | Autenticado |

### 📤 Respuesta JSON de `agregar` con `ajax=1`

```json
{
  "success": true,
  "message": "Producto agregado al carrito",
  "totalCarrito": 3
}
```

> **Nota:** El carrito se almacena en la sesión (`$_SESSION["carrito"]`) como un array `[producto_id => cantidad]`.

---

## 📦 Órdenes — `OrdenController`

| Método | URL | Acción | Descripción | Acceso |
|--------|-----|--------|-------------|--------|
| `GET` | `index.php?controller=orden&action=historial` | `historial` | Muestra el historial de órdenes del usuario | Autenticado |

> Se requiere sesión activa. Si el usuario no está autenticado, redirige al login.

---

## ⚙️ Administración de Productos — `AdminProductoController`

> ⚠️ **Todos los endpoints de esta sección requieren rol `admin`.**
> Si un usuario sin permisos intenta acceder, es redirigido al login.

| Método | URL | Acción | Descripción |
|--------|-----|--------|-------------|
| `GET` | `index.php?controller=adminProducto&action=index` | `index` | Lista todos los productos (panel admin) |
| `GET` | `index.php?controller=adminProducto&action=create` | `create` | Muestra el formulario para crear un producto |
| `POST` | `index.php?controller=adminProducto&action=store` | `store` | Guarda un nuevo producto en la BD |
| `GET` | `index.php?controller=adminProducto&action=edit&id={id}` | `edit` | Muestra el formulario de edición de un producto |
| `POST` | `index.php?controller=adminProducto&action=update` | `update` | Actualiza los datos de un producto |
| `GET` | `index.php?controller=adminProducto&action=delete&id={id}` | `delete` | Elimina un producto del sistema |

### 🆕 Parámetros para crear/editar producto (`POST`)

```
nombre       → string   (requerido) — Nombre del producto
descripcion  → string   (requerido) — Descripción detallada
precio       → decimal  (requerido) — Precio en pesos chilenos (Ejemplo: 49990)
categoria    → string   (requerido) — Categoría (Notebooks, Accesorios, Tablets, Audio, Monitores, etc.)
stock        → int      (requerido) — Cantidad disponible en inventario
imagen       → file     (opcional)  — Archivo de imagen (JPG, PNG, GIF, WEBP)
```

> Para el endpoint `update`, también se requiere:
> ```
> id  → int  (requerido) — ID del producto a actualizar
> ```

### 🖼️ Subida de imágenes

- Formatos permitidos: `jpg`, `jpeg`, `png`, `gif`, `webp`
- Las imágenes se guardan en: `public/img/productos/`
- El nombre del archivo se genera automáticamente con `uniqid()` para evitar colisiones

---

## 🔒 Niveles de acceso

| Nivel | Descripción |
|-------|-------------|
| **Público** | Cualquier visitante puede acceder, sin necesidad de sesión |
| **Autenticado** | Requiere haber iniciado sesión (`$_SESSION["usuario"]` definido) |
| **Admin** | Requiere sesión activa con `rol === 'admin'` |

---

## 💬 Mensajes de sesión

El sistema utiliza variables de sesión para comunicar resultados entre redirecciones:

| Variable | Tipo | Uso |
|----------|------|-----|
| `$_SESSION["error"]` | `string` | Mensaje de error para mostrar en la vista |
| `$_SESSION["success"]` | `string` | Mensaje de éxito para mostrar en la vista |
| `$_SESSION["usuario"]` | `array` | Datos del usuario autenticado |

---

## 📝 Notas generales

- El proyecto **no usa `.htaccess`** para URLs limpias; todas las rutas pasan por `index.php`.
- No hay una API REST formal; los controladores devuelven vistas HTML, salvo los endpoints marcados como **JSON**.
- El carrito funciona completamente con **sesiones PHP** (no persiste en base de datos hasta que se finaliza la compra).
