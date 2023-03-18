<?php
    session_start();
    $logged_user = $_SESSION['id'];

    $servername = "db4free.net";
    $username = "adminpw";
    $password = "adminPW123";
    $dbname = "thereuseshop";

    // Crea la conexión
    $conn = mysqli_connect($servername, $username, $password);
    $bd = mysqli_select_db($conn, "thereuseshop");
    if(!$bd){
        echo 'No se conecto a la base de datos' . mysqli_error();
    }

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista Articulos</title>
    <link rel="stylesheet" type="text/css" href="ListaAdd.css"> 
</head>
<body>




</body>
</html>