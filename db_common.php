<?php

define('HOSTNAME', "localhost:4000");
define('USERNAME', "anmol");
define('PASSWORD', "anmolshah");
define('DB_NAME', "kaliba_task");

// connect to database
$conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DB_NAME);

// connection test
if (!$conn) {
    echo "database connection error : " . mysqli_connect_error();
}
