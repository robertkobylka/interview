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

### Endpoints
#### Send message
##### Endpoint
`[POST] /api/message/send`
##### Request
`{"content":"test content","sender":1,"recipients":[2,3,4]}`
#### Delete message
##### Endpoint
`[DELETE] /api/message/delete/{id}`
#### Send notification (New message notification)
##### Endpoint
`[POST] /api/notification/send`
##### Request Send notification (New message notification)
`{"title":"test title","description":"test description","recipient":1,"sender":2,"messageId":1}`
##### Request Send notification (System notification)
`{"title":"test title","description":"test description","recipient":1}`
#### Delete notification
##### Endpoint
`[DELETE] /api/notification/delete/{id}`
