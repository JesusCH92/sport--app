# SPORT APP
Stack tecnológico: PHP8.3, Nginx, MariaDb y Docker.

El proyecto sigue una **arquitectura de cortes verticales**, donde cada módulo o contexto del dominio se organiza de forma independiente. Esto facilita la escalabilidad y el mantenimiento del código, asegurando que cada módulo sea autónomo y encapsule su propia lógica.

Cada módulo está dividido en tres capas principales:

- **ApplicationService**: Contiene los casos de uso que coordinan la lógica de aplicación y se encargan de interactuar con el dominio.
- **Domain**: Encierra las reglas de negocio y las entidades que representan el núcleo del sistema.
- **Infrastructure**: Maneja las dependencias externas, como bases de datos, bibliotecas externas o del propio framework, APIs externas, punto de entrada y salida(Comando, APIs, ControladorWeb), o cualquier detalle técnico.
```plaintext
  src/Player/
  ├── ApplicationService
  ├── Domain
  └── Infrastructure
  src/Team
  ├── ApplicationService
  ├── Domain
  └── Infrastructure
  src/Common
  ├── Domain
  └── Infrastructure
```

## Requisitos previos
> [!IMPORTANT]
> **Debes tener instalado Docker y Docker Compose en tu equipo.**

> [!WARNING]
> **Estamos usando el puerto 8080 para el servidor local, y tiene que estar disponible para levantar nuestro servicio de nginx.**
>
> **Estamos usando el puerto 3306 de mariadb y debe estar disponible, si tiene un servidor en mysql encendido apaguelo para levantar la app.**

## Desplegar en: MAC, Linux, WSL2

- [ ] Debes ejecutar:

```shell
make deploy
```

## Desplegar en: Windows

- [ ] Instalar la network de los contenedores en caso de no tenerla instalada antes:

```shell
docker network create app-network
```

- [ ] Levantar los contenedores:

```shell
docker-compose -p sport up -d
```

- [ ] Acceder al contenedor de PHP:

```shell
docker exec -it php-fpm bash 
```

- [ ] Despues de acceder al contenedor de PHP, debes ejecutar:

```bash
composer install
```

```bash
php vendor/bin/phinx migrate
```

## Acceso al sistema

- [ ] Después de desplegar el proyecto correctamente, debe acceder al siguiente enlace:

[**`proyecto web`**](http://localhost:8080)