<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Tennis Tournament Laravel

## Descripción

El proyecto **Tennis Tournament Laravel** es una aplicación backend desarrollada en Laravel que gestiona torneos de tenis. Permite la creación de torneos, la inscripción de jugadores, y la simulación de partidas para determinar un ganador en cada torneo.

## Requisitos del Sistema

- PHP >= 8.0
- Composer
- MySQL
- Laravel >= 9.0

## Instalación

Sigue estos pasos para instalar y configurar el proyecto:

1. Clona el repositorio:

   ```bash
   git clone https://github.com/tu-usuario/tennis-tournament-laravel.git
   ```

2. Ingresa al proyecto:

   ```bash
   cd tennis-tournament-laravel
   ```

3. Instala las dependencias:

   ```bash
   composer install
   ```

4. Copia el archivo **.env.example** a **.env** y configura tus variables de entorno, especialmente las relacionadas con la base de datos:

   ```bash
   cp .env.example .env
   ```

5. Genera la clave de la aplicación:

   ```bash
   php artisan key:generate
   ```

6. Migra la base de datos y ejecuta los seeders si existen:

   ```bash
   php artisan migrate --seed
   ```

7. Inicia el servidor de desarrollo:

   ```bash
   php artisan serve
   ```

# Uso

## Endpoints

La API ofrece los siguientes endpoints:

<ul>
  <li><h3>Crear Torneo</h3></li>
  <ul>
      <li><b>Ruta:</b> POST <i>api/torneos</i></li>
      <li><b>Descripción:</b> Crea un nuevo torneo y registra a los jugadores.</li>
      <li><b>Cuerpo de la petición:</b></li>
  </ul>
</ul>

   ```json
    {
        "nombre": "Nombre del Torneo",
        "genero": "Masculino/Femenino",
        "jugadores": [
            {
                "nombre": "Jugador 1",
                "habilidad": 80,
                "fuerza": 70,
                "velocidad": 60,
                "tiempo_reaccion": 50,
                "genero": "Masculino"
            }
        ]
    }
   ```  

<ul>
  <li><h3>Listar Torneos</h3></li>
  <ul>
      <li><b>Ruta:</b> GET <i>api/torneos</i></li>
      <li><b>Descripción:</b> Obtiene la lista de torneos creados.</li>
  </ul>
</ul>

<ul>
  <li><h3>Ver Torneo</h3></li>
  <ul>
      <li><b>Ruta:</b> GET <i>api/torneos/{id}</i></li>
      <li><b>Descripción:</b> Obtiene los detalles de un torneo específico por su ID.</li>
  </ul>
</ul>

## Modelo de Objetos

El modelo de objetos sigue una estructura básica:

<ul>
  <li><b>Torneo: </b> Representa un torneo de tenis y tiene una relación de uno a muchos con <b>Jugador.</b></li>
  <li><b>Jugador: </b> Representa un jugador que participa en un torneo.</li>
</ul>

Las relaciones se definen como sigue:

<ul>
  <li><b>Torneo: </b> tiene muchos <b>Jugador.</b></li>
  <li><b>Jugador: </b> pertenece a <b>Torneo</b></li>
</ul>

## Pruebas

Las pruebas se realizan utilizando PHPUnit. Se han desarrollado pruebas para verificar la creación de torneos, la inscripción de jugadores y la determinación del ganador.

Para ejecutar las pruebas, utiliza el siguiente comando:

   ```bash
   php artisan test
   ```

## Estilo de Código

El proyecto sigue el estilo de código de PSR-12 y las mejores prácticas recomendadas por la comunidad Laravel.

## Arquitectura

El proyecto sigue una arquitectura MVC (Model-View-Controller) típica de Laravel:

<ul>
  <li><b>Models: </b> Definición de las entidades y sus relaciones.</li>
  <li><b>Controllers: </b> Gestión de la lógica de negocio y las operaciones CRUD.</li>
  <li><b>Routes: </b> Definición de los endpoints de la API.</li>
</ul>

## Conocimiento Funcional

El sistema permite gestionar torneos de tenis, registrando jugadores y simulando partidos para determinar un ganador según sus habilidades. Asimismo soporta torneos masculinos y femeninos, ajustando las reglas del juego según el género del torneo.

## Notas Adicionales

- **Uso de Postman:** He utilizado Postman para probar los servicios RESTful implementados. En la carpeta raíz del proyecto, encontrarás un archivo exportado con los endpoints utilizados durante el desarrollo. Puedes [importar este archivo en Postman](tests/Postman/tennis-tournament-laravel.postman_collection.json) para tener acceso rápido a las rutas implementadas.

- Archivo Postman: [tests/Postman/Proyecto tennis-tournament-laravel.postman_collection.json](tests/Postman/tennis-tournament-laravel.postman_collection.json)

## Estructura Técnica del Proyecto

Este proyecto sigue una estructura organizada y utiliza varias técnicas y patrones para garantizar su mantenibilidad y escalabilidad. A continuación, se describen algunos aspectos técnicos clave:

### API y Controlador

La lógica de la aplicación se organiza a través de una API RESTful implementada en Laravel. Los controladores son responsables de manejar las solicitudes HTTP y gestionar la lógica correspondiente. En particular, se hace un uso extensivo de form requests personalizados para validar y formatear las solicitudes de manera coherente. Además, se definen reglas específicas en estos form requests para garantizar la integridad de los datos. 

En algunos casos, se utilizan form requests personalizados para controlar la validación de las solicitudes de manera más específica. Además, en determinados escenarios, se implementan respuestas personalizadas para ajustar el formato de las respuestas de la API según los requisitos.

Esta estructura técnica busca promover la reutilización del código, la legibilidad y la escalabilidad del proyecto, siguiendo las mejores prácticas de desarrollo en Laravel.

<hr>

- [Linkedin Autor](https://linkedin.com/in/mariano-de-greef).  

- [Email Autor](mailto:degreefmariano@gmail.com).
