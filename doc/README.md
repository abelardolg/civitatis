# Aplicación CIVITATIS

## Requisitos de software

* ### Docker y Docker-compose
* ### Make (para makefiles)

## Ejecución de la aplicación

* ### Entrarmos en el directorio raíz de este proyecto.
* ### Ejecutamos 'make build'.
* ### Ejecutamos 'make run'.

## Arquitectura de la aplicación

* ### Un contenedor para MYSQL - 8.0
* ### Un contenedor para PHP (donde está la aplicación Symfony)
* ### Un contenedor para NGINX

## Docker en la aplicación

* ### En la carpeta 'docker' se encuentran los ficheros de configuración de los dos contenedores (PHP y NGINX)

## Migraciones para MYSQL

### Entramos en el contenedor de PHP siguiendo estos pasos:

### 1. 'make build'

### 2. 'make run'

### 3. 'make ssh-be'

### 4. Una vez que se ejecuta el comando anterior, ya nos encontramos en el directorio de nuestra aplicación Symfony.

### Debemos ejecutar los siguientes comandos para recrear la estructura en nuestra base de datos:

### 5. 'bin/console d:m:g'

### 6. 'bin/console d:m:m -n'

## Ejecutar la aplicación

### Tras los pasos anteriores no debería haber ningún error. En este caso, abrimos nuestro navegador y escribimos:

### 'http://localhost:300'





