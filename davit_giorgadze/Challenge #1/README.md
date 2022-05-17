#Before you start app.

- Open database.php and change the database environments to your own.
    ```php
  $host = "localhost"; // Host name
    $database = "YOUR_DATABASE"; // Your database name
    $user = "root"; // Your database user
    $password = ""; // Your database password
    
    
    ```

- Create users table in your database:
    ```sql
    create table users (
        id int(11) not null auto_increment,
        first_name varchar(255) not null,
        last_name varchar(255) not null,
        image varchar(255),
        primary key (id)
    );
    ```


