DROP DATABASE IF EXISTS techhub_store;
CREATE DATABASE techhub_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE techhub_store;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('cliente', 'admin') DEFAULT 'cliente',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    categoria VARCHAR(100) NOT NULL,
    imagen VARCHAR(255) DEFAULT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE carritos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL DEFAULT 1,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
);

CREATE TABLE ordenes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    estado ENUM('pendiente', 'pagada', 'cancelada') DEFAULT 'pagada',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE detalles_orden (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orden_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (orden_id) REFERENCES ordenes(id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
);

INSERT INTO usuarios (nombre, email, password, rol) VALUES
('Administrador', 'admin@techhub.cl', '$2y$10$wH2Nj0vTn3ly0O30G3cZiebiRzUEkGBQpJnYimRFXTntSJOr7qyCi', 'admin'),
('Cliente Demo', 'cliente@techhub.cl', '$2y$10$wH2Nj0vTn3ly0O30G3cZiebiRzUEkGBQpJnYimRFXTntSJOr7qyCi', 'cliente');

INSERT INTO productos (nombre, descripcion, precio, stock, categoria, imagen) VALUES
('Notebook Lenovo IdeaPad', 'Notebook ideal para estudio y trabajo con buen rendimiento.', 499990, 10, 'Notebooks', 'notebook-lenovo.jpg'),
('Mouse Logitech M185', 'Mouse inalámbrico compacto y cómodo.', 9990, 30, 'Accesorios', 'mouse-logitech.jpg'),
('Teclado Mecánico Redragon', 'Teclado mecánico gamer con iluminación RGB.', 34990, 15, 'Accesorios', 'teclado-redragon.jpg'),
('Tablet Samsung Galaxy Tab', 'Tablet liviana para clases, streaming y navegación.', 189990, 12, 'Tablets', 'tablet-samsung.jpg'),
('Audífonos Bluetooth JBL', 'Audífonos inalámbricos con buena autonomía.', 29990, 20, 'Audio', 'audifonos-jbl.jpg'),
('Monitor LG 24 pulgadas', 'Monitor Full HD para oficina, estudio o gaming casual.', 119990, 8, 'Monitores', 'monitor-lg.jpg');