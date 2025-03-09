CREATE DATABASE IF NOT EXISTS jira_j23 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE jira_j23;

-- Tabla sedes
CREATE TABLE sedes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

-- Tabla roles
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

-- Tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    sede_id INT NOT NULL,
    rol_id INT NOT NULL,
    activo TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (sede_id) REFERENCES sedes(id),
    FOREIGN KEY (rol_id) REFERENCES roles(id)
) ENGINE=InnoDB;

-- Tabla categorias
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

-- Tabla subcategorias
CREATE TABLE subcategorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    categoria_id INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
) ENGINE=InnoDB;

-- Tabla estados
CREATE TABLE estados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

-- Tabla prioridades
CREATE TABLE prioridades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nivel VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

-- Tabla incidencias
CREATE TABLE incidencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(50) NOT NULL,
    cliente_id INT NOT NULL,
    tecnico_id INT DEFAULT NULL,
    gestor_id INT DEFAULT NULL,
    sede_id INT NOT NULL,
    categoria_id INT NOT NULL,
    subcategoria_id INT NOT NULL,
    descripcion TEXT NOT NULL,
    estado_id INT NOT NULL,
    prioridad_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL,
    fecha_resolucion TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (cliente_id) REFERENCES usuarios(id),
    FOREIGN KEY (tecnico_id) REFERENCES usuarios(id),
    FOREIGN KEY (gestor_id) REFERENCES usuarios(id),
    FOREIGN KEY (sede_id) REFERENCES sedes(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id),
    FOREIGN KEY (subcategoria_id) REFERENCES subcategorias(id),
    FOREIGN KEY (estado_id) REFERENCES estados(id),
    FOREIGN KEY (prioridad_id) REFERENCES prioridades(id)
) ENGINE=InnoDB;

-- Tabla comentarios
CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    incidencia_id INT NOT NULL,
    usuario_id INT NOT NULL,
    texto TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (incidencia_id) REFERENCES incidencias(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB;

-- Tabla imagenes
CREATE TABLE imagenes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    incidencia_id INT NOT NULL,
    ruta VARCHAR(200) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (incidencia_id) REFERENCES incidencias(id)
) ENGINE=InnoDB;


-- INSERTS SQL
SELECT * FROM jira_j23.roles;
SELECT * FROM jira_j23.sedes;
SELECT * FROM jira_j23.usuarios;


USE jira_j23;
INSERT INTO roles (nombre, created_at, updated_at) VALUES
('administrador', NOW(), NOW()),
('cliente', NOW(), NOW()),
('gestor', NOW(), NOW()),
('técnico', NOW(), NOW());

INSERT INTO sedes (id, nombre, created_at, updated_at) VALUES
    (1, 'Barcelona', NOW(), NOW()),
    (2, 'Berlín', NOW(), NOW()),
    (3, 'Montreal', NOW(), NOW());

INSERT INTO usuarios (nombre, email, password, sede_id, rol_id, activo, created_at, updated_at) 
VALUES 
    ('Juan Pérez', 'juan@empresa.com', '$2y$10$GKcxpoZSFHvaNczs1N0INeJUm.KBnasdtfTO8DtQzvRJM3CSRvxeS', 1, 1, 1, NOW(), NOW()), -- Administrador
    ('Ana Gómez', 'ana@empresa.com', '$2y$10$GKcxpoZSFHvaNczs1N0INeJUm.KBnasdtfTO8DtQzvRJM3CSRvxeS', 2, 2, 1, NOW(), NOW()), -- Cliente
    ('Carlos López', 'carlos@empresa.com', '$2y$10$GKcxpoZSFHvaNczs1N0INeJUm.KBnasdtfTO8DtQzvRJM3CSRvxeS', 3, 3, 1, NOW(), NOW()), -- Gestor
    ('Elena Ruiz', 'elena@empresa.com', '$2y$10$GKcxpoZSFHvaNczs1N0INeJUm.KBnasdtfTO8DtQzvRJM3CSRvxeS', 3, 4, 1, NOW(), NOW()); -- Técnico