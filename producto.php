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
    <title>Producto</title>
    <link rel = "stylesheet" type = "text/css" href = "producto.css"> 
</head>
<body>

<h1>Mostrar Producto</h1>

    <?php
        // Comprobar si se han recibido datos mediate GET
        if(isset($_GET['Id_Articulo'])){
            // Asignar los valores recibidos a variables
            $id = $_GET['Id_Articulo'];
        }

        // Comprobar si se han recibido datos mediante POST
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["Id_Articulo"])){ // Cuando queremos reservar o cancelar la reserva de un artículo
                $id_articulo=$_POST["Id_Articulo"];
                if($_POST["reserva"] == 'delete'){ #En este caso significa que queremos cancelar la reserva el producto
                    mysqli_query($conn, "UPDATE Articulo SET id_UReserva=NULL WHERE Id_Articulo=$id_articulo");
                }else if($_POST["reserva"] == 'add'){ #En este caso significa que queremos reservar el producto
                    mysqli_query($conn, "UPDATE Articulo SET id_UReserva=$logged_user WHERE Id_Articulo=$id_articulo");
                }
            }
        }

        $sql = "SELECT * FROM Articulo WHERE Id_Articulo = $id";
        $sentencia = mysqli_query($conn, $sql);

        if(!$sentencia){
            echo 'Hay un error en la sentencia SQL: ' . mysqli_error($conn);
        }
        else{
            $articulo = mysqli_fetch_array($sentencia);
                echo "<table>";
                echo "<tr class = uno>";
                
                    echo "<td>";
                        echo '<img height="300" width="250" src="'.$articulo['Imagen'].'">';
                    echo "</td>";

                    echo "<td rowspan = 2>";
                        echo $articulo['Nombre'];
                        echo "<br>";
                        echo "<br>";
                        echo 'Categoria: ' . $articulo['Tematica'];
                        echo "<br>";
                        echo "<br>";
                        echo 'Precio: '. $articulo['Precio'] . '€';
                        echo "<br>";
                        echo "<br>";
                        $sql2 = 'SELECT Telefono FROM Usuario WHERE Id_Usuario ='. $articulo["id_Usuario"];
                        $sentencia2 = mysqli_query($conn, $sql2);
                        $usu = mysqli_fetch_array($sentencia2);
                        echo 'Telefono Contacto: '  .$usu['Telefono'];
                    echo "</td>";
                
                echo "</tr>";

                echo "<tr>";
                    echo "<td>";
                        echo $articulo["Descripcion"];
                    echo "</td>";
            
                echo"</tr>";
                echo "</table>";
                echo "<br>";

                echo '<form method="post">';
                echo '<div style="text-align:center;">';
                echo '<input type="hidden" name="Id_Articulo" value="'.$articulo['Id_Articulo'].'">';
                if($articulo['id_UReserva'] == $logged_user){
                    echo '<button type="submit" class="add-reserva" name="reserva" value="delete">Ya lo tienes reservado</button>';
                }else if($articulo['id_UReserva'] != NULL){
                    echo '<button type="submit" class="add-reserva" name="reserva" value="null">Reservado</button>';
                }else{
                    echo '<button type="submit" class="add-reserva" name="reserva" value="add">Reservar</button>';
                }
                echo '</div>';
                echo '</form>';
        }
    ?>

</body>
</html>