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
    <title>Lista Usuarios</title>
    <link rel="stylesheet" type="text/css" href="ListaUsu.css"> 
</head>
<body>

    <?php

        echo"<h1>Usuarios Registrados</h1>";

        $sql = "SELECT * FROM Usuario";
        $sentencia = mysqli_query($conn, $sql);
        if(!$sentencia){
            echo 'Hay un error en la sentencia SQL: ' . mysqli_error($conn);
        }
        else{
            echo "<table style= width:100% >";
                echo"<tr>";
                    echo"<th>Id_Usuario</th>";
                    echo"<th>Nombre</th>";
                    echo"<th>Apellidos</th>";
                    echo"<th>Telefono</th>";
                    echo"<th>Email</th>";
                    echo"<th>Username</th>";
                    echo"<th>Contrasena</th>";
                    echo"<th>Es Administrador</th>";
                echo"</tr>";
                while($usuario = mysqli_fetch_array($sentencia)){
                        echo "<tr>";
                            echo"<td>".$usuario['Id_Usuario']."</td>";
                            echo"<td>".$usuario['Nombre']."</td>";
                            echo"<td>".$usuario['Apellidos']."</td>";
                            echo"<td>".$usuario['Telefono']."</td>";
                            echo"<td>".$usuario['email']."</td>";
                            echo"<td>".$usuario['username']."</td>";
                            echo"<td>".$usuario['contrasena']."</td>";
                            echo"<td>".$usuario['esAdmin']."</td>";
                        echo"</tr>";
                } 
            echo"</table>";
        }       
    ?>

    <h2>ELIMINACIÓN DE USUARIO</h2>
    
    <form action="ListaUsu.php" method="POST">
        <label for="usuario">Seleccione el id del usuario a eliminar:</label>
        <input type="number" name="id_usu">
        <input type="submit" value="Eliminar">
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST["id_usu"];
            $sql1 = "DELETE FROM Usuario WHERE Id_Usuario = $id";
            $sql2 = "DELETE FROM Articulo WHERE id_Usuario = $id";
            $sql3 = "DELETE FROM Deseos WHERE id_Usuario = $id";
            if(mysqli_query($conn, $sql3) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql1)){
                header("Location: ListaUsu.php");
            }else {
                echo "Error al eliminar el usuario: " . mysqli_error($conn);
            }
        }
    ?>

    <h2>INSERTAR USUARIO</h2>
    <a href = "AdminReg.php">Anadir nuevo usuario</a>


</body>
</html>