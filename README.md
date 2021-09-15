### Starting local environment

#### Instal vendors
`composer install`
#### Build app
`docker-compose up --build`
#### Make doctrine migrations
`./docker/docker.sh bin/console doctrine:migrations:migrate`
#### App address
`http://0.0.0.0:8080`
#### DB address
`mysql://symfony:symfony@database:3306/symfony_docker`
#### PHPUnit tests
`./docker/docker.sh vendor/bin/phpunit`
