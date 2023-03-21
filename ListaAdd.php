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
    <link rel="stylesheet" type="text/css" href="ListaUsu.css"> 
</head>
<body>

    <?php

    echo"<h1>Lista de Articulos</h1>";

    $sql = "SELECT * FROM Articulo";
    $sentencia = mysqli_query($conn, $sql);
    if(!$sentencia){
        echo 'Hay un error en la sentencia SQL: ' . mysqli_error($conn);
    }
    else{
        echo "<table style= width:100% >";
            echo"<tr>";
                echo"<th>Id_Articulo</th>";
                echo"<th>id_Usuario</th>";
                echo"<th>Nombre</th>";
                echo"<th>Tematica</th>";
                echo"<th>Precio</th>";
                echo"<th>Descripcion</th>";
                echo"<th>Estado</th>";
                echo"<th>Imagen</th>";
                echo"<th>id_UReserva</th>";
            echo"</tr>";
            while($articulo = mysqli_fetch_array($sentencia)){
                    echo "<tr>";
                        echo"<td>".$articulo['Id_Articulo']."</td>";
                        echo"<td>".$articulo['id_Usuario']."</td>";
                        echo"<td>".$articulo['Nombre']."</td>";
                        echo"<td>".$articulo['Tematica']."</td>";
                        echo"<td>".$articulo['Precio']."</td>";
                        echo"<td>".$articulo['Descripcion']."</td>";
                        echo"<td>".$articulo['Estado']."</td>";
                        echo"<td>".$articulo['Imagen']."</td>";
                        echo"<td>".$articulo['id_UReserva']."</td>";
                    echo"</tr>";
            } 
        echo"</table>";
    }       
    ?>

    <h2>ELIMINACIÓN DE ARTICULO</h2>

    <form action="ListaAdd.php" method="POST">
    <label for="articulo">Seleccione el id del articulo a eliminar:</label>
    <input type="number" name="id_art">
    <input type="submit" value="Eliminar">
    </form>

    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST["id_art"];
        $sql1 = "DELETE FROM Articulo WHERE Id_Articulo = $id";
        $sql2 = "DELETE FROM Deseos WHERE id_Articulo = $id";
        if(mysqli_query($conn, $sql2) && mysqli_query($conn, $sql1)){
            header("Location: ListaAdd.php");
        }else {
            echo "Error al eliminar el articulo: " . mysqli_error($conn);
        }
    }
    ?>

    <h2>INSERTAR ARTICULO</h2>
    <a href = "publicar.html">Anadir nuevo Articulo</a>


</body>
</html>