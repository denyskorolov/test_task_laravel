## Run the application
Docker should be installed. To run the application run
```
docker-compose up --build -d
```
From the root directory of application. You will be able to go to the http://localhost:8080 to be sure that application successfully ran
## Migrations
```
docker exec backend php artisan migrate
```
FYI: I didn't clear default tables

## Jobs
To run job worker you should run the following command
```
docker exec backend php artisan queue:work --queue=log
```
I extracted submission handler job to separate queue "log"

## Query
To test application send POST request to http://localhost:8080/api/v1/submit with data 
```
{
      "name": "John Doe",
      "email": "john.doe@example.com",
      "message": "This is a test message."
}
```
This data should be handled and information about this should be stored to /storage/logs/submission.log
## Tests
To run tests just enter following command
```
docker exec backend php artisan test
```
