CRUD con PHP y MySQL
Este proyecto implementa un sistema CRUD (Create, Read, Update, Delete) utilizando PHP como backend y MySQL como base de datos, con una interfaz frontend moderna construida con HTML, CSS, JavaScript y Bootstrap 5.
Estructura del Proyecto
CRUD-PAGINACION├── app/
│   ├── plantillas/
│   │   ├── formulario.php
│   │   └── principal.php
│   ├── AccesoDAO.php
│   ├── acciones.php
│   ├── Cliente.php
│   └── config.php
└── public/
    ├── default.css
    ├── script.js
    └── index.php
Requisitos Previos

PHP 7.4 o superior
MySQL 5.7 o superior
Servidor web (Apache/Nginx)
Navegador web moderno

Instalación

Clonar el repositorio:

bashCopygit clone [https://github.com/rebio2/crud]

Configurar la base de datos:

Crear una base de datos MySQL
Importar el archivo SQL proporcionado en la carpeta database/
Configurar las credenciales de la base de datos en app/config.php


Configurar el servidor web para que apunte a la carpeta public/ como directorio raíz

Estructura y Componentes
Backend (PHP)

app/AccesoDAO.php: Clase para el acceso y operaciones con la base de datos
app/Cliente.php: Modelo de datos para la entidad Cliente
app/config.php: Configuración de la aplicación y conexión a la base de datos
app/acciones.php: Controlador que maneja las operaciones CRUD

Frontend

public/index.php: Punto de entrada de la aplicación
public/default.css: Estilos CSS personalizados
public/script.js: Funcionalidades JavaScript
app/plantillas/: Contiene las vistas de la aplicación

Características

Operaciones CRUD completas
Interfaz responsiva con Bootstrap 5
Validación de datos en frontend y backend
Mensajes de feedback para el usuario
Diseño modular y mantenible

Tecnologías Utilizadas

Backend: PHP
Base de Datos: MySQL
Frontend:

HTML5
CSS3
JavaScript
Bootstrap 5



Seguridad

Implementación de prepared statements para prevenir SQL Injection
Validación y sanitización de datos de entrada
Manejo seguro de sesiones
Protección contra CSRF

Uso

Acceder a la aplicación a través del navegador
La página principal muestra el listado de registros
Utilizar los botones de acción para:

Crear nuevos registros
Ver detalles
Editar registros existentes
Eliminar registros



Contribución

Fork del repositorio
Crear una rama para tu característica (git checkout -b feature/AmazingFeature)
Commit de tus cambios (git commit -m 'Add some AmazingFeature')
Push a la rama (git push origin feature/AmazingFeature)
Abrir un Pull Request

Licencia
Este proyecto está bajo la Licencia MIT - ver el archivo LICENSE.md para más detalles.
Autor
[Tu Nombre]
Contacto

GitHub: [https://github.com/rebio2]