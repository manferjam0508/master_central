# Máster Central - Gestión de Reservas de Laboratorios

Sistema web desarrollado en **Laravel 11 + PHP 8.4 + PostgreSQL** para la gestión de reservas de laboratorios de la Universidad Central.

## Tecnologías utilizadas

- Laravel 11
- PHP 8.4
- PostgreSQL
- Bootstrap 5 (CDN)
- Blade (motor de plantillas)

## Modelo de base de datos

El diseño relacional incluye 4 tablas principales:

- **laboratories**: Laboratorios (fotografía, video, sonido) con capacidad
- **user_types**: Tipos de usuario (Estudiante, Docente, Administrativo)
- **dependencies**: Dependencias o programas académicos
- **reservations**: Reservas con fechas, horarios y observaciones

Diagrama ER incluido en el repositorio.

## Funcionalidades implementadas

| Funcionalidad | Descripción |
|---------------|-------------|
| Crear reserva | Formulario con validación de campos obligatorios |
| Ver reservas | Lista con filtros por nombre, laboratorio y fecha |
| Editar reserva | Modificación completa de datos |
| Eliminar reserva | Eliminación con confirmación |
| Validación de solapamiento | Evita reservas cruzadas en el mismo laboratorio |
| Paginación | 5 reservas por página |

## Instalación y configuración

### Requisitos previos
- PHP 8.2 o superior
- Composer
- PostgreSQL
- Laravel Herd (o servidor local equivalente)

### Pasos de instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/manferjam0508/master_central.git
   cd master_central

   # Máster Central - Gestión de Reservas de Laboratorios

Sistema web desarrollado en **Laravel 11 + PHP 8.4 + PostgreSQL** para la gestión de reservas de laboratorios de la Universidad Máster Central.

2. **Instalar las dependencias**
   ```bash
   composer install

3. **Configurar las variables del entorno **
   ```bash
   copy .env.example .env
   
   Editar .env con los datos de conexión de PostgreSQL
   
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=db_mastercent
   DB_USERNAME=postgres
   DB_PASSWORD=Tempestad26*
   

4. **Generar la clave de apliación**
   ```bash
   php artisan key:generate   

5. **Crear base de datos en PostgreSQL**
   ```sql
   CREATE DATABASE db_mastercent; 

6. **Ejecutar migraciones y seeders**
   ```bash
   php artisan migrate --seed


7. **Iniciar Servidor**
   ```bash
   php artisan serve


8. **Acceder a la aplicación**
   ```plain
   http://localhost:8000

### Datos de prueba para realizar el seeder

Las migraciones incluyen datos iniciales:

| Laboratorio | Capacidad |
|---------------|-------------|
| Lab Fotografia | 20 |
| Lab Video | 30 |
| Lab Sonido | 25 |

| Tipos de Usuario |
|---------------|
| Estudiante | 
| Docente |
| Administrativo | 

| Dependencias |
|---------------|
| Ingenieria de Sistemas | 
| Diseño Grafico |
| Comunicacion Social | 
| Musica |
| Cine y Television | 

### Estructura del proyecto

 ```plain
  master_central/
├── app/
│   ├── Http/Controllers/ReservationController.php
│   └── Models/ (Laboratory, UserType, Dependency, Reservation)
├── database/
│   ├── migrations/ (4 tablas + migraciones base Laravel)
│   └── seeders/DatabaseSeeder.php
├── resources/views/reservas/ (index, create, edit, layouts)
└── routes/web.php
 ```
 

### Licencia educativa con motivo de presentación de prueba técnica ###









  
   
  
