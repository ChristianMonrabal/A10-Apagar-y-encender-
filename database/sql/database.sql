CREATE DATABASE IF NOT EXISTS JIRA_J23 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE JIRA_J23;

-- Tabla Sede
CREATE TABLE sede (
    id_sede INT AUTO_INCREMENT PRIMARY KEY,
    nombre_sede VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Tabla Rol
CREATE TABLE rol (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Tabla Usuario
CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL,
    email_usuario VARCHAR(50) UNIQUE NOT NULL,
    password_hash_usuario VARCHAR(255) NOT NULL,
    id_sede_usuario INT NOT NULL,
    id_rol_usuario INT NOT NULL,
    activo_usuario BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_sede_usuario) REFERENCES sede(id_sede),
    FOREIGN KEY (id_rol_usuario) REFERENCES rol(id_rol)
) ENGINE=InnoDB;

-- Tabla Categoria
CREATE TABLE categoria (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Tabla Subcategoria
CREATE TABLE subcategoria (
    id_subcategoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_subcategoria VARCHAR(50) NOT NULL,
    id_categoria_subcategoria INT NOT NULL,
    FOREIGN KEY (id_categoria_subcategoria) REFERENCES categoria(id_categoria)
) ENGINE=InnoDB;

-- Tabla Estado
CREATE TABLE estado (
    id_estado INT AUTO_INCREMENT PRIMARY KEY,
    nombre_estado VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Tabla Prioridad
CREATE TABLE prioridad (
    id_prioridad INT AUTO_INCREMENT PRIMARY KEY,
    nivel_prioridad VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Tabla Incidencia
CREATE TABLE incidencia (
    id_incidencia INT AUTO_INCREMENT PRIMARY KEY,
    titulo_incidencia VARCHAR(50) NOT NULL,
    id_cliente_incidencia INT NOT NULL,
    id_tecnico_incidencia INT DEFAULT NULL,
    id_gestor_incidencia INT DEFAULT NULL,
    id_sede_incidencia INT NOT NULL,
    id_categoria_incidencia INT NOT NULL,
    id_subcategoria_incidencia INT NOT NULL,
    descripcion_incidencia TEXT NOT NULL,
    id_estado_incidencia INT NOT NULL,
    id_prioridad_incidencia INT DEFAULT NULL,
    fecha_creacion_incidencia TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_resolucion_incidencia TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (id_cliente_incidencia) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_tecnico_incidencia) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_gestor_incidencia) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_sede_incidencia) REFERENCES sede(id_sede),
    FOREIGN KEY (id_categoria_incidencia) REFERENCES categoria(id_categoria),
    FOREIGN KEY (id_subcategoria_incidencia) REFERENCES subcategoria(id_subcategoria),
    FOREIGN KEY (id_estado_incidencia) REFERENCES estado(id_estado),
    FOREIGN KEY (id_prioridad_incidencia) REFERENCES prioridad(id_prioridad)
) ENGINE=InnoDB;

-- Tabla Comentario
CREATE TABLE comentario (
    id_comentario INT AUTO_INCREMENT PRIMARY KEY,
    id_incidencia_comentario INT NOT NULL,
    id_usuario_comentario INT NOT NULL,
    texto_comentario TEXT NOT NULL,
    fecha_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_incidencia_comentario) REFERENCES incidencia(id_incidencia),
    FOREIGN KEY (id_usuario_comentario) REFERENCES usuario(id_usuario)
) ENGINE=InnoDB;

-- Tabla Imagen
CREATE TABLE imagen (
    id_imagen INT AUTO_INCREMENT PRIMARY KEY,
    id_incidencia_imagen INT NOT NULL,
    ruta_imagen VARCHAR(200) NOT NULL,
    fecha_subida_imagen TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_incidencia_imagen) REFERENCES incidencia(id_incidencia)
) ENGINE=InnoDB;
