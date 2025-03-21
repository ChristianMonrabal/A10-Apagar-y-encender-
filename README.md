# JIRA J23

## Descripción del Proyecto

El sistema que se va a desarrollar es una plataforma centralizada para gestionar las incidencias informáticas registradas por el personal de una multinacional con varias sedes en Barcelona, Berlín y Montreal. El objetivo es permitir que cada sede registre incidencias de manera eficiente y que los equipos correspondientes resuelvan los problemas de manera organizada.

## Características Principales

### Página Pública
- La aplicación contará con una página pública que incluye un formulario de login.
- El diseño será **responsive**, adaptándose tanto a computadoras de escritorio como a dispositivos móviles.
- El login validará al usuario tanto en el cliente (local) como en el servidor para garantizar que solo los usuarios registrados puedan acceder.

### Roles de Usuario
La aplicación tendrá los siguientes roles con características y permisos específicos:

1. **Administrador**
   - Registrar nuevos usuarios (con roles y sede).
   - Dar de baja a usuarios cuando finalicen su contrato.
   - Crear nuevos tipos de incidencias.
   - Filtrar usuarios por sede y rol.
   - Recibir notificaciones de nuevos empleados y bajas por parte de RRHH.

2. **Cliente (Personal de la empresa)**
   - Registrar incidencias de su sede.
   - Las incidencias se crean con el estado "Sin asignar".
   - Filtrar incidencias por estado y ordenarlas por fecha.
   - Ver detalles de sus incidencias.
   - **Opcional**: Enviar y recibir mensajes del técnico asignado a la incidencia.
   - **Opcional**: Subir una foto para ayudar al diagnóstico del técnico.

3. **Gestor de Equipo**
   - Asignar incidencias a los técnicos de su sede.
   - Establecer prioridades para las incidencias.
   - Ver las incidencias asignadas a cada técnico y ordenarlas por prioridad o fecha.
   - Ver detalles completos de cada incidencia.
   - **Opcional**: Indicar comentarios sobre la incidencia.

4. **Técnico de Mantenimiento**
   - Recibir incidencias asignadas por el gestor de equipo.
   - Cambiar el estado de la incidencia a "En trabajo" al comenzar a trabajar en ella.
   - Cambiar el estado de la incidencia a "Resuelta" cuando haya finalizado el trabajo.
   - **Opcional**: Enviar mensajes al cliente solicitando más información.

### Incidencias
Las incidencias tendrán los siguientes campos:
- **Cliente**: Persona que informa la incidencia.
- **Técnico**: Persona asignada para resolver la incidencia.
- **Fechas**: Fecha en que se informa la incidencia y fecha en que se resuelve.

#### Estados de las Incidencias
- **Sin asignar**: Estado por defecto cuando un cliente crea una incidencia.
- **Asignada**: Estado cuando el gestor asigna la incidencia a un técnico.
- **En trabajo**: Estado cuando el técnico comienza a trabajar en la incidencia.
- **Resuelta**: Estado cuando el técnico finaliza la incidencia.
- **Tancada**: Estado cuando el cliente verifica que la incidencia está resuelta.

#### Categorías y Subcategorías
Las incidencias estarán asociadas a categorías y subcategorías, por ejemplo:

- **Software**
  - Aplicación de gestión administrativa.
  - Aplicación de videoconferencias.
  - Problema con el acceso remoto.
  
- **Hardware**
  - Problema con el teclado.
  - El ratón no funciona.
  - El monitor no se enciende.

#### Prioridades
El **gestor de equipo** asignará una prioridad a cada incidencia: **alta**, **media** o **baja**, según la gravedad del problema.

#### Comentarios
Los **clientes** podrán dejar comentarios para ayudar al técnico a diagnosticar mejor el problema. Además, los **técnicos** podrán responder a los comentarios solicitando más información.

### Requisitos del Sistema
El sistema debe ser accesible tanto desde computadoras como dispositivos móviles, por lo que el layout debe ser **responsive**.

## Funcionalidades Opcionales
- Enviar y recibir mensajes entre clientes y técnicos.
- Subir imágenes para ayudar al diagnóstico de las incidencias.
- Comentarios en formato de cadena de comentarios entre cliente y técnico.
