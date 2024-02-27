## Setup

### Pre-requisites
- This project uses Docker and Docker Compose to build local services. These need to be installed and running.
- A Makefile has been added to the project to make setup easier.

### Installation 
To run the project you can simply run `make start`.
Once the containers are running, run `make composer c='install'` to install dependencies. 

If you are not able to use make, you can run `docker compose build --pull --no-cache` followed by `docker compose up -d`.
You must then connect to the PHP container using `docker exec -ti #container sh` then run composer manually. 

To stop the project run `make down`.

### Useage
- The site can be accessed locally at `localhost:9000`.
- The MYSQL DB is exposed on port `9906`. 
  - You can connect to this using the credentials found within `docker-compose.yaml`

### Enhancements
There are a number of things that I would change before releasing this to a production environment:
  - Backend:
    - CSRF Tokens.
    - CORS Policy.
    - Input validation.
    - Handle unique constraint violations.
    - Use of UUID instead of int ID columns.
    - Firewall/Access Control.
    - Request object instead of passing $vars to controllers.
    - ENV vars.
    - Unit Tests/PHPCS
  - Frontend:
    - Prevent XSS.
    - Handle errors gracefully.
    - NPM.
    - Compile css and JS to public/assets instead.

---------

#### Brief
Build a simple list contact management web application.

#### Technical requirements
- Built using PHP with a MySQL database.
- Using vanilla PHP and JS and following modern PHP coding practices.
- No PHP frameworks allowed. 
- A CSS framework such as Tailwind or Bootstrap is acceptable for the front-end.
- Provide instructions on how to set up and run the application locally.
- Upload the application to a GitHub repository. Send us the URL if it is a public repo or share it with @jonathanbull, @bscutt and @rhel-eo.

#### Business requirements
The business has a database containing list contacts that are stored in a table with the schema:
```mysql
    CREATE TABLE list_contact (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email_address VARCHAR(254) NOT NULL UNIQUE,
        name VARCHAR(200) NOT NULL,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    );
```
##### Functionality
- View a list of email addresses in the mailing list. Ordered by most recent.
- Add a new email address to the list, without reloading the page.
- Delete an email address from the list, without reloading the page.

If appropriate, you can modify the schema to implement these features.
- No authentication or pagination needed.
- If there are security features that would take a lot of work without a framework, you can document that 
  you would have built these in a production application.
