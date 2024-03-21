# Laravel Microservices Project

This project demonstrates the implementation of laravel microservices architecture using Docker containers. It consists of two microservices: Users Service and Notifications Service, along with RabbitMQ as the message broker.

## Services

### RabbitMQ

RabbitMQ is used as a message broker to facilitate communication between services via queues.

- **Image**: rabbitmq:3-management
- **Ports**: 
  - 5672:5672 (AMQP)
  - 15672:15672 (Management UI)
- **Health Check**: Performs a health check on RabbitMQ every 10 seconds, retrying up to 10 times.

### Users

Users servce is used to create user in log file & publish a queue in RabbitMQ.

### Notifications

Notifications service is used to listen to the queues in RabbitMQ, retrieve the data, and save it in a log file.

## Usage

1. Clone this repository.
2. Navigate to the project directory.
3. Run `sudo docker-compose up --build` to build and start the containers.
4. Monitor the logs and test results in the terminal.

#### Testing and Service Interaction

Upon starting the Docker containers using `sudo docker-compose up --build`, all necessary tests will automatically run, and the required commands for each service will be executed. You can monitor the test results and service output directly in the terminal.

- **Users Service**: 
  - To run tests: Log into the users-service container using `sudo docker exec -it [users-service-container-id] bash`, then run `php artisan test`.

- **Notifications Service**: 
  - To start processing RabbitMQ messages: Log into the notifications-service container using `sudo docker exec -it [notifications-service-container-id] bash`, then run `php artisan queue:work rabbitmq`.

