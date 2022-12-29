<?php
    define('DB_SERVER', '91.216.107.185');
    define('DB_USERNAME', 'rhizo1919392');
    define('DB_PASSWORD', 'A8X78Zi*$Ubm');
    define('DB_NAME', 'rhizo1919392');

    // Attempt to connect to MySQL database
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>