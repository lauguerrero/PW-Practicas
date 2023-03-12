<?php

    // Conexion con el servidor
    $servername = "db4free.net";
    $username = "adminpw";
    $password = "adminPW123";
    $dbname = "thereuseshop";
    // Crea la conexion
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //Definicion de las variables
    $nombre = $tematica = $precio = $descripcion = $estado = $imagen = $sql = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $tematica = $_POST["tematica"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $estado = $_POST["estado"];
        $imagen = $_POST["imagen"];
    }

    //Instrucciones de insercion en la base de datos

    $sql = "INSERT INTO Articulo (id_Usuario, Nombre, Tematica, Precio, Descripcion, Estado, Imagen) VALUES ('1', '$nombre', '$tematica', '$precio', '$descripcion', '$estado', '$imagen')";

    mysqli_query ($conn, $sql);

    mysqli_close($conn);
?>