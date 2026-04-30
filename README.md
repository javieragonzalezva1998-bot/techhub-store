# 🛒 TechHub Store

Tienda de tecnología desarrollada en **PHP puro** con arquitectura MVC, sin frameworks externos. Permite a los usuarios explorar productos, gestionar un carrito de compras y realizar pedidos, con un panel de administración para gestionar el inventario.

---

## 📋 Requisitos del sistema

Asegúrate de tener instalado lo siguiente antes de comenzar:

| Herramienta | Versión mínima |
|-------------|----------------|
| XAMPP (o similar) | 8.x |
| PHP | 8.0+ |
| MySQL / MariaDB | 5.7+ / 10.4+ |
| Apache | 2.4+ |

> **Nota:** Este proyecto está diseñado para correr con **XAMPP** en local. También puede usarse con WAMP, Laragon u otro stack LAMP/WAMP.

---

## 🚀 Instalación paso a paso

### 1. Clonar o copiar el proyecto

Coloca la carpeta del proyecto dentro del directorio `htdocs` de XAMPP:

```
C:\xampp\htdocs\techhub-store\
```

Si estás usando Git:

```bash
git clone https://github.com/javieragonzalezva1998-bot/techhub-store C:\xampp\htdocs\techhub-store
```

---

### 2. Iniciar los servicios de XAMPP

1. Abre el **Panel de Control de XAMPP**.
2. Inicia los servicios de **Apache** y **MySQL**.

---

### 3. Importar la base de datos

#### Opción A — Desde phpMyAdmin (recomendado)

1. Abre tu navegador y visita: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Haz clic en **"Importar"** en la barra superior.
3. Haz clic en **"Seleccionar archivo"** y navega hasta:
   ```
   C:\xampp\htdocs\techhub-store\sql\database.sql
   ```
4. Haz clic en **"Continuar"** / **"Importar"**.

Esto creará automáticamente la base de datos `techhub_store` con todas sus tablas y datos de ejemplo.

#### Opción B — Desde la línea de comandos

Abre una terminal y ejecuta:

```bash
mysql -u root -p < C:\xampp\htdocs\techhub-store\sql\database.sql
```

> Deja la contraseña en blanco si usas XAMPP por defecto (solo presiona Enter).

---

### 4. Configurar la conexión a la base de datos

El archivo de configuración se encuentra en:

```
config/database.php
```

Los valores por defecto para XAMPP son:

```php
private $host     = "localhost";
private $user     = "root";
private $password = "";          // XAMPP no tiene contraseña por defecto
private $database = "techhub_store";
```

> Si tu MySQL tiene una contraseña diferente, edita el campo `$password` en este archivo.

---

### 5. Acceder al proyecto

Abre tu navegador y visita:

```
http://localhost/techhub-store/
```

---

## 👤 Usuarios de prueba

La base de datos incluye dos usuarios predefinidos para pruebas:

| Rol | Email | Contraseña |
|-----|-------|------------|
| 🔑 Administrador | `admin@techhub.cl` | `123456` |
| 👤 Cliente | `cliente@techhub.cl` | `123456` |

---

## 🗂️ Estructura del proyecto

```
techhub-store/
├── app/
│   ├── controllers/
│   │   ├── AdminProductoController.php   # CRUD de productos (admin)
│   │   ├── AuthController.php            # Login, registro y logout
│   │   ├── CarritoController.php         # Gestión del carrito
│   │   ├── OrdenController.php           # Historial de órdenes
│   │   └── ProductoController.php        # Catálogo público
│   ├── models/
│   │   ├── Carrito.php
│   │   ├── Orden.php
│   │   ├── Producto.php
│   │   └── Usuario.php
│   └── views/
│       ├── admin/
│       ├── auth/
│       ├── carrito/
│       ├── orden/
│       └── productos/
├── config/
│   └── database.php        # Configuración de la conexión MySQL
├── public/
│   └── img/
│       └── productos/      # Imágenes subidas por el admin
├── sql/
│   └── database.sql        # Script SQL para crear la base de datos
└── index.php               # Punto de entrada (front controller)
```

---

## 🗄️ Base de datos

La base de datos se llama `techhub_store` y contiene las siguientes tablas:

| Tabla | Descripción |
|-------|-------------|
| `usuarios` | Usuarios registrados (clientes y admins) |
| `productos` | Catálogo de productos de la tienda |
| `carritos` | Ítems guardados en el carrito por usuario |
| `ordenes` | Órdenes de compra generadas |
| `detalles_orden` | Detalle de cada producto por orden |

---

## ⚙️ Cómo funciona el enrutamiento

El proyecto usa un **front controller** (`index.php`) con parámetros GET:

```
http://localhost/techhub-store/index.php?controller=<controlador>&action=<acción>
```

**Ejemplo:**

```
http://localhost/techhub-store/index.php?controller=auth&action=loginForm
```

Consulta el archivo [ENDPOINTS.md](./ENDPOINTS.md) para ver todas las rutas disponibles.

---

## 🖼️ Imágenes de productos

Las imágenes subidas por el administrador se guardan en:

```
public/img/productos/
```

Los formatos permitidos son: `.jpg`, `.jpeg`, `.png`, `.gif`, `.webp`.

---

## 🐛 Solución de problemas comunes

| Problema | Solución |
|----------|----------|
| Error de conexión a la DB | Verifica que MySQL esté iniciado en XAMPP y que `config/database.php` tenga los datos correctos |
| Página en blanco | Activa `display_errors` en `index.php` (ya viene activado en desarrollo) |
| Error 404 al acceder | Asegúrate de que Apache esté corriendo y la carpeta esté en `htdocs` |
| No se suben imágenes | Verifica que la carpeta `public/img/productos/` tenga permisos de escritura |

---

## 📄 Licencia

Este proyecto fue desarrollado con fines educativos.
