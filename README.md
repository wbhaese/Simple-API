# simple-API

This is a simple API for Users data requests

Is based on endpoints and HTTP Requests methods.

Make sure run the Symfony Server and MySQL database on localhost. 

For this project, lets keep default configs to access de system: http://127.0.0.1:8000

*Some image examples at the end of the file using PostMan.

Below, a list of endpoints and what returns.

---------------------------------------------------
Return all users on system.

Endpoint: /users/ 

method: GET

---------------------------------------------------
This endpoint creates a new user. Required to send name, email and phone data on requests.

Endpoint: /users/ 

method: POST

---------------------------------------------------
To update an user, just send the Id and what data want to update, name, email or phone.

Endpoint: /users/{userId}

method: PUT or PATCH

---------------------------------------------------
This last option delete user by Id.

Endpoint: /users/{userId}

method: DELETE

---------------------------------------------------

*When an exception is thrown, it returns a message with the error, for example, if the data for 'name' is missing, the message will alert it.

Below some illustrating images using PostMan for this project:


GET request:

![GET](https://github.com/wbhaese/simple-API/blob/master/previews/GET.png)

POST request:

![POST](https://github.com/wbhaese/simple-API/blob/master/previews/POST.png)

POST request exception:

![POST](https://github.com/wbhaese/simple-API/blob/master/previews/POST-Exception.png)

PUT request:

![PUT](https://github.com/wbhaese/simple-API/blob/master/previews/PUT.png)

DELETE request:

![DELETE](https://github.com/wbhaese/simple-API/blob/master/previews/DELETE.png)







