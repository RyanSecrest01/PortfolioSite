<?php
    //conect to MySQL
    $host = 'sql310.epizy.com';
    $user = 'epiz_33189621';
    $password = 'Ghetto?313';
    $database = 'epiz_33189621_Contacts';
    $conn = mysqli_connect($host, $user, $password, $database);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
