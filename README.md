# VINKA DESIGN PROJECT
Este es mi proyecto de fin de curso de desarrollo de aplicaciones web.
### Para ejecutar el proyecto:
Aplicaciones necesarias
``` 
- docker 
- docker-compose
- npm
``` 
Para ejecutar el proyecto
``` 
- docker-compose build
- docker-compose up -d
- docker-compose exec -u ${UID}:${GID} php composer install
- docker-compose exec -u ${UID}:${GID} php console doctrine:database:create
- docker-compose exec -u ${UID}:${GID} php console doctrine:migrations:migrate
- npm run build
```
Para acceder con el navegador 
``` 
- localhost:9000 o el puerto que se haya definido en el archivo .env
- para acceder al admin y dar de alta productos: localhost:9000/admin
``` 
